<?php
class ProdshowAction  extends  CommonAction{ 
	public function _initialize(){
		
		$this->getPublic();
	}
	public function index(){
		
		$pid=intval($_GET['id']);
//		产品详细内容
		$prodSql=array('where'=>' autoid = '.$pid);
		$prodArray=R("Table/Productnew/reContent",array($prodSql));
		$this->assign("Prod",$prodArray);
		//产品对应类别
		$this->getMenulist($prodArray['p_typeid'],$prodArray['p_ttypeid']);
		
		//产品图片
		$imgSql=array('where'=>' pi_prodid = '.$pid);
		$prodImgArray=R("Table/Image/reTable",array($imgSql));
		$this->assign("ImageList",$prodImgArray);
		
		//产品同类
		$prodMenuSql=array('where'=>' p_typeid = '.$prodArray['p_typeid'],'limit'=>'0,6');
		$prodMenuArray=R("Table/Productnew/reTable",array($prodMenuSql));
		$this->assign("RelationList",$prodMenuArray);
		
		//产品大类别名称
		$mainName=R("Table/Category/reContent",array($prodArray['p_typeid']));
		$this->assign("MainName",$mainName);
		//产品细类别名称
		$subName=R("Table/Category/reContent",array($prodArray['p_ttypeid']));
		$this->assign("SubName",$subName);
		
		$this->display();
	}
	
	
}