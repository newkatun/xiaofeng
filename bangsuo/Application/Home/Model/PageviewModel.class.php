<?php
namespace Home\Model;
class PageviewModel extends CommonModel{
	private $dataSql;
	public function _initialize(){
		$this->dataSql=new \Home\Data\PageviewData();
	}	
	public function ShowData($strFuncName,$strArray=''){
		if(method_exists($this->dataSql, $strFuncName)){
			return	$this->$strFuncName($this->dataSql->$strFuncName($strArray));
		}else{
			return $this->$strFuncName($strArray);
		}
	}
}

?>