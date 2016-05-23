<?php
class MemberlistAction extends CommonAction{ 
	public function ajaxEmail(){
		$email=CharsCheck($_POST['email']);
		$result=R("Table/Member/reContent",array(array('where'=>"mem_email = '".$email."'")));
		if(is_array($result)){
			echo "false";
		}else{
			echo "true";
		}
	}
	
	public function getcheckuser($strUser,$strPassword){
		$result=R('Table/Member/reContent',array(array('where'=>"mem_email = '".$strUser."'")));
		if(is_array($result)){
			if($result['mem_pwd']===$strPassword){ 
				$_SESSION['UID']=$result['autoid'];
				$_SESSION['UNAME']=$result['mem_name'];
				$_SESSION['UEMAIL']=$result['mem_email'];
				setcookie('UserStatus','true',time()+60*10,'/');
				setcookie('UserName',$result['mem_email'],time()+60*10,'/');
				$result=R("Table/Ordertemp/orderIntoUser");
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}