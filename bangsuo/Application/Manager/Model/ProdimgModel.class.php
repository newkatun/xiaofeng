<?php
namespace Manager\Model;
class ProdimgModel extends CommonModel{
	private $dataSql;
	public function _initialize(){
		$this->dataSql=new \Home\Data\ProdimgData();
	}
	
	public function ShowData($strFuncName,$strArray=''){

			return $this->$strFuncName($strArray);
	
	}
}
