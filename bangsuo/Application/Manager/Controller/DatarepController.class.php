<?php

namespace Manager\Controller;

class DatarepController extends CommonController {
	public function index() {
		$statusText=isset($_GET['status'])?I('get.status'):'empty';
		$this->assign('TipText',$statusText);
		$this->display ();
	}
	public function subtable() {
		$tableName = I ( 'post.table','','string'  );
		$value1 = I('post.value1','','string'  );
		$value2 = I('post.value2','','string' );
		$return=0;
		$strText='false';
		if (! empty ( $tableName ) && ! (empty ( $value1 ) && ! empty ( $value2 ))) {
			$dataName = $tableName == 'uk' ? 'data_productuk' : 'data_product';
			$_Model = D ( $dataName );
			$return=$_Model->execute (" update  " . $dataName . " set  prod_attr = replace(prod_attr,'" . $value1 . "','" . $value2 ."'),prod_content = replace(prod_content,'" . $value1 . "','" . $value2 . "')");
		}
		$strText = is_numeric($return) && $return>0?'true':$strText;
			
		redirect('index/status/'.$strText);
	}
}