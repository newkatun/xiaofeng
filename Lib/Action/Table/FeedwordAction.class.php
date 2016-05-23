<?php
class FeedwordAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="feedword";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=12;
	
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
		$result=$this->getpagelist($this->dataTable,$strPost,$this->pagesize);
		return $result;
	}
	/**
	 * 返回带有分页的product数据
	 *@param array  $strarray 访问sql数组
	 *@param string $lang 访问语言
	 *@return void
	 */
	public function reTable($strPost=array()){
		$strarray['order']=" autoid desc ";
		$result=$this->getlist($this->dataTable,$strarray);
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
		
		$strData['f_title']  =htmlspecialchars($strPost['title']);
		$strData['f_uname']=htmlspecialchars($strPost['name']);
		$strData['f_email'] =htmlspecialchars($strPost['email']);
		$strData['f_content'] =htmlspecialchars($strPost['content']);
		
		if(empty($strData['f_title'])){
			$flag=false;
		}
		if(empty($strData['f_uname'])){
			$flag=false;
		}
		if(empty($strData['f_email'])){
			$flag=false;
		}
		if(!$flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
}