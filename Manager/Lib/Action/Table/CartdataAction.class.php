<?php
class CartdataAction extends CommonAction{
	private $tablename;
	public  function _initialize(){
		$this->tablename="cartdata";
	}
	public function reTable($strarray){
		$result=$this->getlist($this->tablename ,$strarray);
		 return $result;
	}

}