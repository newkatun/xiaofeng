<?php
namespace Manager\Controller;
class IndexController extends CommonController {
	public function _initialize(){
		$this->checkLogin();
	}
    public function index(){
    	$this->assign('PowerUse',$_SESSION['userpower']);
    	$this->assign('GUESTNAME',$_SESSION['MNAME']);
    	$this->display();
    }
    
    public function main(){
    	$this->assign('GUESTNAME',$_SESSION['MNAME']);
    	$this->assign('LoginTime',$_SESSION['LTime']);
    	$this->assign('IPAddress',GetIP());
    	$this->assign('LoginDate',$_SESSION['LDate']);
    	
    	$model = A('Home/Systems','Event');
    	$modelData = $model->dataContent(1);
    	$this->assign('System',$modelData);
     
    	$this->display();
    }
	
	public function cache(){
		try{
			$cache = A('Home/Cachelist','Event');
			foreach($cache->dataList() as $key=>$value){
				S($value['cache_name'],null);
			}
			echo 'Success';
		}catch(\Exception $e){
			echo "Fail";
		}
	}
}