<?php

namespace Home\Controller;

class ProdshowController extends CommonController {
	public function index() {
		$id = I ( 'get.id', 0, 'intval' );
		$prodObj = A ( 'Productview', 'Event' );
		$prodData = $prodObj->dataContent ( $id );
		if (empty ( $prodData ))
		throw_exception ( '页面不存在' );
		
		$prodBeside = $prodObj->dataList ( array (
				'field' => 'autoid,prod_name,img_url',
				'where' => ' (autoid > ' . $id . ' or autoid < ' . $id . ')' ,
				'limit' => '0,6'
		) );
		
		$this->assign ( 'Page', $prodData );
		$this->assign ( 'ProdBeside', $prodBeside );
		$this->display ();
	}
}

?>