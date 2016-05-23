<?php
namespace Manager\Controller;
header ( "Content-type:text/html;charset=utf-8" );
class ProdattrController extends  CommonController{
	public function index(){
		
		$prodModel=D("Product");
		$prodArray=$prodModel->ShowData('getList');
		
		$attrModel = D("Prodattr");
		print_r($prodArray);
		foreach($prodArray as $prod){
			$attrData=$attrModel->ShowData('getTableCont',array('where'=>'attr_id = '.$prod['autoid']));
			$data['prod_attr']="颜色:".$attrData['attr_color']."<br/>"."尺寸:".$attrData['attr_size']."<br/>"."电池:".$attrData['attr_battery']."<br/>"
				."主要材料:".$attrData['attr_material']."<br/>"."外包装:".$attrData['attr_pack']."<br/>"."包装材料:".$attrData['attr_description']."<br/>"
				."包装尺寸:".$attrData['attr_bag']."<br/>"."立方数:".$attrData['attr_cbm']."<br/>"	;
			
			$str='<table width="98%"  cellspacing="0" cellpadding="0" border="1"  class="tableattr"><tbody>';
   			$str.='<tr><td class="td_left" valign="middle"> 工厂型号</td><td class="td_right" valign="middle"> '.$attrData['attr_code'].' </td></tr>'."\n";
  			$str.='<tr><td class="td_left" valign="middle"> 产品名称</td><td class="td_right" valign="middle">  '.$attrData['attr_name'].'</td></tr>'."\n";
			$str.='<tr><td class="td_left" valign="middle"> 产品颜色</td><td class="td_right" valign="middle">  '.$attrData['attr_color'].'</td></tr>'."\n";
			$str.='<tr><td class="td_left" valign="middle"> 产品尺寸 </td><td class="td_right" valign="middle">  '.$attrData['attr_size'].'</td></tr>'."\n";
			$str.='<tr><td class="td_left" valign="middle"> 电池</td><td class="td_right" valign="middle">  '.$attrData['attr_battery'].'</td></tr>'."\n";
			$str.='<tr><td class="td_left" valign="middle"> 主要材料</td><td class="td_right" valign="middle">  '.$attrData['attr_material'].'</td></tr>'."\n";
			$str.='<tr><td class="td_left" valign="middle">外包装</td><td class="td_right" valign="middle"> '.$attrData['attr_pack'].'</td></tr>'."\n";
			$str.='<tr><td class="td_left" valign="middle"> 包装材料</td><td class="td_right" valign="middle">  '.$attrData['attr_description'].'</td></tr>'."\n";
			$str.='<tr><td class="td_left" valign="middle"> 包装尺寸/重量</td><td class="td_right" valign="middle">  '.$attrData['attr_bag'].' </td></tr>'."\n";
			$str.='<tr><td class="td_left" valign="middle"> 立方数</td><td class="td_right" valign="middle"> '.$attrData['attr_cbm'].'</td></tr>'."\n";
			$str.='</tbody></table>';
			$data['prod_content']=$prod['prod_content'].$str;
			$upData=array('where'=>'autoid = '.$prod['autoid'],'data'=>$data);
		    $this->saveUse ( $prodModel, $upData, $prod['autoid'] );
		}
	}
}