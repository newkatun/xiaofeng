<?php
class  CategoryAction extends  CommonAction{
	private $dataTable,$t_header,$tableName,$pagesize;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="prodtype";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=6;
	}
	/**
	 * 返回带有分页的category数据
	 *@param array  $strarray 访问sql数组
	 *@return void
	 */
	public function  reList($strPost=array()){
		if(empty($strPost['order'])==true){
			$strPost['order']=" autoid desc ";
		}
		$result=$this->getpagelist($this->dataTable,$strPost,$this->pagesize);
		return $result;
	}
	/**
	 * 返回带有分页的category数据
	 *@param array  $strPost 访问sql数组
	 *@return void
	 */
	public function reTable($strPost=array()){
		if(empty($strPost['order'])==true){
			$strPost['order']=" autoid asc ";
		}
		$result=$this->getlist($this->dataTable ,$strPost);
		return $result;
	}
	/**
	 * 返回带有分页的category数据
	 *@param int  $strid category编号ID
	 *@return void
	 */
	public function reContent($strPost){
		$returnArray=$this->getTableCont($this->dataTable,$strPost);
		return $returnArray;
	}
	
	public function reProduct($sqlArray=array()){
		$CatalogSql=array('field'=>'autoid,ty_name','where'=>' ty_subid = 0 ','limit'=>'0,3','order'=>'ty_sort desc,autoid desc');
		$CatalogArray=R("Table/Category/reTable",array($CatalogSql));
		foreach($CatalogArray as $n=>$catalog){
			$CatalogArray[$n]['ProductList']=R("Table/Productnew/reTable",array(array('field'=>'autoid,p_id,p_name,p_img','where'=>'p_typeid='.$CatalogArray[$n]['autoid'],'limit'=>'0,6')));
		}
		return $CatalogArray;
	}
}