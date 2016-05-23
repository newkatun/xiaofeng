<?php
class CountryAction extends CommonAction{
	private $dataTable,$t_header,$tableName,$pagesize;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="country";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=12;
	}

	public function  reList($strPost=array()){
		if(empty($strPost['order'])==true){
			$strPost['order']=" autoid desc ";
		}
		$result=$this->getpagelist($this->dataTable,$strPost,$this->pagesize);
		return $result;
	}

	public function reTable($strPost=array()){
		if(empty($strPost['order'])==true){
			$strPost['order']=" autoid asc ";
		}
		$result=$this->getlist($this->dataTable ,$strPost);
		return $result;
	}

	public function reContent($strPost){
		$returnArray=$this->getTableCont($this->dataTable,$strPost);
		return $returnArray;
	}
	


	

	

	
	
}