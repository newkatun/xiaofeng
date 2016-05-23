<?php
class ProductlistAction extends CommonAction{
	private $pnum;
	public function _initialize(){
		$this->loginStatusCheck();
		$this->pnum='/productlist/index/p/';
	}

	
	public function index(){
		$sqlArray="";
		if(isset($_GET['sid'])){
			$sid=intval($_GET['sid']);
			if($sid) $sqlArray['where']	= " p_ttypeid = " .$sid ;
		} 
		if(isset($_GET['mid'])){
			$mid=intval($_GET['mid']);	
			if($mid) $sqlArray['where']	= " p_typeid = " .$mid ;
		}
		if(isset($_GET['keyword'])){
			$keyword=trim(htmlspecialchars($_GET['keyword']));
			if(!empty($keyword)){
				$sqlArray['where']=" p_id like '%".$keyword."%' or p_name like '%".$keyword."%'" ;
			}
		}
		if(isset($_GET['soleid'])){
			$soleid=intval($_GET['soleid']);
			if($soleid) $sqlArray['where']	= " p_soletype = " .$soleid ;		
		}
		
		if(isset($_GET['p']) && intval($_GET['p'])>0){
			$_SESSION['pnum']=intval($_GET['p']);
		}
		
		$result=R('Table/Productnew/reList',array($sqlArray));
		$this->assign("ProductList",$result['lists']);
		$this->assign("PageContent",$result['page']);
		
		//销售状态列表
		$soleList=R("Table/Soletype/reTable");
		$this->assign("SoleType",$soleList);
		$this->getPublic();
		$this->display();
		
	}
	
	public function addtable(){	
		$mainSql['where']=' 	ty_subid = 0';
		$mainarray=R('Table/Category/reTable',array($mainSql));
		$this->assign("CategoryList",$mainarray);
		$this->getPublic();
		$this->display();
	}

	public function saveadd(){
		$dataType=array('options'=>'insertTable');
		$strData=R("Table/Productnew/checkData",array($_POST,$dataType));
		$pnum=isset($_SESSION['pnum']) && intval($_SESSION['pnum'])?intval($_SESSION['pnum']):1;
		if(!$strData){
			$this->redirect($this->pnum.$pnum, '数据增加成功！');
		}else{
			$this->redirect($this->pnum.$pnum, '数据增加失败！');
		}

	}

	public function edittable(){
		$lid=CheckNum($_GET['id']);
		$pnum=isset($_SESSION['pnum']) && intval($_SESSION['pnum'])?intval($_SESSION['pnum']):1;
		if($lid){
			$result  =R("Table/Productnew/reContent",array($lid));
			if(is_array($result)){
				$mainSql['where']=' 	ty_subid = 0';
				$mainarray=R('Table/Category/reTable',array($mainSql));
				$this->assign("CategoryList",$mainarray);
				
				$subSql['where']=' 	ty_subid = '.$result['p_typeid'];
				$subarray=R('Table/Category/reTable',array($subSql));
				$this->assign("CategorySubList",$subarray);
				$this->assign("Prod",$result);
				$this->getPublic();
				$this->display();
			}else{
				$this->redirect($this->pnum.$pnum,3, "请求数据错误");
			}
		}else{
			$this->redirect($this->pnum.$pnum,3, "请求数据错误");
		}
	}

	public function saveedit(){
		$prodId=intval($_POST['autoid']);
		$dataType=array('options'=>'updateTable','autoid'=>$prodId);
		$strData=R("Table/Productnew/checkData",array($_POST,$dataType));
		$pnum=isset($_SESSION['pnum']) && intval($_SESSION['pnum'])?intval($_SESSION['pnum']):1;
		if(!$strData){
			$this->redirect($this->pnum.$pnum, '数据更新成功！');
		}else{
			$this->redirect($this->pnum.$pnum, '数据更新失败！');
		}
	}
	

	public function dellist(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$reStatus=R("Table/Productnew/delData",array($pid));
			$this->redirect('index', '数据删除成功！');
		}else{
			$this->redirect('index', '数据删除失败！');
		}
	}
	
	public function uponline(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$reStatus=R("Table/Productnew/changeStatus",array($pid,0));
			$this->redirect('index', '数据更新成功！');
		}else{
			$this->redirect('index', '数据更新失败！');
		}
	
	}
	
	
	public function downline(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$reStatus=R("Table/Productnew/changeStatus",array($pid,1));
			$this->redirect('index', '数据更新成功！');
		}else{
			$this->redirect('index', '数据更新失败！');
		}
	
	}
	
	public function soletype(){
		$pid=$_POST['id'];
		$soletype=intval($_POST['soletype']);
		if(!empty($pid)){
			$reStatus=R("Table/Productnew/changeSole",array($pid,$soletype));
			$this->redirect('index', '数据更新成功！');
		}else{
			$this->redirect('index', '数据更新失败！');
		}
	}

	
}