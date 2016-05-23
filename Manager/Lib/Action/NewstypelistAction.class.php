<?php
class NewstypelistAction extends  CommonAction{
	
	
	public function index(){
		$result=R('Table/Newstype/reList');
		$this->assign("Newstypelist",$result['lists']);
		$this->assign("PageContent",$result['page']);
		$this->getPublic();
		$this->display();
		
	}
	
	public function addtable(){	
		$SqlArray['where']='ty_subid=0';
		$mainarray=R('Table/Newstype/reTable',array($SqlArray));
		$this->assign("NewstypeTable",$mainarray);
		$this->getPublic();
		$this->display();
	}
	/**
	 * 每一种语言对应一个表，一个公共表
	 * Enter description here ...
	 */
	
	public function saveadd(){
		$dataType=array('options'=>'insertTable');
		$strData=R("Table/Newstype/checkData",array($_POST,$dataType));
		if(!$strData){
			$this->redirect('index', '数据增加成功！');
		}else{
			$this->redirect('index', '数据增加失败！');
		}
	}

	public function edittable(){
		$lid=CheckNum($_GET['id']);
		if($lid){
			$result  =R("Table/Newstype/reContent",array($lid));
			if(is_array($result)){
				$this->assign("Atype",$result);
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
		$strData=R("Table/Newstype/checkData",array($_POST,$dataType));
		if(!$strData){
			$this->redirect('index', '数据更新成功！');
		}else{
			$this->redirect('index', '数据更新失败！');
		}
	}
	
	public  function submenu(){
		$cateId=intval($_GET['id']);
		if($cateId){
			$CateMainArray  =R("Table/Newstype/reContent",array($cateId));
			$this->assign("CateMain",$CateMainArray);
			$SqlArray['where']='ty_subid='.$cateId;
			$result=R('Table/Newstype/reList',array($SqlArray));
			$this->assign("NewstypeList",$result['lists']);
			$this->assign("PageContent",$result['page']);
			$this->getPublic();
			$this->display();	
		}else{
			LocationUrl("index");
		}
		
	
	}
	
	
	public function dellist(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$strData=R("Table/Newstype/delData",array($pid));
		}
		LocationUrl("index");
	}

	
}