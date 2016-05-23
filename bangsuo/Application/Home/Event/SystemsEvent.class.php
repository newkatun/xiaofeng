<?php
namespace  Home\Event;
class SystemsEvent extends CommonEvent{
	private $_modelData;
	public function _initialize() {
		$this->_model = D ( 'Systems' );
	}
	
	 /**
     * Enter description here ...
     */
    public function publicSystem(){
    	if(S('SystemInfo')){
    		$this->_modelData = S('SystemInfo');
    	}else{
    		$this->_modelData = $this->dataContent(1);
    		S('SystemInfo',$this->_modelData);
    	}
    	return $this->_modelData;
    } 
	
	
	
}

?>