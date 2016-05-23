<?php
namespace Home\Data;
class NewsData {
	public function getList($strArray=''){
			$strArray['field']=empty($strArray['field'])?' * ':$strArray['field'];
			$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
			$strArray['limit']=empty($strArray['limit'])?' 0,6 ':$strArray['limit'];
			return $strArray;
	}
	
	public function getPageList($strArray=''){
			$strArray['field']=empty($strArray['field'])?' * ':$strArray['field'];
			$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
			return $strArray;
	}
}