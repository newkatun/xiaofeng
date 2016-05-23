<?php

namespace Manager\Controller;

class NewstypelistController extends CommonController {
	private $_Model, $_Page, $_rUrl;
	public function _initialize() {
		$powerId = 5;
		$this->pageCheck ( $powerId );
		$this->_Model = A ( 'Home/Newstype', 'Event' );
		$this->_Page = A ( 'Home/Pageview', 'Event' );
		$this->_rUrl = __CONTROLLER__;
	}
	private function _PageConstruct() {
		$pageArray = $this->_Page->dataList (array('field'=>'autoid,c_name','where'=>'c_type in (0,1,2)'));
		$this->assign ( 'PageTable', $pageArray );
		$pageTypeList = $this->_Model->dataList(array('field'=>'autoid,type_name','where'=>'type_main = 0'));
		$this->assign ( 'TypeViewList', $pageTypeList );
	}
	public function index() {
		$strArray = array ();
		if (isset ( $_GET ['keyword'] ) && empty ( $_GET ['keyword'] ) == false) {
			$keyword = I ( 'get.keyword' );
			$strArray = array (
					'where' => " type_name 	 like '%" . $keyword . "%' or type_pagename 	 like '%" . $keyword . "%' or title like '%" . $keyword . "%'" 
			);
		}
		$productData = $this->_Model->dataList ( $strArray, false );
		$this->assign ( 'TypeList', $productData ['lists'] );
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
			$this->errorPage ( $this->_errorMessage ( 'addfail' ), array (
					'rUrl' => $this->_rUrl . '/addtable' 
			) );
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
			$this->assign ( 'Type', $dataReturn );
			$this->display ();
			exit ();
		}
		$this->errorPage ( $this->_errorMessage ( 'idfalse' ), array (
				'rUrl' => $this->_rUrl 
		) );
	}
	public function saveedit() {
		$id = intval ( $_POST ['autoid'] );
		$dataArray = $this->_checkData ( 'edittable' );
		$compareData = $this->_Model->dataContent ( $id );
		$dataArray = compareArray($dataArray,$compareData);
		if(is_array($dataArray)){
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
		}
		$this->urlRedirect ();
	}
	public function dellist() {
		$pid = $_POST ['id'];
		if (! empty ( $pid ) && is_array ( $pid )) {
			$Did = implode ( ',', $pid );
			$sqlArray = array (
					'where' => 'autoid in(' . $Did . ')' 
			);
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
	private function _checkData($sUrl = 'addtable') {
		$dataArray ['type_name'] = I ( 'post.type_name' );
		$dataArray ['type_pagename'] = ucfirst(strtolower(I ( 'post.type_pagename' )));
		$dataArray ['title'] = I ( 'post.type_title' );
		$dataArray ['keywords'] = I ( 'post.type_keyword' );
		$dataArray ['description'] = I ( 'post.type_description' );
		$dataArray ['type_content'] = I ( 'post.content' );
		$dataArray ['type_subpage'] = intval ( $_POST ['type_subpage'] );
		$dataArray ['type_view'] = intval ( $_POST ['type_view'] );
		$dataArray ['type_sort'] = intval ( $_POST ['type_sort'] );
		
		$dataArray ['type_url'] = strtolower(I ( 'post.type_url'));
		$dataArray ['type_index'] = I ( 'post.type_index','N','string');
		$dataArray ['type_subname'] = ucwords(strtolower(I ( 'post.type_subname' )));
		$dataArray ['type_main'] = I ( 'post.type_main','0','intval');
		
		$this->_rUrl .= '/' . $sUrl;
		if (isset ( $_POST ['autoid'] )) {
			$pid = intval ( $_POST ['autoid'] );
			if ($pid) {
				$this->_rUrl = $this->_rUrl . '/id/' . $pid;
			}
		}
		
		if (! $dataArray ['type_name'])
			$this->errorPage ( $this->_errorMessage ( 'type_name' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['title'])
			$this->errorPage ( $this->_errorMessage ( 'title' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['keywords'])
			$this->errorPage ( $this->_errorMessage ( 'type_keyword' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['description'])
			$this->errorPage ( $this->_errorMessage ( 'type_description' ), array (
					'rUrl' => $this->_rUrl 
			) );
		
		return $dataArray;
	}
	private function _errorMessage($errorCode) {
		$errorArray = array (
				'type_name' => '请检查类型页面名称是否填写？',
				'type_title' => '请检查类型页面标题是否填写？',
				'type_keyword' => '请检查类型关键字是否填写？',
				'type_description' => '请检查类型描述内容是否填写？',
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
