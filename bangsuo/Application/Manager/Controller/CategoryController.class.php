<?php

namespace Manager\Controller;

class CategoryController extends CommonController {
	private $_Model, $_rUrl;
	public function _initialize() {
		$powerId = 1;
		$this->pageCheck ( $powerId );
		$this->_Model = A ( 'Home/Prodtype', 'Event' );
		$this->_rUrl = __CONTROLLER__;
	}
	private function _PageConstruct() {
		$pageArray = $this->_Model->dataList ( array (
				'where' => 'ty_subid = 0' 
		) );
		$this->assign ( 'CategoryTable', $pageArray );
	}
	public function index() {
		$strArray = array (
				'where' => "  ty_subid=0 " 
		);
		if (isset ( $_GET ['keyword'] ) && empty ( $_GET ['keyword'] ) == false) {
			$keyword = I ( 'get.keyword' );
			$strArray = array (
					'where' => " (ty_name 	 like '%" . $keyword . "%'  or ty_keyword like '%" . $keyword . "%') and ty_subid=0" 
			);
		}
		$productData = $this->_Model->dataList ( $strArray, false );
		$this->assign ( 'CategoryList', $productData ['lists'] );
		$this->assign ( 'PageContent', $productData ['page'] );
		$pnum = isset ( $_GET ['p'] ) ? intval ( $_GET ['p'] ) : 1;
		ReturnUrl ( __CONTROLLER__, $pnum ); // 保存跳转页面到Cookie
		$this->display ();
	}
	public function addtable() {
		$this->_PageConstruct ();
		$this->addTableUse ();
	}
	public function saveadd() {
		$dataArray = $this->_checkData ();
		$updateData = $this->_Model->dataInsert ( $dataArray );
		if ($updateData < 1) {
			$sUrl = __CONTROLLER__ . '/addtable';
			$this->errorPage ( $this->_errorMessage ( 'addfail' ), '', $sUrl );
		}
		$this->urlRedirect ();
	}
	public function edittable() {
		$id = intval ( $_GET ['id'] );
		if ($id) {
			$this->_PageConstruct ();
			$dataReturn = $this->_Model->dataContent ( $id );
			if (! $dataReturn) {
				$this->errorPage ( $this->_errorMessage ( 'editfail' ), array (
						'rUrl' => $this->_rUrl 
				) );
			}
			$this->assign('Cate',$dataReturn);
			$this->display();
			exit();
		}
		$this->errorPage ( $this->_errorMessage ( 'idfalse' ), array (
				'rUrl' => $this->_rUrl 
		) );
	}
	public function saveedit() {
		$id = intval ( $_POST ['autoid'] );
		$dataArray = $this->_checkData ( 'edittable' );
		$strArray = array (
				'where' => 'autoid=' . $id,
				'data' => $dataArray 
		);
		$updateData = $this->_Model->dataUpdate ( $strArray );
		if ($updateData < 1) {
			$this->errorPage ( $this->_errorMessage ( 'updatefail' ), array (
					'rUrl' => $this->_rUrl . '/edittable/id/' . $id 
			) );
		}
		$this->urlRedirect ();
	}
	public function dellist() {
		$pid = $_POST ['id'];
		if (! empty ( $pid ) && is_array ( $pid )) {
			$Did = implode(',', $pid);
			$sqlArray = array('where'=>'autoid in('.$Did.')');
			$returnData = $this->_Model->dataDelete ( $sqlArray );
			if ($returnData == false) {
				$this->errorPage ( $this->_errorMessage ( 'delfail' ), array (
						'rUrl' => $this->_rUrl 
				) );
			}
			$this->urlRedirect ();
		}
		$this->errorPage ( $this->_errorMessage ( 'empty' ), array (
				'rUrl' => $this->_rUrl 
		) );
	}
	
	public function submenu() {
		$cateId = intval ( $_GET ['id'] );
		if ($cateId) {
			$prodData = $this->_Model->dataContent ($cateId );
			$this->assign ( "CateMain", $prodData );
			$SqlArray ['where'] = 'ty_subid=' . $cateId;
			$result = $this->_Model->dataList ( $SqlArray,false );
			$this->assign ( "CategoryList", $result ['lists'] );
			$this->assign ( "PageContent", $result ['page'] );
			$this->display ();
		} else {
			$this->urlRedirect ();
		}
	}
	public function getAjaxData() {
		$mid = I ( 'post.mid',0,'intval' );
		$sid = I ( 'post.sid' ,0,'intval' );
		if (empty ( $mid ))
			exit ();
		$cateArray =  $this->_Model->dataList (  array (
				'where' => 'ty_subid = ' . $mid 
		) );
		if (is_array ( $cateArray )) {
			$text = '';
			foreach ( $cateArray as $cate ) {
				if ($sid == $cate ['autoid']) {
					$text .= '<option value="' . $cate ['autoid'] . '" selected>' . $cate ['ty_name'] . '</option>';
				} else {
					$text .= '<option value="' . $cate ['autoid'] . '">' . $cate ['ty_name'] . '</option>';
				}
			}
			echo $text;
		} else {
			echo '<option value="0">请选择</option>';
		}
	}
	private function _checkData($sUrl = 'addtable') {
		$dataArray ['ty_name'] = I ( 'post.ty_name','','string' );
		$dataArray ['ty_imgurl'] = I ( 'post.ty_imgurl','','string'  );
		$dataArray ['keywords'] = I ( 'post.ty_keyword','','string'  );
		$dataArray ['title'] = I ( 'post.ty_title','','string'  );
		$dataArray ['description'] = I ( 'post.ty_description','','string'  );
		$dataArray ['ty_intro'] = I ( 'post.ty_intro','','string'  );
		$dataArray ['ty_subid'] = intval ( $_POST ['ty_subid'] );
		$dataArray ['ty_sort'] = intval ( $_POST ['ty_sort'] );
		$dataArray ['ty_index'] = intval ( $_POST ['ty_index'] );
		
		$this->_rUrl .= '/' . $sUrl;
		if (isset ( $_POST ['autoid'] )) {
			$pid = intval ( $_POST ['autoid'] );
			if ($pid) {
				$this->_rUrl = $this->_rUrl . '/id/' . $pid;
			}
		}
		
		if (! $dataArray ['ty_name'])
			$this->errorPage ( $this->_errorMessage ( 'ty_name' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['keywords'])
			$this->errorPage ( $this->_errorMessage ( 'ty_keyword' ), array (
					'rUrl' => $this->_rUrl 
			) );
		
		return $dataArray;
	}
	private function _errorMessage($errorCode) {
		$errorArray = array (
				'ty_name' => '请检查类型名称是否填写？',
				'ty_keyword' => '请检查类型关键字是否填写？',
				'delfail' => '数据删除失败，请检查删除内容！',
				'empty' => '请选择要删除的内容。',
				'addfail' => '数据增加失败。',
				'updatefail' => '数据更新失败。',
				'statusfail' => '数据状态更新失败。',
				'editfail' => '未找到可更新的数据',
				'idfalse' => '数据编号错误' 
		);
		if (isset ( $errorArray [$errorCode] )) {
			return $errorArray [$errorCode];
		} else {
			return "未知错误，等待管理员排查错误内容。";
		}
	}
}