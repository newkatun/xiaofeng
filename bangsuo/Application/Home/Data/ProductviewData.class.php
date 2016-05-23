<?php
namespace Home\Data;
class ProductviewData {
	public function getList($strArray=''){
			$strArray['field']=empty($strArray['field'])?' autoid,prod_id,prod_name,img_url ':$strArray['field'];
			$strArray['order']=empty($strArray['order'])?' prod_sort desc ,autoid desc ':$strArray['order'];
			$strArray['limit']=empty($strArray['limit'])?' 0,6 ':$strArray['limit'];
			return $strArray;
	}
	
	public function getPageList($strArray=''){
		$strArray['field']=empty($strArray['field'])?' * ':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?' prod_sort desc ,autoid desc ':$strArray['order'];
		return $strArray;
	}
	
	public function getTableCont($strArray){
		return $strArray;
	}
}