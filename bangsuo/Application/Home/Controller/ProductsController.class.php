<?php

namespace Home\Controller;

class ProductsController extends CommonController {
	private $ptypeObj, $prodObj;
	public function _initialize() {
		parent::_initialize ();
		$this->ptypeObj = A ( 'Prodtype', 'Event' );
		$this->prodObj = A ( 'Productview', 'Event' );
	}
	public function index() {
		$mid = I ( 'get.mid', 0, 'intval' );
		$sid = I ( 'get.sid', 0, 'intval' );
		$sqlWhere = '1=1';
		if ($mid) {
			$sqlWhere = ' prod_mainid = ' . $mid;
			if ($sid) {
				$sqlWhere .= ' AND  prod_subid =  ' . $sid;
			}
		}
		$mid = $sid ? $sid : $mid;
		$pageData = $mid ? $this->pageTypeDataContent ( $mid ) : $this->pageConfig ('Product');
		
		$this->assign ( 'Page', $pageData ); 
		
		$prodData = $this->prodObj->dataList ( array (
				'field' => 'autoid,prod_name,img_url',
				'where' => $sqlWhere 
		), false );
		
		$this->assign ( 'ProdList', $prodData ['lists'] );
		$this->assign ( 'PageContent', $prodData ['page'] );
		
		
		$this->display ();
	}
	private function pageTypeDataContent($id) {
		return $this->ptypeObj->prodTypeContent ( $id );
	}
	

}

?>