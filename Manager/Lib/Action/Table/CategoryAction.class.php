<?php
class  CategoryAction extends  CommonAction{
	private $dataTable,$t_header,$tableName,$pagesize;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="prodtype";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=12;
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
		
		$strData['ty_subid'] =intval($strPost['ty_subid']);
		$strData['ty_name']  =htmlspecialchars($strPost['ty_name']);
		$strData['ty_imgurl']=htmlspecialchars($strPost['ty_imgurl']);
		$strData['ty_sort'] =intval($strPost['ty_sort']);
		$strData['ty_intro']=htmlspecialchars($strPost['ty_intro']);
		
		if(empty($strData['ty_name'])){
			$flag=false;
			$this->redirect('addtable', '类型名称不能为空！');
		}
		if(empty($strData['ty_imgurl'])){
			$flag=false;
			$this->redirect('addtable', '类别图片不能为空！');
		}
		if(!$flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
}