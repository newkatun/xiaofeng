<?php
class SoletypeAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="soletype";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=12;	
	}
	
	public function reTable($strPost=array()){
		$strPost['order']=" autoid asc ";
		$result=$this->getlist($this->dataTable,$strPost);
		return $result;
	}
	
	public function reContent($strPost){
		$returnArray=$this->getTableCont($this->dataTable,$strPost);
		return $returnArray;
	}
}