<?php
namespace  Home\Event;
class ProdimgEvent extends CommonEvent{
	public function _initialize() {
		$this->_model = D ( 'Prodimg' );
	}
}