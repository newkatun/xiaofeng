<?php
class ManagerAction extends CommonAction{
	public function _initialize(){
		$this->loginStatusCheck();
	}
	public function index(){
		$this->assign("PowerUse",$_SESSION['userpower']);
		$this->getPublic();
		$this->display();
	}
	
	public function main(){

		$this->assign("LoginTime",$_SESSION['LTime']);
		$this->assign("LoginDate",$_SESSION['LDate']);
		$systemArray=R("Table/Systems/reContent");
		
		$this->assign("System",$systemArray);
		$this->getPublic();
		$this->display();
	}



}