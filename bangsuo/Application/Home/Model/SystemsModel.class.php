<?php
namespace  Home\Model;
class SystemsModel extends CommonModel{
	public function ShowData($strFuncName,$strArray=''){
		return	$this->$strFuncName($strArray);
	}
}