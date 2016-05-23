<?php
namespace Home\Data;

class ProdtypeData {
	public function getList($strArray=''){
		if(!isset($strArray['field'])) $strArray['field'] = 'autoid,ty_name';
		if(!isset($strArray['order']))$strArray['order'] = ' ty_sort desc ,autoid desc ';
		if(!isset($strArray['limit'])) $strArray['limit'] = '0,6';
		return $strArray;
	}

	public function getPageList($strArray=''){
		$strArray['field']=empty($strArray['field'])?' * ':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?'  ty_sort desc ,autoid desc':$strArray['order'];
		return $strArray;
	}

	public function getTableCont($strArray){
		return $strArray;
	}
}