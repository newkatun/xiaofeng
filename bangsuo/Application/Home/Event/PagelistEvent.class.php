<?php
namespace Home\Event;
class PagelistEvent extends CommonEvent{
	public function _initialize() {
		
		$this->_model = D ( 'Pagelist' );
	}
}