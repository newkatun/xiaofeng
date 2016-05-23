<?php
namespace Home\Data;

class NewstypeData {
	public function getPageList($strArray=''){
		$strArray['field']=empty($strArray['field'])?' *':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
		return $strArray;
	}
	
	public function getList($strArray=''){
		$strArray['field']=empty($strArray['field'])?' * ':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?' type_sort  desc ,autoid desc ':$strArray['order'];
		return $strArray;
	}
}