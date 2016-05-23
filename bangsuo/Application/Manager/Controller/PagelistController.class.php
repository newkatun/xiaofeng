<?php

namespace Manager\Controller;
// use Think\Exception;
header ( "Content-type:text/html;charset=utf-8" );
class PagelistController extends CommonController {
	private $_Model, $_rUrl, $_pageCn, $_pageConf;
	public function _initialize() {
		$powerId = 3;
		$this->pageCheck ( $powerId );
		$this->_Model = A ( 'Home/Pageview', 'Event' );
		$this->_rUrl = __CONTROLLER__;
	}
	public function index() {
		$strArray = array ();
		if (isset ( $_GET ['keyword'] ) && empty ( $_GET ['keyword'] ) == false) {
			$keyword = I ( 'get.keyword' );
			$strArray = array (
					'where' => "c_name like '%" . $keyword . "%' or  	c_title like '%" . $keyword . "%'  or  	c_code like '%" . $keyword . "%'" 
			);
		}
		$data = $this->_Model->dataList ( $strArray, false );
		$this->assign ( 'PageList', $data ['lists'] );
		$this->assign ( 'PageContent', $data ['page'] );
		
		$pnum = isset ( $_GET ['p'] ) ? intval ( $_GET ['p'] ) : 1;
		ReturnUrl ( __CONTROLLER__, $pnum ); // 保存跳转页面到Cookie
		                                     // $this->assign('Autoid',0);
		                                     // $this->assign('Page',$this->_getDataArray());
		$this->display ();
	}
	private function _pageCnConstruct() {
		if (! is_object ( $this->_pageCn )) {
			$this->_pageCn = A ( 'Home/Pagecn', 'Event' );
		}
	}
	private function _pageConfConstruct() {
		if (! is_object ( $this->_pageConf )) {
			$this->_pageConf = A ( 'Home/Pageconf', 'Event' );
		}
	}
	public function addtable() {
		$this->assign ( 'Page', array () );
		$this->display ();
	}
	public function saveadd() {
		try {
			$dataArray = $this->_checkData ();
			if (is_array ( $dataArray )) {
				$this->_pageConfConstruct ();
				$updateData = $this->_pageConf->dataInsert ( $dataArray ['conf'] );
				if ($updateData) { // 公共表插入成功
					$dataArray ['cn'] ['cid'] = $updateData;
					$this->_pageCnConstruct ();
					$cnData = $this->_pageCn->dataInsert ( $dataArray ['cn'] );
					if ($cnData) { // 语言数据表插入成功
						$this->urlRedirect ();
					}
					// 忽略不插入成功,可以在修改中进行操作
				}
			}
			/*
			 * $this->errorPage ( $this->_errorMessage ( 'addfail' ), array ( 'rUrl' => $this->_rUrl . '/addtable' ) );
			 */
		} catch ( \Exception $e ) {
			$this->errorPage ( $this->_errorMessage ( 'addfail' ), array (
					'rUrl' => $this->_rUrl . '/addtable' 
			), $e->getMessage () );
		}
	}
	public function edittable() {
		$id = I ( 'get.id', '0', 'intval' );
		try {
			if ($id) {
				$dataReturn = $this->_Model->dataContent ( $id );
				if (! $dataReturn) {
					$this->errorPage ( $this->_errorMessage ( 'editfail' ), array (
							'rUrl' => $this->_rUrl 
					) );
				}
				$this->assign ( 'Autoid', $id );
				$this->assign ( 'Page', $dataReturn );
				$this->display ();
				exit ();
			}
		} catch ( \Exception $e ) {
			$this->errorPage ( $this->_errorMessage ( 'idfalse' ), array (
					'rUrl' => $this->_rUrl 
			), $e->getMessage () );
		}
	}
	public function saveedit() {
		$id = I ( 'post.autoid', '0', 'intval' );
		try {
			if ($id) {
				$dataArray = $this->_checkData ( 'edittable' );
				$dataReturn = $this->_Model->dataContent ( $id ); // 原有数据
				$dataArray = $this->DataArrayCompare ( $dataArray, $dataReturn ); // 数据比较
				try {
					if (is_array ( $dataArray ['conf'] )) {
						$strArray = array (
								'where' => 'autoid=' . $id,
								'data' => $dataArray ['conf'] 
						);
						$this->_pageConfConstruct ();
						$this->_pageConf->dataUpdate ( $strArray );
					}
					if (is_array ( $dataArray ['cn'] )) {
						$strArray = array (
								'where' => 'cid =' . $id,
								'data' => $dataArray ['cn'] 
						);
						$this->_pageCnConstruct ();
						$this->_pageCn->dataUpdate ( $strArray );
					}
				} catch ( \Exception $e ) {
					$this->errorPage ( $this->_errorMessage ( 'updatefail' ), array (
							'rUrl' => $this->_rUrl . '/edittable/id/' . $id 
					), $e->getMessage () );
				}
				$this->urlRedirect ();
			}
			throw new \Exception ( 'ID错误' );
		} catch ( \Exception $e ) {
			$this->errorPage ( $this->_errorMessage ( 'idfalse' ), array (
					'rUrl' => $this->_rUrl . '/edittable/id/' . $id 
			), $e->getMessage () );
		}
	}
	public function dellist() {
		$pid = $_POST ['id'];
		if (! empty ( $pid ) && is_array ( $pid )) {
			$Did = implode ( ',', $pid );
			try{
				$sqlArray = array (
						'where' => 'autoid in(' . $Did . ')'
				);
				$this->_pageConfConstruct ();
				$returnData = $this->_pageConf->dataDelete ( $sqlArray );
				if($returnData<1) throw new \ErrorException('删除数据失败');
				$sqlArray = array (
						'where' => 'cid in(' . $Did . ')'
				);
				$this->_pageCnConstruct();
				$returnData = $this->_pageCn->dataDelete ( $sqlArray );
				if($returnData<1) throw new \ErrorException('删除数据失败');
			}catch(\Exception $e){
				$this->errorPage ( $this->_errorMessage ( 'delfail' ), array (
						'rUrl' => $this->_rUrl
				),$e->getMessage());
			}
			$this->urlRedirect ();
		}
		$this->errorPage ( $this->_errorMessage ( 'empty' ), array (
				'rUrl' => $this->_rUrl 
		));
	}
	private function _getDataArray() {
		$dataArray ['conf'] ['c_code'] = I ( 'post.c_code', '', 'string' );
		$dataArray ['conf'] ['c_type'] = I ( 'post.c_type', '0', 'int' );
		$dataArray ['conf'] ['c_typetext'] = I ( 'post.c_typetext', '', 'string' );
		$dataArray ['conf'] ['c_image'] = I ( 'post.c_image', '', 'string' );
		$dataArray ['conf'] ['c_sort'] = I ( 'post.c_sort', '0', 'int' );
		$dataArray ['conf'] ['c_index'] = I ( 'post.c_index', 'N', 'string' );
		$dataArray ['conf'] ['c_bottom'] = I ( 'post.c_bottom', 'N', 'string' );
		
		$dataArray ['cn'] ['c_name'] = I ( 'post.c_name', '', 'string' );
		$dataArray ['cn'] ['title'] = I ( 'post.c_title', '', 'string' );
		$dataArray ['cn'] ['c_lurl'] = I ( 'post.c_lurl', '', 'string' );
		$dataArray ['cn'] ['keywords'] = I ( 'post.keywords', '', 'string' );
		$dataArray ['cn'] ['description'] = I ( 'post.description' );
		$dataArray ['cn'] ['c_subtitle'] = I ( 'post.c_subtitle' );
		$dataArray ['cn'] ['content'] = I ( 'post.content');
		
		return $dataArray;
	}
	private function _checkData($sUrl = 'addtable') {
		$dataArray = $this->_getDataArray ();
		$this->_rUrl .= '/' . $sUrl;
		if (isset ( $_POST ['autoid'] )) {
			$pid = intval ( $_POST ['autoid'] );
			if ($pid) {
				$this->_rUrl = $this->_rUrl . '/id/' . $pid;
			}
		}
		if (empty ( $dataArray ['conf'] ['c_code'] ))
			$this->errorPage ( $this->_errorMessage ( 'c_code' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (empty ( $dataArray ['cn'] ['c_name'] ))
			$this->errorPage ( $this->_errorMessage ( 'c_name' ), array (
					'rUrl' => $this->_rUrl 
			) );
		
		if (empty ( $dataArray ['cn'] ['title'] ))
			$this->errorPage ( $this->_errorMessage ( 'c_title' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (empty ( $dataArray ['cn'] ['keywords'] ))
			$this->errorPage ( $this->_errorMessage ( 'c_keywords' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (empty ( $dataArray ['cn'] ['description'] ))
			$this->errorPage ( $this->_errorMessage ( 'c_description' ), array (
					'rUrl' => $this->_rUrl 
			) );
		
		return $dataArray;
	}
	private function _errorMessage($errorCode) {
		$errorArray = array (
				'c_name' => '请检查页面编号是否填写？',
				'c_nameview' => '请检查页面名称是否填写？',
				'c_title' => '请检查页面标题是否上传？',
				'c_keywords' => '请检查页面关键字是否填写？',
				'c_description' => '请检查页面描述是否填写？',
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
	
	/**
	 * 将表格提交的数据与数据库中的数据进行对比
	 * 排除为修改的数据
	 *
	 * @param unknown $strArray1        	
	 * @param unknown $strArray2        	
	 */
	private function DataArrayCompare($strArray1, $strArray2) {
		if ($strArray1 ['conf'] ['c_code'] == $strArray2 ['c_code'])
			unset ( $strArray1 ['conf'] ['c_code'] );
		if ($strArray1 ['conf'] ['c_type'] == $strArray2 ['c_type'])
			unset ( $strArray1 ['conf'] ['c_type'] );
		if ($strArray1 ['conf'] ['c_typetext'] == $strArray2 ['c_typetext'])
			unset ( $strArray1 ['conf'] ['c_typetext'] );
		if ($strArray1 ['conf'] ['c_image'] == $strArray2 ['c_image'])
			unset ( $strArray1 ['conf'] ['c_image'] );
		if ($strArray1 ['conf'] ['c_sort'] == $strArray2 ['c_sort'])
			unset ( $strArray1 ['conf'] ['c_sort'] );
		if ($strArray1 ['conf'] ['c_index'] == $strArray2 ['c_index'])
			unset ( $strArray1 ['conf'] ['c_index'] );
		
		if ($strArray1 ['cn'] ['c_name'] == $strArray2 ['c_name'])
			unset ( $strArray1 ['cn'] ['c_name'] );
		if ($strArray1 ['cn'] ['title'] == $strArray2 ['title'])
			unset ( $strArray1 ['cn'] ['title'] );
		if ($strArray1 ['cn'] ['c_lurl'] == $strArray2 ['c_lurl'])
			unset ( $strArray1 ['cn'] ['c_lurl'] );
		if ($strArray1 ['cn'] ['keywords'] == $strArray2 ['keywords'])
			unset ( $strArray1 ['cn'] ['keywords'] );
		if ($strArray1 ['cn'] ['s_subtitle'] == $strArray2 ['s_subtitle'])
			unset ( $strArray1 ['cn'] ['s_subtitle'] );
		return $strArray1;
	}
}
