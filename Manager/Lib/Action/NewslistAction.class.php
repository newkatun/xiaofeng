<?php
class NewslistAction extends CommonAction{
	

	
	public function index(){
		
		$result=R('Table/News/reList');
		$this->assign("NewsList",$result['lists']);
		$this->assign("PageContent",$result['page']);
		$this->getPublic();
		$this->display();
		
	}
	
	public function addtable(){	
		$typeList=R('Table/Newstype/reTable');
		$this->assign('NewsTypeList',$typeList);
		$this->getPublic();
		$this->display();
	}

	public function saveadd(){
		$dataType=array('options'=>'insertTable');
		$strData=R("Table/News/checkData",array($_POST,$dataType));
		if(!$strData){
			$this->redirect('index', '数据增加成功！');
		}else{
			$this->redirect('index', '数据增加失败！');
		}

	}

	public function edittable(){
		$lid=CheckNum($_GET['id']);
		if($lid){
			$result  =R("Table/News/reContent",array($lid));
			if(is_array($result)){
				$typeList=R('Table/Newstype/reTable');
				$this->assign('NewsTypeList',$typeList);
				$this->assign("News",$result);
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
		$strData=R("Table/News/checkData",array($_POST,$dataType));
		if(!$strData){
			$this->redirect('index', '数据更新成功！');
		}else{
			$this->redirect('index', '数据更新失败！');
		}
	}
	
	public function dellist(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$reStatus=R("Table/News/delData",array($pid));
			$this->redirect('index', '数据删除成功！');
		}else{
			$this->redirect('index', '数据删除失败！');
		}
	}

	
	
	
}