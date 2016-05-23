<?php
class ResultAction extends CommonAction{ 
	public function index(){
		$this->getMenulist();
		$this->getPublic();
		$keyword=CharsCheck($_GET['keyword']);
		$flag=false;
		if(isset($keyword) && !empty($keyword)){
			$sqlArray=array('where'=>"p_id like '%".$keyword."%' or p_name like '%".$keyword."%'  or p_intro like '%".$keyword."%' ");
			$result=R("Table/Productnew/reList",array($sqlArray));
			if(is_array($result['lists'])){
				$dataArray=$result['lists'];
				$this->assign('PageContent',$result['page']);
				$flag=true;
			}else{
				$dataArray=$this->emptyResult();
			}
		}else{
			$dataArray=$this->emptyResult();
		}
		$this->assign('MenuProduct',$dataArray);
		$this->assign('TableList',$flag);
		$this->display();
	
	}
	
	private function emptyResult(){
		$sqlArray=array('limit'=>'0,16');
		$result=R("Table/Productnew/reTable",array($sqlArray));
		return $result;
	}
}