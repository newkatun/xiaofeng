<?php

class ManagerAction extends  CommonAction{
	private $tableName;
	public function _initialize(){
		$this->tableName='manager';
	}
	/**
	 * 获取分页列表内容
	 * Enter description here ...
	 */
	public function reList(){
		
	}
	/**
	 * 获取表格内容
	 * Enter description here ...
	 */
	public function reTable(){
	
	}
	/**
	 * 获取详细内容
	 * Enter description here ...
	 * @param array $strPost
	 */
	public function reContent($strPost){
		if(is_numeric($strPost)){
			$returnData=$this->getTableCont($this->tableName,$strPost);
		}else{
			$sqlArray['where']=ArrayToString($strPost,'and');
			$returnData=$this->getTableCont($this->tableName,$sqlArray);
		}
		
		return $returnData;
	}
	
	 /** 
	 * 保存提交数据
	 * @param array $dataArray 提交数据内容
	 * @param array $dataType  保存数据所需参数
	 */
	public function saveData($dataArray,$dataType){
		$flag=true;
		if($dataType['options']=='updateTable'){
			$strArray['where']="autoid=".$dataType['autoid'];
			$strAddStatus=$this->getUpdate($this->tableName,$strArray,$dataArray);
		}elseif($dataType['options']=='insertTable'){
			$strreturn=$this->getInsert($this->tableName, $dataArray);
		}else{
			$flag=false;
		}
		return $flag;
	}

}