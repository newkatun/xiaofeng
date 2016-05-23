<?php
namespace Home\Event;
class ProductlistEvent extends CommonEvent {
	public function _initialize() {
		$this->_model = D ( 'Product' );
	}
}

?>