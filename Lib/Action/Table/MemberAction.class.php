<?php
class MemberAction extends CommonAction {
	private $dataTable,$t_header,$tableName,$pagesize;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="member";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->pagesize=30;
	}
	

	/**
	 * 返回指定内容
	 *@param int  $strid category编号ID
	 *@return void
	 */
	public function reContent($strPost){
		$returnArray=$this->getTableCont($this->dataTable,$strPost);
		return $returnArray;
	}
	
	public function saveData($dataArray,$dataType){
		$flag=true;
		if($dataType['options']=='updateTable'){
			if(isset($dataType['autoid'])){
				$strArray['where']="autoid=".$dataType['autoid'];
			}else{
				$strArray['where']=$dataType['where'];
			}
			$strAddStatus=$this->getUpdate($this->dataTable,$strArray,$dataArray);
		}elseif($dataType['options']=='insertTable'){
			$strreturn=$this->getInsert($this->dataTable, $dataArray);
			$flag=$strreturn;
		}else{
			$flag=false;
		}
		return $flag;
	}
	
	public function checkData($strPost,$dataType){
		$flag=true;
		$strData['mem_name'] =htmlspecialchars($strPost['name']);
		$strData['mem_email'] =htmlspecialchars($strPost['email']);
		$strData['mem_pwd'] =htmlspecialchars($strPost['passowrd']);
		if(empty($strData['mem_name'])){
			$flag=false;
			$this->redirect('addtable', '名称不能为空！');
		}
		if(empty($strData['mem_email'])){
			$flag=false;
			$this->redirect('addtable', '邮箱不能为空！');
		}
		if(empty($strData['mem_pwd'])){
			$flag=false;
			$this->redirect('addtable', '密码不能为空！');
		}
		
		if($flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
			
		}else{
			return false;
		}
		
	}
}