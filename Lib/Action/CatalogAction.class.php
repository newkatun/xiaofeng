<?php
class CatalogAction extends CommonAction{
	public function _initialize(){
		$this->getMenulist();
		$this->getPublic();
	}
	
	public function index(){
		$prodArray=R("Table/Category/reList",array(array('where'=>'ty_subid = 0')));
		if(is_array($prodArray['lists'])){
			foreach( $prodArray['lists'] as $key =>$value){
				$prodArray['lists'][$key]['Subtab']=R("Table/Category/reTable",array(array('field'=>'autoid,ty_name','where'=>'ty_subid = '.$prodArray['lists'][$key]['autoid'])));
			}
			$this->assign('CategoryList',$prodArray['lists']);
			$this->assign('PageContent',$prodArray['page']);
		}else{
			$this->assign('EmptyText','很抱歉，暂时没有找到您要的内容！');
		}
		$this->display();
	}
}