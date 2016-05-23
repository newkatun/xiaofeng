<?php

namespace Home\Data;

class PageviewData {
	public function getList($strArray = '') {
		if (isset ( $strArray ['field'] ))
			$strArray ['field'] = empty ( $strArray ['field'] ) ? ' * ' : $strArray ['field'];
		if (isset ( $strArray ['order'] ))
			$strArray ['order'] = empty ( $strArray ['order'] ) ? ' autoid desc ' : $strArray ['order'];
		if (isset ( $strArray ['limit'] ))
			$strArray ['limit'] = empty ( $strArray ['limit'] ) ? ' 0,6 ' : $strArray ['limit'];
		return $strArray;
	}
}

?>