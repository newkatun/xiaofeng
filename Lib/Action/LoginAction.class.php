<?php
class LoginAction extends CommonAction {
	private $textArray;
	public function _initialize(){
		$this->textArray=array('EmailTitle'=>'Member Forgot Password',
    							'EmailSuccess'=>'Have the password reset URL sent to your mailbox, please check the content .',
    							'EmailFail'=>'Failed to send e-mail ','WebError'=>'I am sorry ,the website error.',
    							'AccountError'=>'We can\'t find your account.',
    							'ValidateError'=>'Verification code errors, please re-enter Verification code !',
    							'SessionExpire'=>'The Session code expire!'
    	);
	}
    public function index(){
    	
    	$this->getPageName();
		$this->getpublic();
    	$this->display();
    }
	
	public function checklogin(){

		$uemail=CharsCheck(($_POST['email']));
		$upwd=md5(CharsCheck($_POST['password']));
		$yacode=md5(CharsCheck($_POST['validCode']));
		if($yacode===$_SESSION['verify']){
			$pattern='/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
			preg_match($pattern, $uemail,$match_array);
			if(is_array($match_array)){
				$strreturn=R('Memberlist/getcheckuser',array($uemail,$upwd));
				if($strreturn){
					$strtext='{"logStatus":"success","weburl":"';
					if(!empty($_COOKIE['NextPage'])){
						$strtext.=$_COOKIE['NextPage'];
					}else{
						$strtext.='userindex';
					}
					$strtext.='"}';		
					setcookie('UserStatus','true',time()+60*60,'/');
					setcookie('UserName',$uemail,time()+60*60,'/');
				}else{
					$strtext='{"logStatus":"fail","weburl":"#","message":"Account name or password is incorrect, please re-enter !","lablename":"password"}';
				}
			}else{
				$strtext='{"logStatus":"fail","weburl":"#","message":"Account does not meet the requirements, please re-enter !","lablename":"email"}';
			}
		}else{
			$strtext='{"logStatus":"fail","weburl":"#","message":"Verification code error, you can click here to re-login again !","lablename":"validCode"}';
		}
		echo $strtext;
	}
	
	public function out(){
		session_destroy(); 
		setcookie('UserStatus',"false",time()+1800,"/");
		echo"<Script>location.href='http://".$_SERVER['SERVER_NAME']."/".APP_NAME."';</script>";
	
	}
	
	public  function forgetpwd(){
		$this->getpublic();
		$this->display(); 
	}
	
	public function forgetaction(){
		$guest_email=CharsCheck($_POST['email']);
		$validCode=md5($_POST['validCode']);
		$strStatus='false';
		if($validCode===$_SESSION['verify']){
			$result=R('Table/Member/reContent',array(array('where'=>" mem_email ='".$guest_email."'")));
			if(is_array($result) && empty($result)==false){
				$strUpate['mem_status']=0;
				$strUpate['men_sessioncode']=time();
				$flag=R('Table/Member/saveData',array($strUpate,array('options'=>'updateTable','autoid'=>$result['autoid'])));
				if($flag){
					$strtitle=$this->textArray['EmailTitle'];
					$strcontent="<table width='90%' align='center'>";
					$strcontent.="<tr><td ><b>Dear: ".$result['mem_name']." </b></td></tr>";
					$strcontent.="<tr><td>Please click on the following link to reset your password ! If you can not click , please copy the link into your browser open .</td></tr>";
					$strcontent.="<tr><td><a href='http://".$_SERVER['HTTP_HOST']."/".APP_NAME."/login/editpwd/mail/".$guest_email."/t/".$strUpate['men_sessioncode']."'>http://".$_SERVER['HTTP_HOST']."/".APP_NAME."/login/editpwd/mail/".$guest_email."/t/".$strUpate['men_sessioncode']."</a></td></tr>";
					$strcontent.="</table>";
					$strreturn=$this->SendEmail($strtitle,$strcontent,$guest_email);
					if($strreturn){
						$strtext=$this->textArray['EmailSuccess'];
						$strStatus='true';
					}else{
						$strtext=$this->textArray['EmailFail'];
					}
				}else{
					$strtext=$this->textArray['WebError'];
				}
			}else{
				$strtext=$this->textArray['AccountError'];	
			}
		}else{
			$strtext=$this->textArray['ValidateError'];
		}
		echo '{"strStatus":"'.$strStatus.'","strReturn":"'.$strtext.'"}';
	}
	
	
	private function loginMessage($strtext){
		$this->assign("strText",$strtext);
		$this->getpublic();
		$this->display("loginMessage"); 
	}
	
	
	public function editpwd(){
		$userEmail=CharsCheck($_GET['mail']);
		$codeSession=intval($_GET['t']);
		$nowTime=time();
		$nowTime-=$codeSession;
		if($nowTime<=3600){
			$this->assign('UserEmail',$userEmail);
			$this->assign('SessionCode',$codeSession);
			$this->getpublic();
			$this->display(); 
		}else{	
			$this->loginMessage($this->textArray['SessionExpire']);
		}
	}
	
	public function updatepwd(){
		$userEmail=CharsCheck($_POST['email']);
		$userPwd=CharsCheck(trim($_POST['password']));
		$userSessionCode=CharsCheck($_POST['sessioncode']);
		$strStatus='false';
		$strWeburl="#";
		if(!empty($userEmail) && !empty($userSessionCode) && !empty($userPwd)){
			$strData['mem_pwd']=md5($userPwd);
			$strData['mem_status']=1;
			$strData['men_sessioncode']="0";
			$strreturn=R('Table/Member/saveData',array($strData,array('options'=>'updateTable','where'=>" mem_email = '".$userEmail."' and men_sessioncode ='".$userSessionCode."'")));
			if($strreturn){
				$strtext="You have successfully changed the password , is for you to return to the login page ,";	
				$strtext.="If you can not return please click,<a href='http://".$_SERVER['HTTP_HOST']."/".APP_NAME."/login'>Sign In</a>!";
				$strStatus='true';
				$strWeburl='http://'.$_SERVER['HTTP_HOST'].'/'.APP_NAME.'/login';
			}else{
				$strtext="Please check your submission !";	
			}
		}else{
			$strtext="Please check your submission !";	
		}
		echo '{"strStatus":"'.$strStatus.'","strReturn":"'.$strtext.'","webPage":"'.$strWeburl.'"}';
	}
	
	
	
	
}