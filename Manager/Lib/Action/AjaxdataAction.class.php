<?php
class AjaxdataAction extends CommonAction{
	public function _initialize(){
		$this->loginStatusCheck();
	}
	/**
	 * 获取产品细类别
	 */
	public function getCateSub(){
		$mid=intval($_POST['mid']);
		$strText="<option value='0'>Please Select</option>";
		if($mid){
			$sqlArray['where']='ty_subid = '.$mid;
			$reData=R("Table/Category/reTable",array($sqlArray));
			if(is_array($reData)){
				foreach ($reData as $data){
					$strText.="<option value='".$data['autoid']."'>".$data['ty_name']."</option>";
				}
				
			}
		}
		echo $strText;
	}
	
	public function delImgData(){
		$imgid=intval($_POST['imgid']);
		$strReturn=0;
		if($imgid){
			$result=R("Table/Image/reContent",array($imgid));
			$strReturn=R("Table/Image/delData",array($imgid));
//			$imgStatus=unlink($result['pi_bigimg']);
//			$imgStatus=unlink($result['pi_smaimg']);
		}
		echo $strReturn;
	}
}