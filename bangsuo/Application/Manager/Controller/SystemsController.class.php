<?php

namespace Manager\Controller;

class SystemsController extends CommonController {
	private $_Model,$_rUrl;
	public function _initialize() {
		$powerId = 2;
		$this->pageCheck ( $powerId );
		$this->_Model = A ( 'Home/Systems','Event' );
		$this->_rUrl = __CONTROLLER__;
	}
	public function index() {
		$dataReturn = $this->_Model->dataContent (  1 );
		if (! $dataReturn) {
			$this->errorPage ( $this->_errorMessage ( 'editfail' ), array (
					'rUrl' => $this->_rUrl
			) );
		}
		$this->assign ( System, $dataReturn );
		$this->display ();
	}
	public function addtable() {
		$id = intval ( $_POST ['autoid'] );
		$dataArray = $this->_checkData ( 'edittable' );
		$strArray = array (
				'where' => 'autoid=' . $id,
				'data' => $dataArray 
		);
		$updateData =  $this->_Model->dataUpdate ($strArray);
		if ($updateData < 1) {
			$this->errorPage ( $this->_errorMessage ( 'updatefail' ), array (
					'rUrl' => $this->_rUrl 
			) );
		}
		$this->urlRedirect ();
	}
	public function _checkData($sUrl = 'index') {
		$dataArray ['sy_company'] = I('post.sy_company' );
		$dataArray ['sy_hostname'] = I('post.sy_hostname' );
		$dataArray ['sy_telephone'] = I('post.sy_telephone' );
		$dataArray ['sy_faxnumber'] = I('post.sy_faxnumber' );
		$dataArray ['sy_memail'] = I('post.sy_memail' );
		$dataArray ['sy_semail'] = I('post.sy_semail' );
		$dataArray ['sy_webpassword'] = I('post.sy_webpassword');
		$dataArray ['sy_websmtp'] = I('post.sy_websmtp' );
		$dataArray ['sy_recordcode'] = I('post.sy_recordcode' );
		$dataArray ['sy_spenumber'] = I('post.sy_spenumber' );
		$dataArray ['sy_qqnumber'] = I('post.sy_qqnumber' );
		$dataArray ['sy_erweima'] = I('post.sy_erweima' );
		$dataArray ['sy_address'] = I('post.sy_address' );
		
		if (! $dataArray ['sy_company'])
			$this->errorPage ( $this->_errorMessage ( 'sy_company' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['sy_hostname'])
			$this->errorPage ( $this->_errorMessage ( 'sy_hostname' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['sy_telephone'])
			$this->errorPage ( $this->_errorMessage ( 'sy_telephone' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['sy_faxnumber'])
			$this->errorPage ( $this->_errorMessage ( 'sy_faxnumber' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['sy_memail'])
			$this->errorPage ( $this->_errorMessage ( 'sy_memail' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['sy_semail'])
			$this->errorPage ( $this->_errorMessage ( 'sy_semail' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['sy_webpassword'])
			$this->errorPage ( $this->_errorMessage ( 'sy_webpassword' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['sy_recordcode'])
			$this->errorPage ( $this->_errorMessage ( 'sy_recordcode' ), array (
					'rUrl' => $this->_rUrl 
			) );
		
		return $dataArray;
	}
	private function _errorMessage($errorCode) {
		$errorArray = array (
				'sy_company' => '请检查网站名称是否填写？',
				'sy_hostname' => '请检查网站域名是否填写？',
				'sy_telephone' => '请检查联系方式是否上传？',
				'sy_faxnumber' => '请检查传真号码内容是否填写？',
				'sy_memail' => '请检查管理员邮箱是否填写？',
				'sy_semail' => '请检查发送邮箱是否填写？',
				'sy_webpassword' => '请检查发送邮箱密码是否填写？',
				'sy_recordcode' => '请检查网站备案号是否填写？',
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