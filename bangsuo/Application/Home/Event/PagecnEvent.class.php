<?php
namespace Home\Event;
class PagecnEvent extends CommonEvent{
	public function _initialize() {
		$this->_model = D ( 'Pagecn' );
	}
}

?>