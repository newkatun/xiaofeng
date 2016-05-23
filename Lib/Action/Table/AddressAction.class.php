<?php
class AddressAction extends  CommonAction{ 
private $dataTable,$t_header,$tableName,$pagesize,$dataView;
	public function  _initialize(){
		$this->t_header=C('DB_PREFIX');
		$this->dataTable="address";
		$this->tableName=$this->t_header.$this->dataTable;
		$this->dataView=$this->dataTable."view";
		$this->pagesize=30;
	}
	
	/**
	 * 返回不带有分页的数据
	 *@param array  $strPost 访问sql数组
	 *@return void
	 */
	public function reTable($strPost=array()){
		$strPost['order']=" autoid asc ";
		$result=$this->getlist($this->dataTable,$strPost);
		return $result;
	}
	//处理运费
	public function reTableView($strPost=array()){
		$strPost['order']=" autoid asc ";
		$result=$this->getlist($this->dataView,$strPost);
		return $result;
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
	//处理运费
	public function reContentView($strPost){
		
		$returnArray=$this->getTableCont($this->dataView,array('where'=>'autoid = '.$strPost));
		return $returnArray;
	}
	
	public function saveData($dataArray,$dataType){
		$flag=true;
		if($dataType['options']=='updateTable'){
			$strArray['where']=empty($dataType['where'])?"autoid=".$dataType['autoid']:$dataType['where'];
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
		$strData['add_firstname'] =CharsCheck($strPost['guestaccptname']);
		$strData['add_lastname'] =CharsCheck($strPost['guestlastname']);
		$strData['add_zipcode'] =CharsCheck($strPost['guestpostcode']);
		$strData['add_telephone'] =CharsCheck($strPost['guestphone']);
		$strData['add_country'] =CharsCheck($strPost['guestcountry']);
		$strData['add_cityname'] =CharsCheck($strPost['guestcity']);
		$strData['add_address'] =CharsCheck($strPost['guestaddress']);
		$strData['add_gname'] =CharsCheck($_SESSION['UEMAIL']);
		$strData['add_gid'] =CharsCheck($_SESSION['UID']);
		
		if(empty($strData['add_firstname'])){
			$flag=false;
			$this->redirect('addtable', '名称不能为空！');
		}
		if(empty($strData['add_lastname'])){
			$flag=false;
			$this->redirect('addtable', '名称不能为空！');
		}
		if(empty($strData['add_telephone'])){
			$flag=false;
			$this->redirect('addtable', '联系方式不能为空！');
		}
		if(empty($strData['add_country'])){
			$flag=false;
			$this->redirect('addtable', '国家不能为空！');
		}
		if(empty($strData['add_cityname'])){
			$flag=false;
			$this->redirect('addtable', '城市不能为空！');
		}
		if(empty($strData['add_address'])){
			$flag=false;
			$this->redirect('addtable', '详细地址不能为空！');
		}
		if($flag){
			$strReturn=$this->saveData($strData,$dataType);
			return $strReturn;
		}else{
			return false;
		}
		
	}
}