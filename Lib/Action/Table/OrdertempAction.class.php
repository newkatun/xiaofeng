<?php
class OrdertempAction extends CommonAction{ 
	
	private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="ordertemp";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->dataView = $this->dataTable."view";
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
		$result=$this->getpagelist($this->dataView,$strPost,$this->pagesize);
		return $result;
	}
	/**
	 * 返回不带有分页的数据
	 *@param array  $strPost 访问sql数组
	 *@return void
	 */
	public function reTable($strPost=array()){
		$strPost['order']=" autoid asc ";
		$result=$this->getlist($this->dataView,$strPost);
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
			if(isset($dataType['where'])){
				$strArray['where']=$dataType['where'];
			}else{
				$strArray['where']="autoid=".$dataType['autoid'];
			}
			$strAddStatus=$this->getupdate($this->dataTable,$strArray,$dataArray);
		}elseif($dataType['options']=='insertTable'){
			$strreturn=$this->getInsert($this->dataTable, $dataArray);
		}else{
			$flag=false;
		}
		return $flag;
	}
	
	public function delData($pid,$sqlText=''){
		$flag=false;
		if(!empty($pid)){
			if(is_array($pid))$pid=implode(",", $pid);
			$pattren='/[\d+(,)?+]+/';
			preg_match($pattren,$pid,$straId);
			$strArray['where']=' autoid in ('.$straId[0].')';
			$sqlText=empty($sqlText)?'':$sqlText;
			$strArray['where'].=$sqlText;
			$strStatus=$this->getdelone($this->dataTable,$strArray) ;
			if($strStatus)$flag=true;
		}
		return $flag;
	}
	
	public function checkData($strPost,$dataType=array()){
		$flag=true;
		$strData['temp_uname'] =htmlspecialchars($strPost['temp_uname']);
		$strData['temp_uid'] =intval($strPost['temp_uid']);
		$strData['temp_pid'] =intval($strPost['temp_pid']);
		$strData['temp_qty'] =intval($strPost['temp_qty']);
		if(empty($strData['temp_uname'])){
			$flag=false;
		}
		if(!$strData['temp_pid']){
			$flag=false;
		}
		if(!$strData['temp_qty'])$strData['temp_qty']=1;
		if($flag){
			$strSql=" temp_uname='".$strData['temp_uname']."' and temp_pid=".$strData['temp_pid'];
			if(isset($strData['autoid'])) $strSql.=" and autoid =".$strData['autoid'];
			$sqlArray=array('where'=>$strSql);
			$restult=$this->reContent($sqlArray);
			if(is_array($restult)){
				$dataType=array('options'=>'updateTable','where'=>$strSql);
			}else{
				$dataType=array('options'=>'insertTable');
			}
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
	}
	/**
	 * 顾客注册或登录之后，将临时购买的商品绑定到会员
	 */
	public function orderIntoUser(){
		$tempName=$_COOKIE['User-keys'];
		$dataArray['temp_uname']=$_SESSION['UEMAIL'];
		$dataArray['temp_uid']=$_SESSION['UID'];
		$result=false;
		if(!empty($tempName)){
			$sqlText="temp_uname = '".$tempName."'";
			$dataList=$this->reTable(array('where'=>$sqlText));
			if(is_array($dataList)){
				$dataType=array('options'=>'updateTable','where'=>$sqlText);
				$result=$this->saveData($dataArray,$dataType);	
			}
		}
		return $result;
	}
}