<?php
class SystemsAction extends CommonAction{ 
	private $dataTable,$t_header,$tableName;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="systems";
		$this->tableName=$this->t_header.$this->dataTable;
	}
	public function reContent(){
		$strPost=array('limit'=>'0,1','order'=>'autoid desc');
		$returnArray=$this->getTableCont($this->dataTable,$strPost);
		return $returnArray;
	}
}