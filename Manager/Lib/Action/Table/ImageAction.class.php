<?php
class ImageAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="prodimg";
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
			$strKey=0;
			foreach($dataArray['imgurl'] as $dataUrl){
				$ImgArray['pi_prodid']=intval($dataArray['prodid']);
				$ImgArray['pi_prodcode']=$dataArray['imgname'][$strKey];
				$ImgArray['pi_bigimg']=$dataUrl;
				$ImgArray['pi_smaimg']=str_replace("/image/", "/smallimg/", $dataUrl);
				$ImgArray['pi_imgtype']=1;
				$strreturn=$this->getInsert($this->dataTable, $ImgArray);
				$strKey++;
			}
		}else{
			$flag=false;
		}
		return $flag;
	}
	
	public function delData($pid){
		$flag=true;
		if(!empty($pid)){
			if(is_numeric($pid)){
				$id=$pid;
			}else{
				$id=implode(",", $pid);
			}
			
			$strArray['where']=' autoid in ('.$id.')';
			$strStatus=$this->getdelone($this->dataTable,$strArray) ;
		}else{
			$flag=false;
		}
		return $flag;
	}
	
	public function checkData($strPost,$dataType){
		if(!empty($strPost)){
			$flag=false;
		}
		if(!$flag){
			$strReturn=$this->saveData($strPost,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
}