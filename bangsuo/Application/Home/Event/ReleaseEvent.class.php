<?php

namespace Home\Event;

class ReleaseEvent extends CommonEvent {
	public function _initialize() {
		$this->_model = D ( 'Release' );
	}
	public function slideList() {
		return $this->dataList ( array (
				'field' => 'rela_name,rela_img,rela_url',
				'where' => 'rela_status = 1',
				'order' => ' rela_sort desc ,autoid desc',
				'limit' => '0,3'
		) );
	}
}

?>