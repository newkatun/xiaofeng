<?php
class SliderAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="slides";
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
		if(empty($strPost['order'])){
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
		
		$strPost['order']=" autoid desc ";
		
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
		$strData['sl_title']  =htmlspecialchars($strPost['sl_title']);
		$strData['sl_prodname'] =htmlspecialchars($strPost['sl_prodname']);
		$strData['sl_bigimg']=htmlspecialchars($strPost['sl_bigimg']);
		$strData['sl_smaimg']=htmlspecialchars($strPost['sl_smaimg']);
		$strData['sl_linkurl']=htmlspecialchars($strPost['sl_linkurl']);
		$strData['sl_gettime']=htmlspecialchars($strPost['sl_gettime']);
		$strData['sl_sort']=intval($strPost['sl_sort']);
		
		if(empty($strData['sl_title'])){
			$flag=false;
			$this->redirect('addtable', '广告宣传名称不能为空！');
		}
		if(empty($strData['sl_linkurl'])){
			$flag=false;
			$this->redirect('addtable', '广告宣传地址不能为空！');
		}
		if(empty($strData['sl_bigimg'])){
			$flag=false;
			$this->redirect('addtable', '广告宣传LOGO不能为空！');
		}
		if($flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
}