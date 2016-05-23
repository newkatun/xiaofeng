<?php

namespace Home\Controller;

class CategoryController extends CommonController {
	public function index() {
		$page = $this->pageNavObj->pageInfoArray ( 'Category', array (
				'field' => 'title,keywords,description'
		) );
		$this->assign ( 'Page', $page );
		$prodType = A ( 'Prodtype', 'Event' );
		$this->assign ( 'ProdType', $prodType->prodTypeList () );
		$this->display ();
	}
}

?>