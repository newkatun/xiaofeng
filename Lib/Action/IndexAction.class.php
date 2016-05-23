<?php
class IndexAction extends CommonAction{
	public function _initialize(){
		$this->getPublic();
		$this->getMenulist();
	}
	public function index(){
		$this->getPageName();
		//产品列表
		$ProductList=R("Table/Category/reProduct");
		$this->assign('CateProduct',$ProductList);
		
		//广告内容
		$SliderList=R("Table/Slider/reTable",array(array('limit'=>'0,7')));
		$this->assign('SliderList',$SliderList);
		
		//新品推荐
		$ProductNew=R("Table/Productnew/reIndex",array(array('limit'=>'0,8','where'=>'p_new = 1','order'=>' p_sort desc,autoid desc')));
		$this->assign('ProductNew',$ProductNew);
		$this->display();
	}
}