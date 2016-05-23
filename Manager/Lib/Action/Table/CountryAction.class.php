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
	

	public function saveData($dataArray,$dataType){
		$flag=true;
		if($dataType['options']=='updateTable'){
			$strArray['where']="autoid=".$dataType['autoid'];
			$strAddStatus=$this->getUpdate($this->dataTable,$strArray,$dataArray);
		}elseif($dataType['options']=='insertTable'){
			$strreturn=$this->getInsert($this->dataTable, $dataArray);
		}else{
			$flag=false;
		}
		return $flag;
	}
	
	public function delData($pid){
		$flag=true;
		if(!empty($pid)){
			$id=implode(",", $pid);
			$strArray['where']=' autoid in ('.$id.')';
			$strStatus=$this->getDelOne($this->dataTable,$strArray) ;
		}else{
			$flag=false;
		}
		return $flag;
	}
	
	public function checkData($strPost,$dataType){
		
		$strData['country_name'] =CharsCheck($strPost['country_name']);
		$strData['country_code']  =CharsCheck($strPost['country_code']);
		$strData['country_shipping']=floatval($strPost['country_shipping']);
		
		if(empty($strData['country_name'])){
			$flag=false;
			$this->redirect('addtable', '国家名称不能为空！');
		}
		if(empty($strData['country_code'])){
			$flag=false;
			$this->redirect('addtable', '国家编号不能为空！');
		}
		if(!$flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
	
	
}