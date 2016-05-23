<?php
class FeedlistAction extends CommonAction{
	
public function index(){
		$result=R('Table/Feed/reList');
		$this->assign("FeedList",$result['lists']);
		$this->assign("PageContent",$result['page']);
		$this->getPublic();
		$this->display();
	}
	
	public function addtable(){
		$this->getpublic();
		$this->display();
	}
	
	public function saveadd(){
		$dataType=array('options'=>'insertTable');
		$strData=R("Table/Feed/checkData",array($_POST,$dataType));
		if(!$strData){
			$this->redirect('index', '数据增加成功！');
		}else{
			$this->redirect('index', '数据增加失败！');
		}
	}
	
	public function edittable(){
		$lid=CheckNum($_GET['id']);
		if($lid){
			$result  =R("Table/Feed/reContent",array($lid));
			if(is_array($result)){
				$this->assign("Feed",$result);
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
		$strData=R("Table/Feed/checkData",array($_POST,$dataType));
		if(!$strData){
			$this->redirect('index', '数据更新成功！');
		}else{
			$this->redirect('index', '数据更新失败！');
		}
	}
	
	public function dellist(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$reStatus=R("Table/Feed/delData",array($pid));
			$this->redirect('index', '数据删除成功！');
		}else{
			$this->redirect('index', '数据删除失败！');
		}
	}
}