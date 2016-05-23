<?php
class CategorysublistAction extends  CommonAction{
	private $dataable,$language,$t_header,$tablename,$mid,$langName,$tableDefault;
	public function  _initialize(){
		$this->language=$_COOKIE['MLANGUAGE'];
		if(empty($this->language)){
			$this->language=APP_USELANG;
		}
		$this->t_header=C('DB_PREFIX');
		$this->tableDefault="categorysub";
		$this->dataable=$this->tableDefault.$this->language;
		$this->tablename=$this->t_header.$this->dataable;
		
		$defaultLang=$this->getDefaultLang($this->language);
		$this->langName=strtolower($defaultLang[0]['lang_shortname']);
		
		
	}
	
	public function index(){
		$mid=intval($_GET['mid']);
		$strurl="";
		$this->assign("Mainid",$mid);
		$strarray['field']=' '.$this->tablename.'.* , '.$this->t_header.'category'.$this->language.'.cate_name';
		$strarray['join']=' '.$this->t_header.'category'.$this->language.'  on '.$this->tablename.'.csub_mianid = '.$this->t_header.'category'.$this->language.'.cate_id';
		if($mid)$strarray['where']=' '.$this->tablename.'.csub_mianid='.$mid;
		$strarray['order']=' '.$this->tablename.'.csub_sort desc ,' .$this->tablename.'.autoid desc ';
		$result=R('Table/Categorysub/reCategorysubList',array($strarray,$this->language,12));
		
		
		if(!empty($result)){
			$this->assign("CategorySubList",$result['lists']);
			$this->assign("PageContent",$result['page']);
			//一级类别
			$strnewarray=array('field'=>'cate_id,cate_name','order'=>'cate_sort desc,cate_id desc');
			$newresult=R('Table/Category/reCategoryTable',array($strnewarray,$this->language));
			$this->assign("CategoryList",$newresult);
			
				
		}else{
			$this->assign("EmptyContent","没有您要找的内容！");
		}
		
		$this->getPublic();
		$this->display($strurl);
	}
	
	public function addtable(){	
		$mid=intval($_GET['mid']);
		$this->assign("Mainid",$mid);
		$this->getPublic();
		$this->display();
	}

	public function saveadd(){
		$strNewData=$this->checkData();
		$cateMid=$_POST['csub_mianid'];
		if($cateMid){
			foreach ($strNewData as $catetable=>$dataCate){
				$strAddStatus=$this->getinsert($this->tableDefault.$catetable,$dataCate);
			}
			LocationUrl("index/mid/".$cateMid);
		}else{
			$this->redirect("categorylist/index",3,"数据提交失败");
		}
	}

	public function edittable(){
		$lid=CheckNum($_GET['id']);
		if($lid){
			$result=$this->getcontent($this->tableDefault."uk",$lid);
			if(is_array($result)){
				$this->assign("Csub",$result);
				
				$resultsp=$this->getcontent($this->tableDefault."sp",$lid);
				$resultra=$this->getcontent($this->tableDefault."ra",$lid);
				$resultal=$this->getcontent($this->tableDefault."al",$lid);
				
				$this->assign("Csubsp",$resultsp);
				$this->assign("Csubra",$resultra);
				$this->assign("Csubal",$resultal);
				
				$this->getPublic();
				$this->display();
			}else{
				$this->redirect("index",3, "请求数据错误");
			}
		}else{
			$this->redirect("index",3, "请求数据错误");
		}
	}

	public function saveedit(){
		$lid=CheckNum($_POST['autoid']);
		$cateMid=$_POST['csub_mianid'];
		if($lid){
			$strNewData=$this->checkData();
			$strarray['where']="autoid=".$lid;
			foreach ($strNewData as $catetable=>$dataCate){
				$strAddStatus=$this->getupdate($this->tableDefault.$catetable,$strarray,$dataCate );
			}

			LocationUrl("index/mid/".$cateMid);
			
		}else{
			$this->redirect("index",3, "请求数据错误");
		}

	}
	
	public function dellist(){
		$pid=$_POST['id'];
		$mid=intval($_GET['mid']);
		if(!empty($pid)){
			$id=implode(",", $pid);
			$strarray['where']=' autoid in ('.$id.')';
			$this->getdelone($this->tableDefault."uk",$strarray) ;
			$this->getdelone($this->tableDefault."sp",$strarray) ;
			$this->getdelone($this->tableDefault."ra",$strarray) ;
			$this->getdelone($this->tableDefault."al",$strarray) ;
		}
		LocationUrl("index/mid/".$mid);
	}

	public function changeview(){
		$pid=$_POST['id'];
		$vid=intval($_POST['articleview']);
		if(!empty($pid)){
			$id=implode(",", $pid);
			$strdata['csub_mianid']=$vid;
			$strarray['where']=' autoid in ('.$id.')';
			$this->getupdate($this->dataable, $strarray, $strdata) ;
		}
		LocationUrl("index");
	}
	
	public function checkData(){
		
		$csub_nameuk=CharsCheck($_POST['csub_nameuk']);
		$csub_namesp=CharsCheck($_POST['csub_namesp']);
		$csub_namera=CharsCheck($_POST['csub_namera']);
		$csub_nameal=CharsCheck($_POST['csub_nameal']);
		$csub_sort=CheckNum($_POST['csub_sort']);
		$csub_mianid=CheckNum($_POST['csub_mianid']);
		
		if(empty($csub_nameuk)){
			$this->redirect("index", 3,"未填写英语类别二级类型名称");
		}
		if(empty($csub_namesp)){
			$this->redirect("index", 3,"未填写西班牙语产品类别二级类型名称");
		}
		if(empty($csub_namera)){
			$this->redirect("index", 3,"未填写俄语类别二级类型名称");
		}
		if(empty($csub_nameal)){
			$this->redirect("index", 3,"未填写阿拉伯语类别二级类型名称");
		}
		
	
		
		$strarray['csub_sort']=$csub_sort;
		$strarray['csub_mianid']=$csub_mianid;
		
		$languk['csub_name']=$csub_nameuk;
		$langsp['csub_name']=$csub_namesp;
		$langra['csub_name']=$csub_namera;
		$langal['csub_name']=$csub_nameal;
		
		
		$returnArray['uk']=array_merge($languk,$strarray);
		$returnArray['sp']=array_merge($langsp,$strarray);
		$returnArray['ra']=array_merge($langra,$strarray);
		$returnArray['al']=array_merge($langal,$strarray);
		
		return $returnArray;
		
//		$csub_name=CharsCheck($_POST['csub_name']);
//		$csub_sort=CheckNum($_POST['csub_sort']);
//		$csub_mianid=CheckNum($_POST['csub_mianid']);
//		if(empty($csub_name)){
//			$this->redirect("index", 3,"未填写产品类别二级类型名称");
//		}
//
//		$strarray['csub_name']=$csub_name;
//		$strarray['csub_sort']=$csub_sort;
//		$strarray['csub_mianid']=$csub_mianid;
//		return $strarray;
	}
	
	public function insertData($cateId){
		
		$csub_nameuk=CharsCheck($_POST['csub_nameuk']);
		$csub_namesp=CharsCheck($_POST['csub_namesp']);
		$csub_namera=CharsCheck($_POST['csub_namera']);
		$csub_nameal=CharsCheck($_POST['csub_nameal']);
		
		$csub_sort=CheckNum($_POST['csub_sort']);
		$csub_mianid=CheckNum($_POST['csub_mianid']);
		
		$strarray['csub_sort']=$csub_sort;
		$strarray['cate_id']=$cateId;
		
		$languk['csub_name']=$csub_nameuk;
		$langsp['csub_name']=$csub_namesp;
		$langra['csub_name']=$csub_namera;
		$langal['csub_name']=$csub_nameal;
		
		
		$returnArray['uk']=array_merge($languk,$strarray);
		$returnArray['sp']=array_merge($langsp,$strarray);
		$returnArray['ra']=array_merge($langra,$strarray);
		$returnArray['al']=array_merge($langal,$strarray);
		
		return $returnArray;
	}
	
	
	/**
	 * AJAX获取categorysub表数据内容
	 */
	public function getCateSubAjax(){
		$mid=intval($_POST['mid']);
		$sid=intval($_POST['sid']);
		$strarray['field']='autoid,csub_name';
		$strarray['order']='csub_sort desc ,autoid asc';
		$strarray['where']='csub_mianid='.$mid;
		$result=R("Table/Categorysub/reCategorysubTable",array($strarray,$this->language));
		$strtext="<option value='0'>选择产品二级类别</option>";
		foreach ($result as $value){
			if($sid == $value['autoid']){
				$strtext.="<option value=".$value['autoid']." selected='selected'>".$value['csub_name']."</option>";
			}else{
				$strtext.="<option value=".$value['autoid']." >".$value['csub_name'].$sid."</option>";
			}
		}
		echo $strtext;
	}
	
}