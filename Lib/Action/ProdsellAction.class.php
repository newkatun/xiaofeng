<?php
class ProdsellAction extends CommonAction{ 
	public function _initialize(){
		$this->getPageName();
		$this->getMenulist();
		$this->getPublic();
	}
	
	public function index(){
		$action=CharsCheck($_GET['type']);
		if(!empty($action)){
			$result=R("Table/Soletype/reContent",array(array('where'=>" `sole_name` = '".$action."' ")));
			if(is_array($result)){
				$ProdList=R("Table/Productnew/reList",array(array('where'=>'p_soletype='.$result['autoid'].' and p_status=0')));
				$this->assign('MenuProduct',$ProdList['lists']);
				$this->assign('PageContent',$ProdList['page']);
				$flag=true;
				$this->assign('ProdSell',$result);
				if(empty($ProdList['lists'])){
					$RecommondList=R("Table/Productnew/reTable",array(array('where'=>'  p_status=0','limit'=>'0,24')));
					$flag=false;
					$this->assign('ReommondProduct',$RecommondList);
				}
				$this->assign('TableList',$flag);
			}else{
				LocationUrl('/catalog');
			}
		}else{
			LocationUrl('/catalog');
		}
		$this->display();
	}
}