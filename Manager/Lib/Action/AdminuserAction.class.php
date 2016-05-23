<?php
class AdminuserAction extends CommonAction{
	private $dataable;
	public  function _initialize(){

		$this->dataable="manager";

	}
	public function index(){
		$strarray['order']='autoid desc';
		$result=$this->getpagelist('manager',$strarray,12);
		$this->assign("ManagerList",$result['lists']);
		$this->assign("PageContent",$result['page']);
		$this->getPublic();
		$this->display();
	}
	
public function addtable(){
		$strarray=array('field'=>'autoid,atype_name','order'=>'autoid asc');
		$ArticleType=R('Table/Articletype/reArticletypeTable',array($strarray,$this->language));
		$this->assign("ArticleType",$ArticleType);	
		$this->getPublic();
		$this->display();
	}

	public function saveadd(){
		$strarray=$this->checkData();
		$strreturn=$this->getinsert($this->dataable, $strarray);
		if($strreturn){
			$this->redirect("index");
		}else{
			$this->redirect("index",3,"数据提交失败");
		}
	}
	
	public function edittable(){
		$lid=CheckNum($_GET['id']);
		if($lid){
			$result=$this->getcontent($this->dataable,$lid);
			if(is_array($result)){
				$this->assign("User",$result);
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
		$lid=CheckNum($_POST['autoid']);
		if($lid){
			$strdata=$this->checkData();
			$strarray['where']="autoid=".$lid;
			$this->getupdate($this->dataable, $strarray,$strdata);
			LocationUrl("index");
		}else{
			$this->redirect("index",3, "请求数据错误");
		}
	}
	
	public function dellist(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$id=implode(",", $pid);
			$strarray['where']=' autoid in ('.$id.')';
			$this->getdelone($this->dataable,$strarray) ;
		}
		LocationUrl("index");
	}
	
	public function checkData(){
		
		$ma_username=CharsCheck($_POST['ma_username']);
		$ma_email=CharsCheck($_POST['ma_email']);
		$ma_password=CharsCheck($_POST['ma_password']);
		$ma_intro=CharsCheck($_POST['ma_intro']);
		if(!empty($_POST['ma_power'])){
			$ma_power=implode(",", $_POST['ma_power']);
		}else{
			$ma_power="";
		}

		if(empty($ma_username)){
			$this->redirect("index", 3,"未填写管理员名称");
		}
		if(empty($ma_email)){
			$this->redirect("index", 3,"未填写管理员名称联系邮箱");
		}
		
		

		$strarray['ma_username']=$ma_username;
		$strarray['ma_email']=$ma_email;
		if(!$ma_password){
			$strarray['ma_password']=$ma_password;
		}
		$strarray['ma_intro']=$ma_intro;
		$strarray['ma_power']=$ma_power;

		
		return $strarray;
	
	}
}