<?php
namespace  Home\Event;
class ProductcnEvent extends CommonEvent{
	public function _initialize() {
		$this->_model = D ( 'Prodcn' );
	}
}