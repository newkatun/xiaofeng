<?php
class UserindexAction extends 	CommonAction{
	private $guestInfo,$textArray;
	public function _initialize(){
		$this->textArray=array('OrderEmpty'=>'Sorry, could not find the corresponding record with your purchase, please click <a href="HTTP://'.$_SERVER['HTTP_HOST'].'" target="_blank">here</a> to buy your favorite products!',
						 	   'ProdEmpty'=>'This classification does not exist merchandise !',
							   'CancelSuccess'=>'Order cancellation is successful',
							   'CancelFail'=>'Order cancellation failure',
							   'OrderNoExists'=>'Order does not exist',
							   'OrderCodeError'=>'Order number error',
							   'HistoryProd'=>'Products may in your interest',
							   'FavouriteProd'=>'Products may in your interest!',
							   'RebackSuccess'=>'Re-purchasing is successful!',
							   'RebackFail'=>'Re-purchasing is failure'
						);
		if(isset($_SESSION['UID'])==false && empty($_SESSION['UNAMDE'])){
			$strtext="<script>window.location.href='HTTP://".$_SERVER['HTTP_HOST']."/login'</script>";
			echo $strtext;
			exit();
		}else{
			$this->getPageName();
			$this->guestInfo=R("Table/Member/reContent",array($_SESSION['UID']));
			$this->assign('UserName',$this->guestInfo['mem_name']);
			$this->assign('LoginTime',$this->guestInfo['mem_logtime']);
		}
	}

	//订单管理首页
	Public function index(){
		//历史浏览记录
		$this->historyViewProd();
		//订单列表
		$this->orderAllList();
		//订单统计数据
		$this->getAllTypeTotal();
		$this->getPublic() ;
		$this->display();
	}
	
	
	/**
	 * 显示购买订单
	 */
	Private function orderAllList(){
		$sqlArray['field']='order_id,order_addid,order_price,order_shipping,order_status,order_payment,order_datetime,order_paytype';
		$sqlArray['where']=' order_uid='.$_SESSION['UID']." and order_uname='".$_SESSION['UEMAIL']."'" .'  ' ;
		$result=R('Table/Orderlist/reList',array($sqlArray));
		//取出订单号对应的产品，存入数组
		if(is_array($result['lists'])){
			foreach($result['lists'] as $key=>$value){
				$strprodarray=array('field'=>'prod_pid,prod_orderprice,prod_number,p_id,p_name,p_img,ty_name ','where'=>"prod_oid='".$result['lists'][$key]['order_id']."' and prod_uid=".$_SESSION['UID'],'order'=>'autoid desc');
				$result['lists'][$key]['ProdList']=R('Table/Orderprod/reTable',array($strprodarray));
			}
		}
		$this->assign('OrderAllList',$result['lists']);
		$this->assign('PageContent',$result['page']);
		$this->assign('OrderEmpty',$this->textArray['OrderEmpty']);
	}
	
	public function myorder(){

		$this->getAllTypeTotal();
		
		$action=trim($_GET['action']);
		$strtable='guestorderlist';
		$strarray['field']='gl_orderid,gl_datetime,gl_totalprice,gl_orderstaus';
		if($action=='payment'){
			$strarray['where']=" gl_userid=".$_SESSION['UID'] . " and gl_orderstaus='Unaudited'";
		}elseif($action=='ready'){
			$strarray['where']=" gl_userid=".$_SESSION['UID'] . " and gl_orderstaus='ReadyOrder'";
		}elseif($action=='sended'){
			$strarray['where']=" gl_userid=".$_SESSION['UID'] . " and gl_orderstaus='AlreadyOrder'";
		}elseif($action=='canceled'){
			$strarray['where']=" gl_userid=".$_SESSION['UID'] . " and gl_orderstaus='GuestCancel'";
		}else{
			$strarray['where']='gl_userid='.$_SESSION['UID'];
		}

		$strarray['order']='autoid desc';


		$restult=$this->getpagelist($strtable,$strarray,5);
		$orderlist=$restult['lists'];
		$strprodtable='guestorderprod';
		foreach($orderlist as $key=>$value){
			$strprodarray=array('field'=>'autoid,go_prodname, go_prodcode,go_price,go_prodnum, go_oldprice, go_sendpoints, go_attrlist, go_imageurl ','where'=>"go_orderid='".$orderlist[$key]['gl_orderid']."' and go_userid=".$_SESSION['UID'],'order'=>'autoid desc');
				
			$orderlist[$key]['prodlist']=$this->getlist($strprodtable,$strprodarray);
		}

		$this->assign('ProdOrderList',$orderlist);
		$this->assign('page',$restult['page']);
		$this->assign('ProdEmpty',"This classification does not exist merchandise !");
		$this->historyViewProd();

		$this->getPublic() ;
		$this->display();

	}
	


	//订单详细信息
	public function ordershow($stroid=''){
		$ordercode=empty($stroid)?trim($_GET['oid']):$stroid;
		if(!empty($ordercode)){
			$restult=R('Table/Orderlist/reContent',array(array('where'=>" order_id ='".$ordercode."' and order_uid=".$_SESSION['UID'])));
			if(!empty($restult)){
				foreach($restult as $key=>$value){
					$strprodarray=array('field'=>'autoid,go_prodname,go_prodid, go_prodcode,go_price,go_prodnum, go_oldprice, go_sendpoints, go_attrlist, go_imageurl ','where'=>"go_orderid='".$restult['gl_orderid']."'",'order'=>'autoid desc');
					$restult['prodlist']=R('Table/Orderprod/reTable',array(array('where'=>" prod_oid ='".$ordercode."'")));
				}
				$AddressData=R('Table/Address/reContent',array(array('where'=>' autoid ='.$restult['order_addid'])));
				$this->assign('ProdOrderShow',$restult);
				//$this->assign('PaymentName',$this->getcontent('payment',$restult['gl_payment']));
				$this->getPublic() ;
				$this->display();
			}else{
				$this->userError('index',$this->textArray['OrderNoExists']);
			}
		}else{
			$this->userError('index',$this->textArray['OrderCodeError']);
		}
	}


	//修改跟人资料
	public function editinfo(){
		//国家列表
		$CountryList=R('Table/Countrylist/reTable',array(array('field'=>'autoid,country_name')));
		$this->assign("CountryList",$CountryList);
		//个人信息
		$Guest=R('Table/Guestlist/reCont',array($_SESSION['UID']));
		$this->assign("Guest",$Guest);
		$this->getPublic() ;
		$this->display();
	}


	//送货地址管理列表
	public function address(){
		$result=R('Table/Address/reTable',array(array('where'=>' add_gid='.$_SESSION['UID']."  AND	add_gname='".$_SESSION['UEMAIL']."' ")));
		$this->assign('GuestAddress',$result) ;
		$this->getPublic() ;
		$this->display();
	}
	//修改送货地址
	public function addressedit(){
		$straid=intval($_GET['id']);
		$result=R('Table/Address/reContent',array(array('where'=>'autoid='.$straid .' and add_gid='.$_SESSION['UID'])));
		if(!empty($result)){
			$this->assign('Add',$result);
			$country=R('Table/Country/reTable');
			$this->assign('CountryList',$country);
			$this->getPublic() ;
			$this->display();
		}else{
			$strurl="http://".$_SERVER['HTTP_HOST']."/".APP_NAME."/".$this->getActionName()."/address";
			$strText= "Information fill in error !";
			$this->userError($strurl,$strText);
		}
	}
	//保存修改送货地址
	public function addresseditok(){
		$addId=intval($_POST['addessid']);
		$result=R('Table/Address/checkData',array($_POST,array('options'=>'updateTable','where'=>' autoid ='.$addId .' AND add_gid='.$_SESSION['UID'])));
		if($result){
			$strText= "Information update success !";
		}else{
			$strText= "Information fill in error !";
		}
		$this->userError('address',$strText);
	}
	//增加收货地址
	public function addressadd(){
		$country=R('Table/Country/reTable');
		$this->assign('CountryList',$country);
		$this->getPublic() ;
		$this->display();
	}
	//保存送货地址
	public function addressaddok(){
		$result=R('Table/Address/checkData',array($_POST,array('options'=>'insertTable')));
		if($result){
			$strText= "Information update success !";
		}else{
			$strText= "Information fill in error !";
		}
		$this->userError('address',$strText);
	}
	
	//修改密码
	public function pwdedit(){
		$this->getPublic() ;
		$this->display();
	}
	
	//保存修改密码
	public function pwdeditok(){
		$pwd=md5(CharsCheck($_POST['guest_oldpwd']));
		$newpwd=CharsCheck($_POST['guest_newpwd']);
		$checkpwd=CharsCheck($_POST['guest_chkpwd']);
			
		if(is_null($pwd)!=true && is_null($newpwd)!=true && $checkpwd==$newpwd){
			$result=R('Table/Member/reContent',array(array('where'=>' autoid = '.$_SESSION['UID'] ."  and mem_email = '".$_SESSION['UEMAIL']."'")));
			if($pwd==$result['mem_pwd']){
				$flag=R('Table/Member/saveData',array(array('mem_pwd'=> md5($newpwd)),array('options'=>'updateTable','autoid'=>$_SESSION['UID'])));
				if($flag){
					session_destroy();
					setcookie('UserStatus',"false",time()+1800,"/");
					$strurl="http://".$_SERVER['HTTP_HOST']."/".APP_NAME."/login";
					$strText= "Successfully modified , please re- login !";
				}else{
					$strurl="http://".$_SERVER['HTTP_HOST']."/".APP_NAME."/".$this->getActionName()."/pwdedit";
					$strText= "Modification fails";
				}
			}else{
				$strurl="http://".$_SERVER['HTTP_HOST']."/".APP_NAME."/".$this->getActionName()."/pwdedit";
				$strText= "Modification fails";
			}
		}else{
			$strurl="http://".$_SERVER['HTTP_HOST']."/".APP_NAME."/".$this->getActionName()."/pwdedit";
			$strText= "Information fill in error !";
		}
		$this->userError($strurl,$strText);
	}
	/**
	 *订单分类统计信息
	 *对于准备发货跟已经发货都是确定在已经付款的情况下
	 * param $strtype 申请统计的方式
	 * @return 统计数量
	 */
	private function totalOrderType($strtype){
		if($strtype=='Unaudited'){	//未付款的
			$strarray['where']=" order_uid=".$_SESSION['UID']." and order_status='Unaudited' and order_payment='Non-payment'  ";
		}elseif($strtype=='ReadyOrder'){	//准备发货
			$strarray['where']=" order_uid=".$_SESSION['UID']." and order_status='ReadyOrder' and order_payment='PayMoney'  ";
		}elseif($strtype=='AlreadyOrder'){//已经发货
			$strarray['where']=" order_uid=".$_SESSION['UID']." and order_status='AlreadyOrder' and order_payment='PayMoney'  ";
		}elseif($strtype=='CancelOrder'){//取消订单
			$strarray['where']=" order_uid=".$_SESSION['UID']." and (order_status='GuestCancel' or order_status='NothingOrder') and order_payment='Non-payment' and order_cancel='off' ";
		}else{
			$strarray['where']=" order_uid=".$_SESSION['UID']." ";
		}
		$result=R('Table/Orderlist/reTotal',array($strarray));
		return $result;
	}



	/**
	 * 两种记录方式
	 * 1：客户访问的产品记录
	 * 2: 随机推荐产品
	 * @return array 产品列表
	 */
	private function historyViewProd(){
		if(isset($_COOKIE['VisitProd'])){
			$visitProd=trim($_COOKIE['VisitProd'],',');
			$showTitle=$this->textArray['HistoryProd'];
			$sqlArray=array('where'=>'autoid in ('.$visitProd.')','limit'=>'0,8');
		}else{
			$showTitle=$this->textArray['FavouriteProd'];
			$sqlArray=array('limit'=>'0,8');
		}
		$this->assign('ShowTitle',$showTitle);
		$CookieProduct=R("Table/Productnew/reTable",array($sqlArray));
		$this->assign('CookieProd',$CookieProduct);
	}
	/**
	 * 订单状态分类统计数据
	 */
	private function getAllTypeTotal(){
		//未付款
		$this->assign('UnauditedOrder',$this->totalOrderType('Unaudited'));
		//准备发货
		$this->assign('ReadyOrder',$this->totalOrderType('ReadyOrder'));
		//已经发货
		$this->assign('AlreadyOrder',$this->totalOrderType('AlreadyOrder'));
		//取消订单
		$this->assign('CancelOrder',$this->totalOrderType('CancelOrder'));
	}


	//取消订单
	public function cancelOrder(){
		$oid= CharsCheck($_GET['oid']);
		if(!empty($oid)){
			$strarray['where']=" order_id='".$oid."' and order_uid=".$_SESSION['UID'];
			$result=R('Table/Orderlist/reContent',array($strarray));
			if($result){
				$result=R('Table/Orderlist/saveData',array(array('order_status'=>'GuestCancel','order_cancel'=>'off'),array('options'=>'updateTable','where'=>$strarray)));
				$this->userError('index',$this->textArray['CancelSuccess']);
			}else{
				$this->userError('index',$this->textArray['CancelFail']);
			}
		}else{
			$this->userError('index',$this->textArray['OrderNoExists']);
		}
	}


	//订单取消之后再次购买
	public function reback(){
	$oid= CharsCheck($_GET['oid']);
		if(!empty($oid)){
			$strarray['where']=" order_id='".$oid."' and order_uid=".$_SESSION['UID'];
			$result=R('Table/Orderlist/reContent',array($strarray));
			if($result){
				$result=R('Table/Orderlist/saveData',array(array('order_status'=>'Unaudited','order_cancel'=>'on'),array('options'=>'updateTable','where'=>$strarray)));
				$this->userError('index',$this->textArray['RebackSuccess']);
			}else{
				$this->userError('index',$this->textArray['RebackFail']);
			}
		}else{
			$this->userError('index',$this->textArray['OrderNoExists']);
		}
	}



	//购买商品列表
	private function mybought(){

		$this->getPublic() ;
		$this->display();
	}

	
	public function myfavourite(){
		$strarray['field']='fps_product.autoid,fps_product.prod_name,fps_product.prod_image,fps_product.prod_price,fps_product.prod_oldprice,fps_favourite.datetime';
		$strarray['order']='fps_product.prod_sort desc,fps_product.autoid desc';
		$strarray['join']=' fps_product on fps_favourite.prod_id=fps_product.autoid';
		
		$result=$this->getpagelist("favourite",$strarray,16);
		$this->assign("FavouriteList",$result['lists']);
		$this->assign("PageContent",$result['page']);
		$this->getPublic() ;
		$this->display();
	}
	
	public function userError($strUrl,$strText){
		$this->assign('FailText',$strText);
		$this->getPublic() ;
		$this->display('error');
	}
}