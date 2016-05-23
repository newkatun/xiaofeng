<?php
class OrderAction extends CommonAction{

	public function addOrder(){
		$userStatus=R("Userlogin/checkLoginSatus");
		if($userStatus){
			$orderArray['order_uname']=$_SESSION['UEMAIL'];
			$orderArray['order_uid']=$_SESSION['UID'];
		}else{
			$orderArray['order_uname']=$_COOKIE['User-keys'];
			$orderArray['order_uid']=0;
		}
		$orderArray['order_id']=R("Userlogin/getOrderNumber");

		$orderType=array('options'=>'insertTable');

		$strReturn=R("Table/Orderlist/checkData",array($orderArray,$orderType));

		return $strReturn;
	}
	

	/**
	 * 增加产品到临时购买表中
	 * 情况1：会员已登录，绑定添加产品到会员邮箱帐号与ID上
	 * 情况2：委员未登录，绑定产品到临时会员编号上
	 * 返回
	 */
	public function addProduct(){
		$userStatus=R("Userlogin/checkLoginSatus");
		if($userStatus){
			$orderArray['temp_uname']=$_SESSION['UEMAIL'];
			$orderArray['temp_uid']=$_SESSION['UID'];
		}else{
			$orderArray['temp_uname']=$_COOKIE['User-keys'];
			$orderArray['temp_uid']=0;
		}
		$orderArray['temp_pid']=intval($_POST['Pid']);
		$orderArray['temp_qty']=intval($_POST['Qty']);
		if(isset($_POST['TempId'])) $orderArray['autoid']=intval($_POST['TempId']);//更新操作时试用
		$strReturn=R("Table/Ordertemp/checkData",array($orderArray));
		if($strReturn){
			$this->tempTotalPrice();
		}else{
			echo "false";
		}
	}

	/**
	 * 临时购买产品列表
	 * Enter description here ...
	 */
	public function tempOrderTable($strProd=''){
		if(isset($_SESSION['UID']) && isset($_SESSION['UEMAIL'])){
			$result=R("Table/Ordertemp/orderIntoUser");
			$sqlText='temp_uid='.$_SESSION['UID']." and temp_uname ='".$_SESSION['UEMAIL']."'";
		}else{
			$tempName=$_COOKIE['User-keys'];
			if(empty($tempName)){
				$tempName=GetTempName(); //创建临时身份
			}
			$sqlText="  temp_uname ='".$tempName."'";
		}
		if(!empty($strProd)) $sqlText.=' and autoid in('.$strProd.')';
		$result=R("Table/Ordertemp/reTable",array(array('where'=>$sqlText)));
		return $result;
	}

	/**
	 * 生成订单产品信息，
	 * 将购买产品绑定到对应订单
	 * @param string $orderCode 订单编号
	 * @param array  $prodArray 所购买产品
	 */
	private function createOrderProd($orderCode,$prodArray){
		$prodId=implode(',', $prodArray);
		$totalPrice=0;
		$result=R('Table/Ordertemp/reTable',array(array('where'=>' autoid in ('.$prodId.')')));
		if(is_array($result)){
			foreach($result as $datavalue){
				$data['prod_pid']=$datavalue['temp_pid'];
				$data['prod_oid']=$orderCode;
				$data['prod_uid']=$datavalue['temp_uid'];
				$data['prod_orderprice']=$datavalue['p_price'];
				$data['prod_number']=$datavalue['temp_qty'];
				$totalPrice+=floatval($datavalue['temp_qty']*floatval($datavalue['p_price']));
				$strReturn=R('Table/Orderprod/checkData',array($data,array('options'=>'insertTable')));
			}
			//清除临时表中的数据
			$delReturn=R('Table/Ordertemp/delData',array($prodArray));
		}
		return $totalPrice;
	}


	/**
	 * 创建订单内容
	 * @param array $strPost 订单提交的基本信息
	 * @param float $shipping 订单产生的运费
	 * @return array 
	 */
	public function createOrderList($strPost,$shipping=0){
		//生成订单编号
		$orderCode=GetRandWords(4).time();
		if(is_array($strPost['cartId']) && !empty($strPost['cartId'])){
			//商品总价格
			$totalPirce=$this->createOrderProd($orderCode,$strPost['cartId']);
			$strData['order_id']=$orderCode;
			$strData['order_uid']=$_SESSION['UID'];
			$strData['order_uname']=$_SESSION['UEMAIL'];
			if(!empty($strPost['pay_ordertext'])){
				$strData['order_text']=CharsCheck($strPost['pay_ordertext']);
			}
			$result=R('Table/Orderlist/checkData',array($strData,array('options'=>'insertTable')));
			if($result){
				return $orderData=array('OrderCode'=>$orderCode,'totalPirce'=>$strData['order_price']);
			}else{
				return false;
			}
		}
	}
	
	/**
	 * 删除购物车中的商品
	 */
	public function remove(){
		$tempId=intval($_POST['tempId']);
		if($tempId){
			$return=R('Table/Ordertemp/delData',array($tempId));
			$delStatus=intval($return)?true:false;
			echo '{'.$this->tempTotalPrice(false).',"delStatus":'.$delStatus.'}';
		}else{
			echo '{"delStatus":false}';
		}
	}
	
	/**
	 * 
	 * 统计商品个数与商品总价格
	 * @param boolean $strJson 
	 * @return String 字符型;
	 * @return json 对象型
	 */
	public function tempTotalPrice($strJson=true){
		$userStatus=R("Userlogin/checkLoginSatus");
		$sqlArray['field']= 'count(`autoid`) AS `tempnum`, sum( `temp_qty` * `p_price` ) AS `tempprice`';
		if($userStatus){
			$sqlArray['where']="temp_uname='".$_SESSION['UEMAIL']."' AND temp_uid=".$_SESSION['UID'];
		}else{
			$sqlArray['where']="temp_uname='".$_COOKIE['User-keys']."' AND temp_uid=0";
		}
		$return=R('Table/Ordertemp/reTable',array($sqlArray));
		if($strJson){
			echo '{"TotalNum":'.$return[0]['tempnum'].',"TotalPrice":'.floatval($return[0]['tempprice']).'}';
		}else{
			return '"TotalNum":'.$return[0]['tempnum'].',"TotalPrice":'.floatval($return[0]['tempprice']);
		}
	}
}