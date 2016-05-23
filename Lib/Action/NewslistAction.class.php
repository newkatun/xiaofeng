<?php
class NewslistAction extends CommonAction{
	
	public function _initialize(){
		$this->getPageName();
		$this->getMenulist();
		$this->getPublic();
	}
	
	public function index(){
		
		$newsArray=R("Table/News/reList");
		$this->assign("NewsList",$newsArray['lists']);
		$this->assign("PageContent",$newsArray['page']);
		$this->display();
	}
	
	public function nshow(){
		$id=0;
		$pageName="Error:index";
		if(isset($_GET['id'])){
			$id=intval($_GET['id']);
			if($id){
				$newSql=array('where'=>'autoid='.$id);
				$newsArray=R("Table/News/reContent",array($newSql));
				//数据存在时
				if(is_array($newsArray)){
					$this->assign("News",$newsArray);
					$pageName="";
					//上一条新闻
					$prevSql=array('field'=>'autoid,n_title','where'=>' autoid <'.$id,'limit'=>'0,1');
					$prevArray=R("Table/News/reTable",array($prevSql));
					$this->assign("PrevNews",$prevArray[0]);
					
					//下一条新闻
					$nextSql=array('field'=>'autoid,n_title','where'=>' autoid >'.$id,'limit'=>'0,1');
					$nextArray=R("Table/News/reTable",array($nextSql));
					$this->assign("NextNews",$nextArray[0]);
				}
			}
		}
		$this->display($pageName);
	}
}