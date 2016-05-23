<?php
class PageAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="config";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=5;	
	}
	
	public function reContent($strPost){
		$returnArray=$this->getTableCont($this->dataTable,$strPost);
		return $returnArray;
	}
}