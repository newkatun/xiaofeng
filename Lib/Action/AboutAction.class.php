<?php
class AboutAction extends CommonAction{
	public function _initialize(){
		$this->getMenulist();
		$this->getPublic();
	}
	
	public function index(){
		$pageName= $this->getActionName();
		$pageSql= array('where'=>"c_name = '".$pageName."'");
		$pageArray=R("Table/Page/reContent",array($pageSql));
		$this->assign('Page',$pageArray);
		$this->display();
	}
}