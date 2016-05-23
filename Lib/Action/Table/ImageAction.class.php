<?php
class ImageAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="prodimg";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=12;
	}
	

	/**
	 * 返回带有分页的product数据
	 *@param array  $strarray 访问sql数组
	 *@param string $lang 访问语言
	 *@return void
	 */
	public function reTable($strPost=array()){
		if(empty($strPost['order'])){
			$strPost['order']=" autoid asc ";
		}
		$result=$this->getlist($this->dataTable,$strPost);
		return $result;
	}

	
	
}