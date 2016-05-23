<?php
namespace  Home\Event;
class ContactEvent extends CommonEvent{
	public function _initialize() {
		$this->_model = D ( 'Contact' );
	}
}