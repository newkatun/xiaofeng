<?php
class ProductnewAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="productnew";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->dataView=$this->dataTable."view";
		$this->pagesize=24;
	}
	
/**
	 * 返回带有分页的product数据
	 *@param array  $strarray 访问sql数组
	 *@param string $lang 访问语言
	 *@param int $pagesize 页面显示数据数
	 *@return void
	 */
	public function  reList($strPost=array()){
		if(empty($strPost['order'])==true){
			$strPost['order']=" autoid desc ";
		}
		$result=$this->getpagelist($this->dataView,$strPost,$this->pagesize);
		return $result;
	}
/**
	 * 返回带有分页的product数据
	 *@param array  $strarray 访问sql数组
	 *@param string $lang 访问语言
	 *@return void
	 */
	public function reTable($strPost=array()){
		
		if(empty($strPost['order'])==true){
			$strPost['order']=" autoid desc ";
		}
		
		$result=$this->getlist($this->dataTable,$strPost);
		
		return $result;
	
	}
	/**
	 * 返回带有分页的product数据
	 *@param int  $strid category编号ID
	 *@return void
	 */
	public function reContent($strPost){
	
		$returnArray=$this->getTableCont($this->dataTable,$strPost);
		return $returnArray;
	}
	
	/**
	 * 显示首页右边模块产品
	 */
	public function reIndex($strPost=array()){
		if(empty($strPost['order'])){
			$strPost['order']='autoid desc';
		}
		if(empty($strPost['limit'])){
			$strPost['limit']='0,6';
		}
		if(empty($strPost['field'])){
			$strPost['field']='autoid,p_id,p_name,p_img';
		}
		$returnArray=$this->getlist($this->dataView,$strPost);
		return $returnArray;
	}
	
}