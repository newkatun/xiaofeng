<?php
class EmailAction extends CommonAction{ 
	public function index(){
		// $title="cesthi";
		// $content="test my email";
		// $EmailTo="pwj-0910@163.com";
		// $result=$this->sendEmail($title, $content, $EmailTo);
		// if($result){
			// echo "success";
		// }else{
			// echo "fail";
		// }
		// phpinfo();

		
		$fp = fsockopen("smtp.163.com", 25, $errno, $errstr, 30);
		if(!$fp){
			// echo '$errstr   ($errno) <br> \n '; 
		}else{
			echo "success";
		}
		
	}
}