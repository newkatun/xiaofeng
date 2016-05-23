<?php
class ProdimglistAction extends  CommonAction {
	public function _initialize(){
		$this->loginStatusCheck();
	}
	public function index(){
		$pid=intval($_GET['id']);
		$result=R('Table/Image/reTable',array(array('where'=>'pi_prodid='.$pid)));
		$this->assign("ImageList",$result);
		$this->assign("ProdID",$pid);
		$this->getpublic();
		$this->display();
	
	}
	
	public function saveadd(){
		$dataType=array('options'=>'insertTable');
		$prodid=intval($_POST['prodid']);
		$strData=R("Table/Image/checkData",array($_POST,$dataType));
		$WebRoot="http://".$_SERVER['HTTP_HOST'];
		LocationUrl($WebRoot."/".APP_URL."/prodimglist/index/id/".$prodid);

	
	}
}