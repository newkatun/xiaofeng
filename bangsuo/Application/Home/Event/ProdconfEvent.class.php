<?php
namespace  Home\Event;
class ProdconfEvent extends CommonEvent{
	public function _initialize() {
		$this->_model = D ( 'Prodconf' );
	}
}