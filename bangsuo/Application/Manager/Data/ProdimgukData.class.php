<?php
namespace Manager\Data;
class ProdimgukData{
	public function getList($strArray=''){
			$strArray['field']=empty($strArray['field'])?' autoid,img_id,img_url ':$strArray['field'];
			$strArray['order']=empty($strArray['order'])?' autoid desc ':$strArray['order'];
			return $strArray;
	}
}