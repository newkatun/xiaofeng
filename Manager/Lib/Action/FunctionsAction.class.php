<?php
class FunctionsAction extends  CommonAction{
	/**
	 * 网站基本设置内容
	 */
	public  function index(){
		$systemArray=R("Table/Systems/reContent");
		$this->assign("System",$systemArray);
		$this->getPublic();
		$this->display();
	}

	public function addtable(){
		$sy_company=CharsCheck($_POST['sy_company']);
		$sy_hostname=CharsCheck($_POST['sy_hostname']);
		$sy_telephone=CharsCheck($_POST['sy_telephone']);
		$sy_faxnumber=CharsCheck($_POST['sy_faxnumber']);
		$sy_address=CharsCheck($_POST['sy_address']);
		$sy_memail=CharsCheck($_POST['sy_memail']);
		$sy_semail=CharsCheck($_POST['sy_semail']);
		$sy_websmtp=CharsCheck($_POST['sy_websmtp']);
		$sy_webpassword=CharsCheck($_POST['sy_webpassword']);
		$sy_recordcode=CharsCheck($_POST['sy_recordcode']);
		$sy_defaultlang=CharsCheck($_POST['sy_defaultlang']);
		
		if(empty($sy_company)){
			$this->redirect("index", 3,"网站名称未填写");
		}
		if(empty($sy_hostname)){
			$this->redirect("index", 3,"网站域名未填写");
		}
		if(empty($sy_telephone)){
			$this->redirect("index", 3,"联系方式为填写");
		}
		if(empty($sy_faxnumber)){
			$this->redirect("index", 3,"传真号码未填写");
		}
		if(empty($sy_memail)){
			$this->redirect("index", 3,"管理邮箱未填写");
		}
		if(empty($sy_semail)){
			$this->redirect("index", 3,"发送邮箱未填写");
		}
		if(empty($sy_websmtp)){
			$this->redirect("index", 3,"SMTP服务所未填写");
		}
		if(empty($sy_webpassword)){
			$this->redirect("index", 3,"发送邮箱密码未填写");
		}
		
		$strarray['sy_company']=$sy_company;
		$strarray['sy_hostname']=$sy_hostname;
		$strarray['sy_telephone']=$sy_telephone;
		$strarray['sy_faxnumber']=$sy_faxnumber;
		$strarray['sy_memail']=$sy_memail;
		$strarray['sy_semail']=$sy_semail;
		$strarray['sy_websmtp']=$sy_websmtp;
		$strarray['sy_webpassword']=$sy_webpassword;
		$strarray['sy_recordcode']=$sy_recordcode;
		$strarray['sy_defaultlang']=$sy_defaultlang;
		$strarray['sy_address']=$sy_address;
		$strreturn=R("Table/Systems/saveData",array($strarray,array('options'=>'updateTable','autoid'=>1)));
		
		if($strreturn){
			LocationUrl("index");	
		}else{
			$this->redirect("index",3,"数据提交失败");	
		}
	}

}