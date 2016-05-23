<?php
class MemberAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="member";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=30;
	}
	

	/**
	 * 返回指定内容
	 *@param int  $strid category编号ID
	 *@return void
	 */
	public function reContent($strPost){
	
		$returnArray=$this->getTableCont($this->dataTable,$strPost);
		return $returnArray;
	}
	
	
}