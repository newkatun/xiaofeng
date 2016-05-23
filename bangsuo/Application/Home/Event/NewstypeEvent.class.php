<?php
namespace Home\Event;
class NewstypeEvent extends CommonEvent{
	public function _initialize() {
		$this->_model = D ( 'Newstype' );
	}
	
	
	public function newsTypeList($arr){
		$sqlArray = array('field'=>'autoid,type_pagename,type_name,type_title,type_description');
		$arr = array_merge($sqlArray,$arr);
		return $this->dataList($arr);
	}
	
	public function newsTypeData($strName,$array = array()){
		if(is_int($strName)){
			$sqlArray = array('where'=>'autoid  ='.$strName);
		}else{
			$pageName = ucfirst(strtolower($strName));
			$sqlArray = array('where'=>"type_pagename ='".$strName."'");
		}
		$sqlArray = array_merge($sqlArray,$array);
		return  $this->dataContent($sqlArray);
	}
}