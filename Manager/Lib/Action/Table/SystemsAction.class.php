<?php
class SystemsAction extends  CommonAction{
	private $tableName;
	public function  _initialize(){
		$this->tableName="systems";
	}
	/**
	 * 获取网站配置参数
	 */
	public  function  reContent(){
		$returnData=$this->getTableCont($this->tableName,1);	
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