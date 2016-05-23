<?php
class OrderprodAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="orderprod";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->dataView=$this->dataTable."view";
		$this->pagesize=30;
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
		
		$result=$this->getlist($this->dataView,$strPost);
		
		return $result;
	
	}
	/**
	 * 返回带有分页的product数据
	 *@param int  $strid category编号ID
	 *@return void
	 */
	public function reContent($strPost){
	
		$returnArray=$this->getTableCont($this->dataView,$strPost);
		return $returnArray;
	}

	public function saveData($dataArray,$dataType){
		$flag=true;
		if($dataType['options']=='updateTable'){
			$strArray['where']="autoid=".$dataType['autoid'];
			$strAddStatus=$this->getupdate($this->dataTable,$strArray,$dataArray);
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
			$strStatus=$this->getdelone($this->dataTable,$strArray) ;
		}else{
			$flag=false;
		}
		return $flag;
	}
	
	public function checkData($strPost,$dataType){
		$flag=true;
		$strData['prod_pid'] =intval($strPost['prod_pid']);
		$strData['prod_oid'] =CharsCheck($strPost['prod_oid']);
		$strData['prod_uid'] =intval($strPost['prod_uid']);
		$strData['prod_orderprice'] =floatval($strPost['prod_orderprice']);
		$strData['prod_number'] =intval($strPost['prod_number']);
		
		if($strData['prod_pid']<1) $flag=false;
		if(empty($strData['prod_oid'])) $flag=false;
		//if(!$strData['prod_orderprice']) $flag=false;
		if(!$strData['prod_uid']) $strData['prod_uid']=$_SESSION['UID'];
		if(!$strData['prod_number']) $strData['prod_number']=1;
		if($flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
	}
	
}