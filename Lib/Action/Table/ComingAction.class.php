<?php
class ComingAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="countdown";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=6;
		

		
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
		
		if(empty($strPost['order'])){
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
		
		$strData['cd_name']  =htmlspecialchars($strPost['cd_name']);
		$strData['cd_productcode'] =htmlspecialchars($strPost['cd_productcode']);
		$strData['cd_image']=htmlspecialchars($strPost['cd_image']);
		$strData['cd_type']=htmlspecialchars($strPost['cd_type']);
		$strData['cd_linkurl']=htmlspecialchars($strPost['cd_linkurl']);
		$strData['cd_endtime']=htmlspecialchars($strPost['cd_endtime']);
		$strData['cd_intro']=htmlspecialchars($strPost['cd_intro']);
		
		if(empty($strData['cd_name'])){
			$flag=false;
			$this->redirect('addtable', '广告宣传名称不能为空！');
		}
		if(empty($strData['cd_linkurl'])){
			$flag=false;
			$this->redirect('addtable', '广告宣传地址不能为空！');
		}
		if(empty($strData['cd_image'])){
			$flag=false;
			$this->redirect('addtable', '广告宣传图片O不能为空！');
		}
		if(empty($strData['cd_endtime'])){
			$flag=false;
			$this->redirect('addtable', '广告宣传倒计时不能为空！');
		}
		if(!$flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
}