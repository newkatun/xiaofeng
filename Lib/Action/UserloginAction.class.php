<?php
class UserloginAction extends CommonAction{
	//检查登录状态
	public  function checkLoginSatus(){
		if(isset($_SESSION['UEMAIL']) && isset($_SESSION['UID'])){
			setcookie("UserStatus",'true',time()+60*60,'/');
			return true;
		}else{
			setcookie("UserStatus",'false',time()+60*60,'/');
			return false;
		}
	}
	/**
	 * 生成订单号
	 * Enter description here ...
	 */
	public function getOrderNumber(){
		$ordercode=GetRandWords();
		return $ordercode;
	}
	
}