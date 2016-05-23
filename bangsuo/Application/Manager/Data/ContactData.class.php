<?php
namespace Manager\Data;
class ContactData{
	public function getList($strArray=''){
			$strArray['field']=empty($strArray['field'])?' autoid,uname,uemail,utitle,utime ':$strArray['field'];
			$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
			return $strArray;
	}
	
	public function getPageList($strArray=''){
		$strArray['field']=empty($strArray['field'])?'autoid,uname,uemail,utitle,utime':$strArray['field'];
		$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
		return $strArray;
	}
}