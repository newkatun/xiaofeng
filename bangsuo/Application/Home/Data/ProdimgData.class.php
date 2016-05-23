<?php
namespace Home\Data;
class ProdimgData{
	public function getList($strArray=''){
			$strArray['field']=empty($strArray['field'])?' autoid,img_id,img_url ':$strArray['field'];
			$strArray['order']=empty($strArray['order'])?' autoid asc ':$strArray['order'];
			return $strArray;
	}
}