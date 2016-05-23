<?php
namespace Manager\Controller;
class ProdimgController extends CommonController{
	private $model;
	public function _initialize(){
		$this->checkLogin();
		$powerId=1;
		$this->pageCheck ( $powerId );
		$this->model=D('Prodimg');
	}
	
	public function index(){
		$id=intval($_GET['id']);
		if($id){
			$result=$this->model->ShowData('getList',array('where'=>'img_id='.$id,'order'=>'img_sort desc,autoid desc'));
			$this->assign('ImageList',$result);
			$this->assign('ProdID',$id);
		}
		$this->display();
	}
	
	public function saveadd(){
		$imgArray=$this->checkData();
		if(is_array($imgArray)){
			$result=$this->model->ShowData('getInsertAll',$imgArray);
		}
		$this->redirect('/manager/productlist/index');
	}
	
	public function dellist(){
		$id=intval($_POST['imgid']);
		$result=0;
		if($id){
			$result=$this->model->ShowData('getDelData',array('where'=>'autoid = '.$id));
		}
		echo  $result;
	}
	
	protected function checkData(){
		$dataArray=array();
		$imgdata=$_POST['imgurl'];
		$imgname=$_POST['imgname'];
		$imgid=intval($_POST['prodid']);
		for($i=0;$i<count($imgdata);$i++){
			$dataArray[$i]['img_id']=$imgid;
			$dataArray[$i]['img_url']=$imgdata[$i];
			$dataArray[$i]['img_name']=$imgname[$i];
		}
		return $dataArray;
	}
	
	public function setimg(){
		$id=intval($_POST['imgid']);
		$pid=intval($_POST['prodid']);
		$imgurl=I('post.imgsrc','','string');
		$result=0;
		if($id && $pid){
			$imgListArray=array('img_index'=>0);
			$dataArray=array('where'=>'img_id = '.$pid,'data'=>$imgListArray);
			$result=$this->saveUse ( $this->model, $dataArray, $pid );
			$imgArray=array('img_index'=>1);
			$imgData=array('where'=>'autoid = '.$id,'data'=>$imgArray);
			$result=$this->saveUse ( $this->model, $imgData, $id );
			$prodArray=array('prod_img'=>$imgurl);
			$prodData=array('where'=>'autoid ='.$pid,'data'=>$prodArray);
			$prodModel=D('Product');
			$result=$this->saveUse($prodModel,$prodData,$pid);
		}
		echo  $result;
	}
	
	public function upsort(){
		$imgid=intval($_POST['imgid']);
		$status=I('post.action','','string');
		if($imgid>0 &&  $status=='Crease'){
			$imgListArray=array('where'=>'autoid ='.$imgid,'field'=>'img_sort','number'=>1,'status'=>true);
			$result=$this->model->ShowData('getNumUpdate',$imgListArray);
		}
		if($imgid>0 &&  $status=='Reduce'){
			$imgListArray=array('where'=>'autoid ='.$imgid,'field'=>'img_sort','number'=>1);
			$result=$this->model->ShowData('getNumUpdate',$imgListArray);
		}
		echo $result>0?'Success':'Fail';
	}
}