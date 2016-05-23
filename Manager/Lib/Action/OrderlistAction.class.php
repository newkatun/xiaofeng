<?php
class OrderlistAction extends CommonAction{
	private $dataable,$language,$t_header,$tablename;
	public  function _initialize(){
		$this->language="uk";
		$this->t_header=C('DB_PREFIX');
		$this->dataable="article".$this->language;
		$this->tablename=$this->t_header.$this->dataable;
	}
	public function index(){
		$strarray['order']='autoid desc';
		$action=$_GET['gurl'];
		if($action=='unread'){
			$strarray['where']='cart_manager=0';
		}elseif($action=='readed'){
			$strarray['where']='cart_manager=1';
		}
		$orderArray=R("Table/Cartlist/reList",array($strarray,6));
		$orderList=$orderArray['lists'];
		if(!empty($orderList)){
			foreach ($orderList as $n=>$value){
				$dataArray['where']="data_cartid='".$orderList[$n]['cart_code']."'";
				$orderList[$n]['OrderProd']=R("Table/Cartdata/reTable",array($dataArray));
			
			}
		}
		$this->assign("OrderList",$orderList);
		$this->assign("PageContent",$orderArray['page']);
		$this->getPublic();
		$this->display();
	}
	
	
	public function updata(){
		
		$orderid=intval($_GET['id']);
		$strarray['where']='autoid='.$orderid;
		$strdata['cart_manager']=1;
		$strdata['cart_time']=date("Y-m-d H:i:s",time());
		$this->getupdate('cartlist', $strarray, $strdata);
		
		$dataArray=R("Table/Cartlist/reContent",array($orderid));
		
		$htmlContent=$this->sendHtml($dataArray);
		$this->sendEmail("Your Tcil Order List", $htmlContent, $dataArray['cart_guestemail']);
		LocationUrl("http://".$_SERVER['HTTP_HOST']."/admin.php/orderlist");
		
	}
	
	
	public function deldata(){
		
		$orderid=intval($_GET['id']);
		$strarray['where']='autoid='.$orderid;
		$this->getdelone('cartlist', $strarray);
		LocationUrl("http://".$_SERVER['HTTP_HOST']."/admin.php/orderlist");
//	
	}
	
	
	public function sendHtml($dataArray){
		if(!empty($dataArray) && is_array($dataArray)==true){
			
			$strcont="<html xmlns='http://www.w3.org/1999/xhtml'>\n";
			$strcont.="<head>\n";
			$strcont.="<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>\n";
			$strcont.="<title>Your Order List</title>\n";
			$strcont.="<style type='text/css'>table tr{background-color:#FFFFFF;}\n";
			$strcont.=".table_order {background-color:#800; line-height:24px; }\n";
			$strcont.=".table_order tr td{text-indent:10px; }\n";
			$strcont.=".orderprod tr td, .orderprod tr th{height:24px;line-height:24px;background-color: #EEE;}\n";
			$strcont.=".orderprod tr td a{ color:#333; text-decoration:none;}\n";
			$strcont.="</style>\n";
			$strcont.="</head>\n";
			$strcont.="<body>\n";
			$strcont.="<table width='100%' cellspacing='1' cellpadding='0' class='table_order'><tbody>\n";
			$strcont.="<tr><td width='100' align='center'>&nbsp; <span>Order Number：</span></td>\n"; 
			$strcont.="<td width='150' align='center'>".$dataArray['cart_code']."&nbsp; </td><td width='100' align='center'><span>Order Time：</span></td>  \n"; 
			$strcont.="<td align='center'>".$dataArray['datetime']."</td>\n"; 
			$strcont.="<td width='30%'><div style='width:200px; padding:2px;'>&nbsp;  </td></tr>\n";
			$strcont.="<tr><td width='15%' align='center'><span>Remark:</span> </td> <td colspan='4'>".$dataArray['cart_guestcont']."</td></tr>\n";
	
			$strcont.="<tr><td width='10%' align='center'><span>Order Product List</span> </td> <td class='order_viewtd' colspan='4'>\n";
			$strcont.="<table width='100%' cellspacing='1' cellpadding='0' border='0' align='center' class='orderprod'> <tbody>\n";
			$strcont.="<tr align='center'><th width='50%' align='center'> <span>Product Name </span> </th> \n"; 
			$strcont.="<th width='10%' align='center'> <span>QTY</span> </th>  \n"; 
			$strcont.="</tr>\n";
			$cartSql['where']="data_cartid = '".$dataArray['cart_code']."'";
			$cartData=R('Table/Cartdata/reTable',array($cartSql));
			foreach($cartData as $cart){
				$strtext.="<tr><td align='center'><a href='http://".$_SERVER['HTTP_HOST']."/prodview/index/id/".$cart['data_pid']."'>".$cart['data_pname']."</a></td><td align='center'>".$cart['data_pnum']."</td></tr>\n"; 
			}
			$strcont.=$strtext;
			$strcont.="</tbody> </table>\n"; 
			$strcont.="</td></tr>\n"; 
			$strcont.="<tr> <td width='10%' align='center'><span>Receiving Information:</span> </td>\n"; 
			$strcont.="<td colspan='4'><span>Name：</span>".$dataArray['cart_guestname']."&nbsp; <span>TEL：</span>".$dataArray['cart_guesttel']."  &nbsp; <span>Country：</span>".$dataArray['cart_guestadd']."&nbsp;<span>E-mail:</span>".$dataArray['cart_guestemail']."</td> </tr>\n";        
			$strcont.="</tbody></table></body></html> \n";   
			return  $strcont; 
		}else{
			return false;
		}
	}
	


}