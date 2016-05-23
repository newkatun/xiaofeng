<?php
namespace Home\Event;
use Think\Controller;
class CommonEvent extends Controller{
	  protected  $_model;

		public function dataList($strArray = array(), $pmode = true) {
			$pageMode = $pmode ? 'getList' : 'getPageList';
			$data = $this->_model->ShowData ( $pageMode, $strArray );
			return $data;
		}
		public function dataContent($nid) {
			if(is_int($nid)) $sqlArray =array (
					'where' => 'autoid =' . $nid
			) ;
			if(is_array($nid)) $sqlArray =$nid;
			$dataArticle = $this->_model->ShowData ( 'getTableCont', $sqlArray);
			return $dataArticle;
		}
		public function dataUpdate($sqlArray) {
			return $this->_model->ShowData ( 'getUpdate', $sqlArray );
		}
		public function dataInsert($sqlArray) {
			return $this->_model->ShowData ( 'getInsert', $sqlArray );
		}
		public function dataDelete($sqlArray) {
			return $this->_model->ShowData ( 'getDelData', $sqlArray );
		}
		public function dataNumber($sqlArray){
			return $this->_model->ShowData ( 'getNumberUpdate', $sqlArray );
		}
		
		public function dataFunc($funcName,$sqlArray = array()){
			return $this->_model->ShowData ( $funcName, $sqlArray );
		}
}