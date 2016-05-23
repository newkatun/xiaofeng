<?php
class ContactAction extends CommonAction{
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
	
	
	public function feedback(){
		$data['name']=CharsCheck($_POST['guestname']);
		$data['email']=CharsCheck($_POST['guestmail']);
		$data['title']=CharsCheck($_POST['title']);
		$data['content']=CharsCheck($_POST['content']);
		$cheackArray=array('name'=>'/^[a-zA-z][\w \'\-]+[a-zA-z]$/','email'=>'/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/');
		$flag=true;
		$strFlag=preg_match($cheackArray['name'],$data['name'],$strNamearray);
		$strFlag=preg_match($cheackArray['email'],$data['email'],$strEmailarray);
		$strFlag=preg_match($cheackArray['name'],$data['title'],$strTitlearray);
		if(!$strNamearray) $flag=false;
		if(!$strEmailarray) $flag=false;
		if(!$strTitlearray) $flag=false;
		if($flag){
			$result=R('Table/Feedword/checkData',array($data,array('options'=>'insertTable')));
		}
		LocationUrl('/contact');
		
	
	}
}