<?php
class MemberlistAction extends CommonAction{ 
	public function _initialize(){
		$this->loginStatusCheck();
	}
	public function index(){
		$result=R('Table/Member/reList');
		$this->assign("MemberList",$result['lists']);
		$this->assign("PageContent",$result['page']);
		$this->getPublic();
		$this->display();
	}
	
	public function edittable(){
		$lid=CheckNum($_GET['id']);
		if($lid){
			$result  = R("Table/Member/reContent",array($lid));
			if(is_array($result)){
				$this->assign("Order",$result);
				$AddResult=R("Table/Address/reTable",array(array( 'add_gid'=>$result['autoid'])));
				$this->assign("AddressList",$AddResult);
				$this->getPublic();
				$this->display();
			}else{
				$this->redirect("index",3, "请求数据错误");
			}
		}else{
			$this->redirect("index",3, "请求数据错误");
		}
	}
	
	public function dellist(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$reStatus=R("Table/Member/delData",array($pid));
			$this->redirect('index', '数据删除成功！');
		}else{
			$this->redirect('index', '数据删除失败！');
		}
	}
	
}