<?php
class NewsAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="news";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->dataView=$this->dataTable."view";
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
		
		$strData['n_title']  =htmlspecialchars($strPost['n_title']);
		$strData['n_smaimg']=htmlspecialchars($strPost['n_smaimg']);
		$strData['n_typeid'] =intval($strPost['n_typeid']);
		$strData['n_type'] =htmlspecialchars($strPost['n_type']);
		$strData['n_hot'] =intval($strPost['n_hot']);
		$strData['n_intro']=htmlspecialchars($strPost['n_intro']);
		$strData['n_content']=htmlspecialchars($strPost['p_content']);
		$strData['n_keywords']=htmlspecialchars($strPost['n_keywords']);
		$strData['n_description']=htmlspecialchars($strPost['n_description']);
		
		if(empty($strData['n_title'])){
			$flag=false;
			$this->redirect('addtable', '新闻名称不能为空！');
		}

		if(empty($strData['n_smaimg'])){
			$flag=false;
			$this->redirect('addtable', '新闻图片不能为空！');
		}
		if(!$flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
}