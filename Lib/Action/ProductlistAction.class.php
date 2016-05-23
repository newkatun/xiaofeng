<?php
class ProductlistAction  extends  CommonAction{ 
	public function _initialize(){
		$this->getPublic();
	}
	public function index(){
		
		//产品类别
		$mid=isset($_GET['mid'])?intval($_GET['mid']):0;
		$sid=isset($_GET['sid'])?intval($_GET['sid']):0;
		$this->getMenulist($mid,$sid);
		if($mid){
		//产品大类别名称
			$mainName=R("Table/Category/reContent",array($mid));
			$this->assign("MainName",$mainName);
			$sqltext=" p_typeid=".$mid ;
		//产品细类别名称
			if($sid){
				$subName=R("Table/Category/reContent",array($sid));
				$this->assign("SubName",$subName);
				$sqltext.=' and p_ttypeid= '.$sid ;
			}
			$menuSql=array('where'=>' '.$sqltext .' ');
			$tableList=true;
			$prodArray=R("Table/Productnew/reList",array($menuSql));
			$this->assign('MenuProduct',$prodArray['lists']);
			$this->assign('PageContent',$prodArray['page']);
			
		}else{
			$prodArray=R("Table/Productnew/reList");
			$this->assign('MenuProduct',$prodArray['lists']);
			$this->assign('PageContent',$prodArray['page']);
			$tableList=true;
		}
		if(empty($prodArray['lists']) || isset($prodArray) == false){
			$menuSql = array('order'=>' autoid desc  ','limit'=>'0,24');
			$prodArray=R("Table/Productnew/reTable",array($menuSql));
			$this->assign('MenuProduct',$prodArray);
			$tableList=false;
		}
		
		//产品列表
		
		$this->assign('TableList',$tableList);
		$this->display();
	}
	
	
}