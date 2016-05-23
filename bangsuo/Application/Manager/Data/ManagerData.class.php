<?php
namespace Manager\Data;

class ManagerData {
	public function getTableCont($strArray){	
		return $strArray;
	}
	public function getPageList($strArray=''){
		$strArray['field']=empty($strArray['field'])?' * ':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
		return $strArray;
	}
	public function checkManager($strName){
		return array('where'=>"user_name ='".$strName."'");
	}
}