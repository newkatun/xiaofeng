<?php
class CategorysubAction extends  CommonAction{
	
	private $tablename;
	public  function _initialize(){
		$this->tablename='categorysub';
	}
	public function reCategorysubList($strarray,$lang='uk',$pagesize){
		$result=$this->getpagelist($this->tablename.$lang,$strarray,$pagesize);
		return $result;
	}
	
	public function reCategorysubTable($strarray,$lang='uk'){
		$result=$this->getlist($this->tablename.$lang,$strarray);
		return $result;
	}

	public function reCategorysubCont($strid,$lang='uk'){
		$strarray['where']='autoid='.$strid;
		$result=$this->getcontent($this->tablename.$lang ,$strarray);
		return $result;
	}
}