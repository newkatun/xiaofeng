<?php

namespace Home\Controller;

class IndexController extends CommonController {
	public function index() {
		
		$this->assign ( 'Page', $this->pageConfig('Index') );
		
		$slideLlist = A ( 'Release', 'Event' );
		$this->assign ( 'SlideList', $slideLlist->slideList () );
		
		$prodObj = A('Productview','Event');
		$prodList = $prodObj->dataList(array('field'=>'autoid,prod_name,img_url','order'=>'prod_sort desc,autoid desc','limit'=>'12'));
		
		$this->assign('IndexProductList',$prodList);
		$this->display ();
	}
}