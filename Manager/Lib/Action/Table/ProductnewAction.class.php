<?php
class ProductnewAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="productnew";
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
		
		$strData['p_id'] =htmlspecialchars($strPost['p_id']);
		$strData['p_name']  =htmlspecialchars($strPost['p_name']);
		$strData['p_img']=htmlspecialchars($strPost['p_img']);
		$strData['p_typeid'] =intval($strPost['p_typeid']);
		$strData['p_ttypeid'] =intval($strPost['p_ttypeid']);
		$strData['p_intro']=htmlspecialchars($strPost['p_intro']);
		$strData['p_content']=htmlspecialchars($strPost['p_content']);
		$strData['p_status']=intval($strPost['p_status']);
		$strData['p_oldprice']=floatval($strPost['p_oldprice']);
		$strData['p_price']=floatval($strPost['p_price']);
		$strData['p_keywords']=htmlspecialchars($strPost['p_keywords']);
		$strData['p_description']=htmlspecialchars($strPost['p_description']);
		$strData['p_new'] =intval($strPost['p_new']);
		
		if(empty($strData['p_name'])){
			$flag=false;
			$this->redirect('addtable', '名称不能为空！');
		}
		if(empty($strData['p_id'])){
			$flag=false;
			$this->redirect('addtable', '产品编号不能为空！');
		}
		if(empty($strData['p_img'])){
			$flag=false;
			$this->redirect('addtable', '产品图片不能为空！');
		}
		if(!$flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
	
	public function changeStatus($pid,$strStatus){
		$flag=true;
		if(!empty($pid)){
			$id=implode(",", $pid);
			$strArray['where']=' autoid in ('.$id.')';
			$dataArray['p_status']=$strStatus;
			$strStatus=$this->getupdate($this->dataTable,$strArray,$dataArray) ;
		}else{
			$flag=false;
		}
		return $flag;
	
	}
	
	public function changeSole($pid,$strStatus){
		$flag=true;
		if(!empty($pid)){
			$id=implode(",", $pid);
			$strArray['where']=' autoid in ('.$id.')';
			$dataArray['p_soletype']=$strStatus;
			$strStatus=$this->getupdate($this->dataTable,$strArray,$dataArray) ;
		}else{
			$flag=false;
		}
		return $flag;
	}
}