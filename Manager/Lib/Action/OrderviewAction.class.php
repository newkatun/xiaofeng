<?php
class OrderviewAction extends CommonAction{
	public function _initialize(){
		$this->loginStatusCheck();
	}
	public function index(){
		$result=R('Table/Orderlist/reList');
		$this->assign("Orderview",$result['lists']);
		$this->assign("PageContent",$result['page']);
		$this->getPublic();
		$this->display();
	}
	
	public function edittable(){
		$lid=CheckNum($_GET['id']);
		if($lid){
			$result  = R("Table/Orderlist/reContent",array($lid));
			if(is_array($result)){
				$this->assign("Order",$result);
				$AddResult=R("Table/Address/reContent",array($result['order_addid']));
				$this->assign("Address",$AddResult);
				$prodResult=R("Table/Orderprod/reTable",array(array('where'=>"prod_oid = '".$result['order_id']."'")));
				$this->assign("OrderProdList",$prodResult);
				$this->getPublic();
				$this->display();
			}else{
				$this->redirect("index",3, "请求数据错误");
			}
		}else{
			$this->redirect("index",3, "请求数据错误");
		}
	}

	public function saveedit(){
		$prodId=intval($_POST['autoid']);
		$dataType=array('options'=>'updateTable','autoid'=>$prodId);
		$strData=R("Table/Soletype/checkData",array($_POST,$dataType));
		if(!$strData){
			$this->redirect('index', '数据更新成功！');
		}else{
			$this->redirect('index', '数据更新失败！');
		}
	}
	
	
	
	public function dellist(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$reStatus=R("Table/Orderlist/delData",array($pid));
			$this->redirect('index', '数据删除成功！');
		}else{
			$this->redirect('index', '数据删除失败！');
		}
	}
}