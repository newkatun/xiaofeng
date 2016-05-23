<?php
namespace Manager\Controller;

class FeedlistController extends  CommonController{ 
	private $_Model;
	public function _initialize(){
		$this->checkLogin();
		$this->_Model=A('Home/Contact','Event');
	}
	public function index(){
		$strArray=array();
		if(isset($_GET['keyword']) && empty($_GET['keyword'])==false){
			$keyword=I('get.keyword');
			$strArray=array('where'=>"uname like '%".$keyword."%' or uemail like '%".$keyword."%' or  	utitle like '%".$keyword."%' " );
		}
		$productData=$this->_Model->dataList($strArray,false);
		$this->assign('FeedList',$productData['lists']);
		$this->assign('PageContent',$productData['page']);
		$this->display();
	}
	
	public function edittable(){
		$id=intval($_GET['id']);
		if($id){
			$this->assign('Feed',$this->_Model->dataContent($id));
			$this->display();
		}else{
			$this->urlRedirect('index');
		}
	}
	
	public function dellist(){
		
	}
}