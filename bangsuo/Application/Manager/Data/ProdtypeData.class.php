<?php
namespace Manager\Data;

class ProdtypeData {
	public function getPageList($strArray=''){
		$strArray['field']=empty($strArray['field'])?' *':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
		return $strArray;
	}

	public function getList($strArray=''){
		$strArray['field']=empty($strArray['field'])?' autoid,ty_name ':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?' ty_sort  desc ,autoid desc ':$strArray['order'];
		return $strArray;
	}
}