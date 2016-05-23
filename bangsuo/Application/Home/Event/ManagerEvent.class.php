<?php
namespace Home\Event;
class ManagerEvent extends CommonEvent{
	public function _initialize() {
	
		$this->_model = D ( 'Manager' );
	}
	

}