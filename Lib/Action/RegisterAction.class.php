<?php

class RegisterAction extends CommonAction {
    public function index(){
    	
    	$this->getPageName();
		$this->getpublic();
    	$this->display();
    }
	
	public function registerChk(){
		$pattern='/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
		$strPost['email']=CharsCheck($_POST['email']);
		if(preg_match($pattern,$strPost['email'])){
			$strPost['name'] =CharsCheck($_POST['name']);
			$strPost['passowrd']  =md5(CharsCheck($_POST['password']));
			$yacode=md5(CharsCheck($_POST['validCode']));
			
			if($yacode===$_SESSION['verify']){
				
				$userid=R('Table/Member/checkData',array($strPost,array('options'=>'insertTable')));
	 			$_SESSION['UID']=$userid;
				$_SESSION['UNAMDE']=$strPost['name'];
				$_SESSION['UEMAIL']=$strPost['email'];
				setcookie('UserStatus','true',time()+60*10,'/');
				setcookie('UserName',$strPost['email'],time()+60*10,'/');
				$result=R("Table/Ordertemp/orderIntoUser");
				if($result){
					LocationUrl('/cartlist');
				}else{
					LocationUrl('/userindex');
				}
			}else{
				$this->error('Please re-register');
			}
		}else{
			$this->error('Your email error!');
		}
	}
}