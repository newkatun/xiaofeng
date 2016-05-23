<?php
class CartlistAction extends CommonAction{
	private $tablename;
	public  function _initialize(){
		$this->tablename="cartlist";
	}
	public function reList($strarray,$pagesize){
		$result=$this->getpagelist($this->tablename ,$strarray,$pagesize);
		 return $result;
	}

}