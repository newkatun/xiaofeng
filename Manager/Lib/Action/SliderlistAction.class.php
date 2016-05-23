<?php
class SliderlistAction extends  CommonAction {
	
	public function index(){
		$result=R('Table/Slider/reList');
		$this->assign("SliderList",$result['lists']);
		$this->assign("PageContent",$result['page']);
		$this->getPublic();
		$this->display();
	}
	
	public function addtable(){
		$this->getpublic();
		$this->display();
	}
	
 	public function saveadd(){
		$dataType=array('options'=>'insertTable');
		$strData=R("Table/Slider/checkData",array($_POST,$dataType));
		$this->MakeProdXml();		
		if(!$strData){
			$this->redirect('index', '数据增加成功！');
		}else{
			$this->redirect('index', '数据增加失败！');
		}
	} 
	
	public function edittable(){
		$lid=CheckNum($_GET['id']);
		if($lid){
			$result  =R("Table/Slider/reContent",array($lid));
			if(is_array($result)){
				$this->assign("Slider",$result);
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
		$prodId=intval($_POST['autoid']);
		$dataType=array('options'=>'updateTable','autoid'=>$prodId);
		$strData=R("Table/Slider/checkData",array($_POST,$dataType));
		$this->MakeProdXml();
		if(!$strData){
			$this->redirect('index', '数据增加成功！');
		}else{
			$this->redirect('index', '数据增加失败！');
		}
	}
	
	public function dellist(){
		$pid=$_POST['id'];
		if(!empty($pid)){
			$reStatus=R("Table/Slider/delData",array($pid));
			$this->MakeProdXml();	
			$this->redirect('index', '数据删除成功！');
		}else{
			$this->redirect('index', '数据删除失败！');
		}
	}
	
	private function MakeProdXml(){
		$result=R('Table/Slider/reTable',array(array('field'=>'sl_title,sl_linkurl,sl_bigimg,sl_smaimg','limit'=>'0,7')));
		print_r($result);
		$strcont="";
		if(is_array($result)){
			foreach($result as $row){
				$strcont.="<item>\n";
				$strcont.="<title>".$row['sl_title']."</title>\n";
				$strcont.="<url>".$row['sl_linkurl']."</url>\n";
				$strcont.="<image>".$row['sl_bigimg']."</image>\n";
				$strcont.="<smaimage>".$row['sl_smaimg']."</smaimage>\n";
				$strcont.="</item>\n";
			}
			$strreturn="<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
			$strreturn.=" <content>\n";
			$strreturn.=$strcont;
			$strreturn.=" </content>\n";
			$fileurl=$_SERVER['DOCUMENT_ROOT'].APP_ROOT."/xml/xml.xml";
			$fp=@fopen($fileurl, "w");
			fwrite($fp, $strreturn);   
			fclose($fp);
			return true;
		}else{
			return false;
		}
	}
}