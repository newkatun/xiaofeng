<?php
namespace Manager\Controller;
header("Content-type:text/html;charset=utf-8");
class ReleaselistController extends CommonController{
	private $_Model,$_rUrl;
	public function _initialize(){
		$powerId = 3;
		$this->pageCheck ( $powerId );
		$this->_Model=A('Home/Release','Event');
		$this->_rUrl = __CONTROLLER__;
	}
	
	
	public function index(){
		$strArray = array ();
		if (isset ( $_GET ['keyword'] ) && empty ( $_GET ['keyword'] ) == false) {
			$keyword = I('get.keyword');
			$strArray = array (
					'where' => " rela_name like '%" . $keyword . "%' "
			);
		}
		$productData=$this->_Model->dataList($strArray,false);
		$this->assign('RealseList',$productData['lists']);
		$this->assign('PageContent',$productData['page']);
		$pnum = isset ( $_GET ['p'] ) ? intval ( $_GET ['p'] ) : 1;
		ReturnUrl ( $this->_rUrl, $pnum ); // 保存跳转页面到Cookie
		$this->display();	
	}
	

	
	public function saveadd(){
		$dataArray = $this->_checkData ();
		$updateData = $this->_Model->dataInsert ( $dataArray );
		if ($updateData < 1) {
			$this->errorPage ( $this->_errorMessage ( 'addfail' ), array (
					'rUrl' => $this->_rUrl . '/addtable' 
			) );
		}
		$this->urlRedirect ();
	}
	
	
	public function edittable(){
		$id = intval ( $_GET ['id'] );
		if ($id) {
			$dataReturn = $this->_Model->dataContent ( $id );
			if (! $dataReturn) {
				$this->errorPage ( $this->_errorMessage ( 'editfail' ), array (
						'rUrl' => $this->_rUrl 
				) );
			}
			$this->assign('Rela',$dataReturn);
			$this->display();
			exit();
		}
		$this->errorPage ( $this->_errorMessage ( 'idfalse' ), array (
				'rUrl' => $this->_rUrl 
		) );
	}
	
	public function saveedit(){
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
	
	
	public function dellist(){
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
	
	private function _checkData($sUrl = 'addtable'){
		
		$dataArray['rela_name']=I('post.rela_name');
		$dataArray['rela_url']=I('post.rela_url');
		$dataArray['rela_img']=I('post.rela_img');
		$dataArray['rela_sort']=intval($_POST['rela_sort']);
		$dataArray['rela_keywords']=I('post.rela_keywords');
		$dataArray['rela_intro']=I('post.rela_intro');
		$dataArray['rela_status']=intval($_POST['rela_status']);
		
		$this->_rUrl .= '/' . $sUrl;
		if (isset ( $_POST ['autoid'] )) {
			$pid = intval ( $_POST ['autoid'] );
			if ($pid) {
				$this->_rUrl = $this->_rUrl . '/id/' . $pid;
			}
		}
		
		
		if(!$dataArray['rela_name']) 	$this->errorPage ( $this->_errorMessage ( 'rela_name' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if(!$dataArray['rela_url']) 	$this->errorPage ( $this->_errorMessage ( 'rela_url' ), array (
					'rUrl' => $this->_rUrl 
			) );
		if(!$dataArray['rela_img']) 	$this->errorPage ( $this->_errorMessage ( 'rela_img' ), array (
					'rUrl' => $this->_rUrl 
			) );
		
		return $dataArray;
	}
	
	private function _errorMessage($errorCode) {
		$errorArray = array (
				'rela_name' => '请检查到货名称是否填写？',
				'rela_url' => '请检查到货产品链接是否填写？',
				'rela_img' => '请检查到货宣传图片是否上传？',
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