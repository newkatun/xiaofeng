<?php

namespace Manager\Controller;

header ( "Content-type:text/html;charset=utf-8" );
class ProductlistController extends CommonController {
	private $_Model, $_cagy, $_rUrl, $_cagyData, $_img, $_prodcn, $_view;
	public function _initialize() {
		$powerId = 1;
		// $this->pageCheck ( $powerId );
		$this->_Model = A ( 'Home/Prodconf', 'Event' );
		$this->_rUrl = __CONTROLLER__;
	}
	/**
	 * 产品类别
	 */
	private function _PageConstruct() {
		if (! is_array ( $this->_cagyData )) {
			$this->_cagy = A ( 'Home/Prodtype', 'Event' );
			$this->_cagyData = $this->_cagy->dataList ( array (
					'where' => 'ty_subid = 0' 
			) );
		}
		$this->assign ( 'CategoryList', $this->_cagyData );
		return $this->_cagyData;
	}
	/**
	 * 产品图片
	 * 
	 * @return Ambigous <\Think\Controller, false, Controller, boolean, unknown>
	 */
	private function _ImgConstruct() {
		if (! is_object ( $this->_img )) {
			$this->_img = A ( 'Home/Prodimg', 'Event' );
		}
		return $this->_img;
	}
	
	/**
	 * 产品中文信息
	 * 
	 * @return Ambigous <\Think\Controller, false, Controller, boolean, unknown>
	 */
	private function _ProductcnCunstruct() {
		if (! is_object ( $this->_prodcn )) {
			$this->_prodcn = A ( 'Home/Productcn', 'Event' );
		}
		return $this->_prodcn;
	}
	
	/**
	 * 产品数据视图
	 * 
	 * @return Ambigous <\Think\Controller, false, Controller, boolean, unknown>
	 */
	private function _PViewConstruct() {
		if (! is_object ( $this->_view )) {
			$this->_view = A ( 'Home/Productview', 'Event' );
		}
		return $this->_view;
	}
	public function index() {
		$this->_view = $this->_PViewConstruct ();
		$this->_PageConstruct ();
		$sqlArray = array ();
		if (isset ( $_GET ['keyword'] ) && ! empty ( $_GET ['keyword'] )) {
			$keyword = I ( 'get.keyword', '', 'string' );
			$sqlArray = array (
					'where' => "prod_name like '%" . $keyword . "%' or prod_id like '%" . $keyword . "%' or  keywords like '%" . $keyword . "%'" 
			);
		}
		if (isset ( $_GET ['mid'] ) && intval ( $_GET ['mid'] ) > 0) {
			$sqlArray = array (
					'where' => 'prod_mainid =' . intval ( $_GET ['mid'] ) 
			);
			$this->assign ( 'Mid', intval ( $_GET ['mid'] ) );
		}
		if (isset ( $_GET ['sid'] ) && intval ( $_GET ['sid'] ) > 0)
			$sqlArray = array (
					'where' => 'prod_subid =' . intval ( $_GET ['sid'] ) 
			);
		
		$productData = $this->_view->dataList ( $sqlArray, false );
		$this->assign ( 'ProductList', $productData ['lists'] );
		$this->assign ( 'PageContent', $productData ['page'] );
		
		$pnum = isset ( $_GET ['p'] ) ? intval ( $_GET ['p'] ) : 1;
		ReturnUrl ( $this->_rUrl, $pnum ); // 保存跳转页面到Cookie
		
		$this->display ();
	}
	public function addtable() {
		$this->_PageConstruct ();
		$this->addTableUse ();
	}
	public function saveadd() {
		try {
			$dataArray = $this->_checkData ();
			$this->_img = $this->_ImgConstruct ();
			$imgId = $this->_img->dataInsert ( $dataArray ['img'] );
			$dataArray ['conf'] ['prod_imgid'] = $imgId; // 绑定上传图片编号
			$updateData = $this->_Model->dataInsert ( $dataArray ['conf'] );
			if ($updateData) {
				$dataArray ['cn'] ['pid'] = $updateData; // 绑定产品公共表的自动编号
				$this->_prodcn = $this->_ProductcnCunstruct ();
				$this->_prodcn->dataInsert ( $dataArray ['cn'] );
				$this->_img->dataUpdate ( array (
						'where' => 'autoid = ' . $imgId,
						'data' => Array (
								'img_id' => $updateData 
						) 
				) );
			} else {
				$this->errorPage ( $this->_errorMessage ( 'addfail' ), array (
						'rUrl' => $this->_rUrl . '/addtable' 
				) );
			}
		} catch ( \Exception $e ) {
			$errMsg = $e->getMessage ();
			$this->errorPage ( $this->_errorMessage ( 'addfail' ), array (
					'rUrl' => $this->_rUrl . '/addtable' 
			), $errMsg );
		}
		
		$this->urlRedirect ();
	}
	public function edittable() {
		$id = intval ( $_GET ['id'] );
		if ($id) {
			$this->_PageConstruct ();
			$this->_view = $this->_PViewConstruct ();
			$dataReturn = $this->_view->dataContent ( $id );
			if (! $dataReturn) {
				$this->errorPage ( $this->_errorMessage ( 'editfail' ), array (
						'rUrl' => $this->_rUrl 
				) );
			}
			$this->assign ( 'Prod', $dataReturn );
			$this->display ();
			exit ();
		}
		$this->errorPage ( $this->_errorMessage ( 'idfalse' ), array (
				'rUrl' => $this->_rUrl 
		) );
	}
	public function saveedit() {
		$id = intval ( $_POST ['autoid'] );
		$dataArray = $this->_checkData ( 'edittable' ); // 提交数据
		$this->_view = $this->_PViewConstruct ();
		$dataReturn = $this->_view->dataContent ( $id ); // 产品原有数据
		$dataArray = compareArrays ( $dataArray, $dataReturn ); // 数据进行对比
		print_r ( $dataArray );
		try {
			if (is_array ( $dataArray ['conf'] ) && ! empty ( $dataArray ['conf'] )) { // update productconf table
				$strArray = array (
						'where' => 'autoid=' . $id,
						'data' => $dataArray ['conf'] 
				);
				$this->_Model->dataUpdate ( $strArray );
			}
			if (is_array ( $dataArray ['cn'] ) && ! empty ( $dataArray ['cn'] )) { // update productcn table
				$strArray = array (
						'where' => 'pid=' . $id,
						'data' => $dataArray ['cn'] 
				);
				$this->_prodcn = $this->_ProductcnCunstruct ();
				$this->_prodcn->dataUpdate ( $strArray );
			}
			
			if (is_array ( $dataArray ['img'] ) && ! empty ( $dataArray ['img'] )) { // update ptodimg table
				$strArray = array (
						'where' => 'autoid=' . $dataReturn ['prod_imgid'],
						'data' => $dataArray ['img'] 
				);
				$this->_img = $this->_ImgConstruct ();
				$this->_img->dataUpdate ( $strArray );
			}
		} catch ( \Exception $e ) {
			$this->errorPage ( $this->_errorMessage ( 'updatefail' ), array (
					'rUrl' => $this->_rUrl . '/edittable/id/' . $id 
			), $e->getMessage () );
		}
		$this->urlRedirect ();
	}
	
	/**
	 * 删除内容
	 * 
	 * @see \Manager\Controller\CommonController::dellist()
	 */
	public function dellist() {
		$pid = $_POST ['id'];
		if (! empty ( $pid ) && is_array ( $pid )) {
			$D_id = implode ( ',', $pid );
			try {
				$returnData = $this->_Model->dataDelete ( array (
						'where' => 'autoid in (' . $D_id . ')' 
				) );
				$this->_prodcn = $this->_ProductcnCunstruct ();
				$returnData = $this->_prodcn->dataDelete ( array (
						'where' => 'pid in (' . $D_id . ')' 
				) );
				$this->_img = $this->_ImgConstruct (); // 增加删除图片数据
				$returnData = $this->_img->dataDelete ( array (
						'where' => 'img_id in (' . $D_id . ')' 
				) );
			} catch ( \Exception $E ) {
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
	
	/**
	 * 改变产品销售状态
	 */
	public function statuschg() {
		$name = I ( 'get.name', '', 'string' );
		if (! empty ( $name )) {
			$status = $name == 'upline' ? 'T' : 'N';
			$dataArray = array (
					'prod_show' => $status 
			);
			$pid = I ( 'post.id' );
			$id = implode ( ",", $pid );
			if (! empty ( $id )) {
				$strArray = array (
						'where' => 'autoid  in ('.$id.')',
						'data' => $dataArray 
				);
				$updateData = $this->_Model->dataUpdate ( $strArray );
				if ($updateData < 1) {
					$this->errorPage ( $this->_errorMessage ( 'statusfail' ), array (
							'rUrl' => $this->_rUrl 
					) );
				}
			}
		}
		$this->urlRedirect ();
	}
	
	/**
	 * 检查提交数据内容
	 *
	 * @param string $sUrl        	
	 * @return Ambigous <string, String>
	 */
	private function _checkData($sUrl = 'addtable') {
		$dataArray ['conf'] ['prod_id'] = I ( 'post.prod_id', '', 'string' );
		$dataArray ['conf'] ['prod_sort'] = I ( 'post.prod_sort', '0', 'intval' );
		$dataArray ['conf'] ['prod_status'] = I ( 'post.prod_status', '0', 'intval' );
		$dataArray ['conf'] ['prod_show'] = I ( 'post.prod_show', 'N', 'string' );
		$dataArray ['conf'] ['prod_hits'] = I ( 'post.prod_hits', '0', 'intval' );
		$dataArray ['conf'] ['prod_mainid'] = I ( 'post.prod_mainid', '0', 'intval' );
		$dataArray ['conf'] ['prod_subid'] = I ( 'post.prod_subid', '0', 'intval' );
		
		$dataArray ['cn'] ['prod_name'] = I ( 'post.prod_name', '', 'string' );
		$dataArray ['cn'] ['keywords'] = I ( 'post.prod_keywords' );
		$dataArray ['cn'] ['description'] = I ( 'post.prod_intro' );
		$dataArray ['cn'] ['intro'] = I ( 'post.prod_intro' );
		$dataArray ['cn'] ['prod_attr'] = I ( 'post.prod_attr' );
		$dataArray ['cn'] ['content'] = I ( 'post.content' );
		
		$dataArray ['img'] ['img_url'] = I ( 'post.prod_img', '', 'string' );
		$dataArray ['img'] ['img_name'] = I ( 'post.prod_name', '', 'string' );
		
		$this->_rUrl .= '/' . $sUrl;
		if (isset ( $_POST ['autoid'] )) {
			$pid = intval ( $_POST ['autoid'] );
			if ($pid) {
				$this->_rUrl = $this->_rUrl . '/id/' . $pid;
			}
		}
		if (! $dataArray ['conf'] ['prod_id'])
			$this->errorPage ( $this->_errorMessage ( 'prod_id' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['cn'] ['prod_name'])
			$this->errorPage ( $this->_errorMessage ( 'prod_name' ), array (
					'rUrl' => $this->_rUrl 
			) );
		$dataArray ['cn'] ['prod_url'] = NameToUrl ( $dataArray ['conf'] ['prod_id'] ); // 产品的浏览地址
		
		if (! $dataArray ['img'] ['img_url'])
			$this->errorPage ( $this->_errorMessage ( 'prod_img' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['cn'] ['keywords'])
			$this->errorPage ( $this->_errorMessage ( 'prod_keywords' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['cn'] ['intro'])
			$this->errorPage ( $this->_errorMessage ( 'prod_intro' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if (! $dataArray ['cn'] ['content'])
			$this->errorPage ( $this->_errorMessage ( 'prod_content' ), array (
					'rUrl' => $this->_rUrl 
			) );
		
		return $dataArray;
	}
	private function _errorMessage($errorCode) {
		$errorArray = array (
				'prod_id' => '请检查产品编号是否填写？',
				'prod_name' => '请检查产品名称是否填写？',
				'prod_img' => '请检查产品图片是否上传？',
				'prod_keywords' => '请检查关键字内容是否填写？',
				'prod_intro' => '请检查描述内容是否填写？',
				'prod_content' => '请检查产品介绍内容是否填写？',
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
		if ($strArray1 ['conf'] ['prod_id'] == $strArray2 ['prod_id'])
			unset ( $strArray1 ['conf'] ['prod_id'] );
		if ($strArray1 ['conf'] ['prod_sort'] == $strArray2 ['prod_sort'])
			unset ( $strArray1 ['conf'] ['prod_sort'] );
		if ($strArray1 ['conf'] ['prod_status'] == $strArray2 ['prod_status'])
			unset ( $strArray1 ['conf'] ['prod_status'] );
		if ($strArray1 ['conf'] ['prod_show'] == $strArray2 ['prod_show'])
			unset ( $strArray1 ['conf'] ['prod_show'] );
		if ($strArray1 ['conf'] ['prod_hits'] == $strArray2 ['prod_hits'])
			unset ( $strArray1 ['conf'] ['prod_hits'] );
		if ($strArray1 ['conf'] ['prod_mainid'] == $strArray2 ['prod_mainid'])
			unset ( $strArray1 ['conf'] ['prod_mainid'] );
		if ($strArray1 ['conf'] ['prod_subid'] == $strArray2 ['prod_subid'])
			unset ( $strArray1 ['conf'] ['prod_subid'] );
		
		if ($strArray1 ['cn'] ['prod_name'] == $strArray2 ['prod_name'])
			unset ( $strArray1 ['cn'] ['prod_name'] );
		if ($strArray1 ['cn'] ['keywords'] == $strArray2 ['keywords'])
			unset ( $strArray1 ['cn'] ['keywords'] );
		if ($strArray1 ['cn'] ['intro'] == $strArray2 ['intro']) {
			unset ( $strArray1 ['cn'] ['intro'] );
			unset ( $strArray1 ['cn'] ['description'] );
		}
		if ($strArray1 ['cn'] ['prod_attr'] == $strArray2 ['prod_attr'])
			unset ( $strArray1 ['cn'] ['prod_attr'] );
		if ($strArray1 ['cn'] ['prod_url'] == $strArray2 ['prod_url'])
			unset ( $strArray1 ['cn'] ['prod_url'] );
		
		if ($strArray1 ['img'] ['img_name'] == $strArray2 ['img_name'])
			unset ( $strArray1 ['img'] ['img_name'] );
		if ($strArray1 ['img'] ['img_url'] == $strArray2 ['img_url'])
			unset ( $strArray1 ['img'] ['img_url'] );
		
		return $strArray1;
	}
}
