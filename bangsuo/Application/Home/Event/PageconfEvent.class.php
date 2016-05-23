<?php
namespace Home\Event;
class PageconfEvent extends CommonEvent{
	public function _initialize() {
		$this->_model = D ( 'Pageconf' );
	}
}

?>