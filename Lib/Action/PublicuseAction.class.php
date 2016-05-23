<?php
class PublicuseAction extends CommonAction{	
	
	Public function verify(){
		$strarray=array('height'=>20);
		import('ORG.Util.Image');
		Image::buildImageVerify(4,1,"png",30,22);
	}
	public function yanzheng(){
		$yzcode=md5(trim($_POST['yzcode']));
		$s_code=$_SESSION['verify'];
		if($yzcode===$s_code){
			echo "true";
		}else{
			echo "false";
		}
	}
}