<?php
namespace  Home\Event;
class CachelistEvent extends CommonEvent{
	private $_modelData;
	public function _initialize() {
		$this->_model = D ( 'cachelist' );
	}
	

	
	
}

?>