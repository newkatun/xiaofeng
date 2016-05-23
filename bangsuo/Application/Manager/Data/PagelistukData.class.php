<?php
namespace Manager\Data;

class PagelistukData {
	public function getPageList($strArray=''){
		$strArray['field']=empty($strArray['field'])?' autoid,c_name,c_title,c_nameview,c_datetime':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
		return $strArray;
	}
	
	public function getList($strArray=''){
		$strArray['field']=empty($strArray['field'])?' autoid,c_nameview ':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
		return $strArray;
	}
}