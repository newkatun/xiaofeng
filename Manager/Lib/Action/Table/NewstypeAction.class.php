<?php
class NewstypeAction extends CommonAction{

	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="newstype";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=12;	
	}
	/**
	 * 返回带有分页的数据
	 *@param array  $strPost 访问sql数组
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
	 * 返回不带有分页的数据
	 *@param array  $strPost 访问sql数组
	 *@return void
	 */
	public function reTable($strPost=array()){
		$strPost['order']=" autoid asc ";
		$result=$this->getlist($this->dataTable,$strPost);
		return $result;
	}
	/**
	 * 返回带有分页的product数据
	 *@param int  $strPost 编号ID
	 *@return void
	 */
	public function reContent($strPost){
		$returnArray=$this->getTableCont($this->dataTable,$strPost);
		return $returnArray;
	}
	
	/**
	 * 
	 * 保存提交数据
	 * @param array $dataArray 提交数据内容
	 * @param array $dataType  保存数据所需参数
	 */
	public function saveData($dataArray,$dataType){
		$flag=true;
		if($dataType['options']=='updateTable'){
			$strArray['where']="autoid=".$dataType['autoid'];
			$strAddStatus=$this->getupdate($this->dataTable,$strArray,$dataArray);
		}elseif($dataType['options']=='insertTable'){
			$strreturn=$this->getinsert($this->dataTable, $dataArray);
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
			$strStatus=$this->getdelone($this->dataTable,$strArray) ;
		}else{
			$flag=false;
		}
		return $flag;
	}
	
	public function checkData($strPost,$dataType){
		$flag=true;
		$strData['atype_name'] =htmlspecialchars($strPost['atype_name']);
		$strData['atype_title'] =htmlspecialchars($strPost['atype_title']);
		$strData['atype_sort'] =intval($strPost['atype_sort']);
		$strData['atype_content'] =htmlspecialchars($strPost['p_content']);
		$strData['atype_type'] =intval($strPost['atype_type']);
		$strData['atype_service'] =intval($strPost['atype_service']);
		$strData['atype_keywords'] =htmlspecialchars($strPost['atype_keywords']);
		$strData['atype_descrption'] =htmlspecialchars($strPost['atype_descrption']);
		if(empty($strData['atype_name'])){
			$flag=false;
			$this->redirect('addtable', '名称不能为空！');
		}
		if($flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
}