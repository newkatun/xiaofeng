<?php

namespace Home\Controller;

class SearchController extends CommonController {
	public function index() {
		$keyword = I ( 'get.keywords' );
		if (empty ( $keyword ))
			redirect ( 'index' );
		$prodObj = A('Productview','Event');
		$sqlWhere = " prod_name like '%" . $keyword . "%' or intro like '%" . $keyword . "%' or content like '%" . $keyword . "%'";
		$prodData = $prodObj->dataList ( array (
				'field' => 'autoid,prod_name,img_url',
				'where' => $sqlWhere 
		), false );
		$this->assign ( 'ProdList', $prodData ['lists'] );
		$this->assign ( 'PageContent', $prodData ['page'] );
		$this->assign('Page',$this->pageConfig('Search'));
		$this->display();
	}
}

?>