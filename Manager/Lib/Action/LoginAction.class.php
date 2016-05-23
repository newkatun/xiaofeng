<?php
header("Content-ype:text/html;charset=utf-8");	
class LoginAction extends CommonAction{
	public function index(){
		
		$this->getPublic();
		$this->display();
	
	}
	public function loginCheck(){
		$dataPost=$this->getPostData();
		if(is_array($dataPost)){
			$strPostArray['user_name']=$dataPost['username'];
			$result=R("Table/Manager/reContent",array($strPostArray))	;
			if($result['user_password']==$dataPost['userpwd']){ 
				$_SESSION['MID']=$result['autoid'];
				$_SESSION['MNAME']=$result['user_name'];
				$_SESSION['LTime']=$result['user_lognum'];	//次数
				$_SESSION['LDate']=date("Y-m-d H:i:s",time());					
				$_SESSION["userpower"]=$result['user_power'];
				
				//更新操作
				$updateData['user_datetime']=date("Y-m-d H:i:s",time());
				$updateData['user_lognum']=intval($_SESSION['LTime'])+1;
				$updateArray=R("Table/Manager/saveData",array($updateData,array('options'=>'updateTable','autoid'=>$_SESSION['MID'])));
				
				LocationUrl("http://".$_SERVER['HTTP_HOST'].__APP__."/manager");
				
			
				
				exit();			
			}else{
				$this->redirect("index",3,"帐号或密码填写错误！");
				exit();
			}
		}else{
			$this->redirect("index",3,"请检查提交表格内容！");
			exit();
		}
	}
	
	public function getPostData(){
		
		$username=CharsCheck($_POST['Username']);
		$userpwd=CharsCheck($_POST['Password']);
		$useryzcode=md5(CharsCheck($_POST['VerifyCode']));
		if($useryzcode==$_SESSION['verify']){
			if(empty($username) || empty($userpwd)){
				$this->redirect("index",3,"帐号或密码填写错误！");
			}
			if(empty($useryzcode)){
				$this->redirect("index",3,"验证码填写错误！");
			}
			$postArray['username']=$username;
			$postArray['userpwd']=md5($userpwd);
			return  $postArray;
		}else{
			$this->redirect("index",3,"验证码填写错误！");
		}
		
		
	
	}
	
	
	public function logout(){
		session_start();
		session_destroy();
		$this->redirect("index",3,"leaving！");
	}
}