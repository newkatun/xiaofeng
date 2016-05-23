<?php

namespace Manager\Controller;

class NewslistController extends CommonController {
	private $_Model, $_newCate, $_newCateData, $_rUrl;
	public function _initialize() {
		$powerId = 5;
		$this->pageCheck ( $powerId );
		$this->_Model = A ( 'Home/News', 'Event' );
		$this->_newCate = A ( 'Home/Newstype', 'Event' );
		$this->_rUrl = __CONTROLLER__;
	}
	private function _cateConstruct() {
		if (is_object ( $this->_newCate )) {
			$this->_newCateData = $this->_newCate->dataList ();
			$this->assign ( 'CategoryList', $this->_newCateData );
		}
		
	}
	public function index() {
		$strArray = array ();
		if (isset ( $_GET ['keyword'] ) && empty ( $_GET ['keyword'] ) == false) {
			$keyword = I ( 'get.keyword' );
			$strArray = array (
					'where' => " news_title like '%" . $keyword . "%' or news_name like '%" . $keyword . "%' or news_content like '%" . $keyword . "%'" 
			);
		}
		$data = $this->_Model->dataList ( $strArray, false );
		$this->assign ( 'NewsList', $data ['lists'] );
		$this->assign ( 'PageContent', $data ['page'] );
		$pnum = isset ( $_GET ['p'] ) ? intval ( $_GET ['p'] ) : 1;
		ReturnUrl ( __CONTROLLER__, $pnum ); // 保存跳转页面到Cookie
		
		$this->display ();
	}
	public function addtable() {
		$this->_cateConstruct ();
		$this->addTableUse ();
	}
	public function saveadd() {
		$dataArray = $this->_checkData ();
		$updateData = $this->_Model->dataInsert ( $dataArray );
		if ($updateData < 1)
			$this->errorPage ( $this->_errorMessage ( 'addfail' ), array (
					'rUrl' => $this->_rUrl . '/addtable' 
			) );
		$this->urlRedirect ();
	}
	public function edittable() {
		$id = intval ( $_GET ['id'] );
		if ($id) {
			$this->_cateConstruct ();
			$dataReturn = $this->_Model->dataContent ( $id );
			if (! $dataReturn) {
				$this->errorPage ( $this->_errorMessage ( 'editfail' ), array (
						'rUrl' => $this->_rUrl 
				) );
			}
			$this->assign ( 'News', $dataReturn );
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
	
	// 改变产品销售状态
	public function statuschg() {
		$name = I ( 'get.name' );
		if (! empty ( $name )) {
			$status = $name == 'upline' ? 1 : 0;
			$pid = $_POST ['id'];
			$dataArray = array (
					'news_status' => $status 
			);
			$updateData = $this->_Model->dataNumber ( $dataArray );
			if ($updateData < 1) {
				$this->errorPage ( $this->_errorMessage ( 'statusfail' ), array (
						'rUrl' => $this->_rUrl 
				) );
			}
		}
		$this->urlRedirect ();
	}
	private function _checkData($sUrl = 'addtable') {
		$dataArray ['news_name'] = I ( 'post.news_name' );
		$dataArray ['news_type'] = intval ( $_POST ['news_type'] );
		$dataArray ['news_image'] = I ( 'post.news_image' );
		$dataArray ['title'] = I('post.news_title' );
		$dataArray ['keywords'] = I('post.news_keyword' );
		
		$dataArray ['description'] = I('post.news_description' );
		$dataArray ['news_author'] = I('post.news_author' );
		$dataArray ['news_source'] = I('post.news_source' );
		$dataArray ['news_hits'] = intval ( $_POST ['news_hits'] );
		$dataArray ['news_sort'] = intval ( $_POST ['news_sort'] );
		
		$dataArray ['news_status'] = intval ( $_POST ['news_status'] );
		$dataArray ['news_content'] = I('post.content' );
		$dataArray ['news_pageid'] =  $this->_newsCatepageId($dataArray ['news_type']);
		
		$this->_rUrl .= '/' . $sUrl;
		if (isset ( $_POST ['autoid'] )) {
			$pid = intval ( $_POST ['autoid'] );
			if ($pid) {
				$this->_rUrl = $this->_rUrl . '/id/' . $pid;
			}
		}
		
		if (! $dataArray ['news_name'])
			$this->errorPage ( $this->_errorMessage ( 'news_name' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['news_content'])
			$this->errorPage ( $this->_errorMessage ( 'news_content' ), array (
					'rUrl' => $this->_rUrl 
			) );
		
		return $dataArray;
	}
	
	/**
	 * 取得大类所属的页面编号
	 */
	private function _newsCatepageId($tid){
			$newsCateData = $this->_newCate->dataContent(array('field'=>'type_subpage','where'=>'autoid = '.$tid));
			return is_array($newsCateData)?$newsCateData['type_subpage']:0;
	}
	
	private function _errorMessage($errorCode) {
		$errorArray = array (
				'news_name' => '请检查文章名称是否填写？',
				'news_content' => '请检查文章内容是否填写？',
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