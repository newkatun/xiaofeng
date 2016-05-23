<?php
class CartlistAction extends CommonAction{
	private $textArray;
	public function _initialize(){
		$this->getPublic();
		$this->getPageName();
		$this->textArray=array('selectProd'=>'No selected products','pageExpirs'=>'The page has expired',
								'loginPage'=>'Back to the login page','removeFail'=>'Shopping cart clear failure',
								'selectRemove'=>'There is no selection to the deleting products','orderFail'=>'The bill of lading submit failure',
								'checkAddress'=>'Please check your delivery address',
								'emailSuccess'=>'Your order details has been  sent to your email !',
								'emailFail'=>'Send mail failed!',
								'payError'=>'Payment issue'
							);
	}
	public function index(){
		$result=R("Order/tempOrderTable");
		$_SESSION['SubmitStatus']=is_array($result)?true:false;
		$this->assign("CartListCookie",$result);
		$this->display();
	}
	/**
	 * 对订单检查
	 * 1)没有选取商品
	 * 2)未登录转到登录页面
	 * 3)已登录获取送货与支付信息
	 */
	public function cartcheck(){
		if($this->getLoginStatus()){
			if(!isset($_SESSION['SubmitStatus'])) $_SESSION['SubmitStatus']=true;
			if($_SESSION['SubmitStatus']){
				$prodid=$_POST['skuid'];
				if(empty($prodid)){
					$this->cartfail($this->textArray['selectProd']);
				}else{
					$addressList=R('Addresslist/addressTable');
					$this->assign('AddressList',$addressList);
					$payList=R('Table/Payment/reTable');
					$this->assign('PaymentList',$payList);
					$prodid=implode(',', $prodid);
					$cartProdList=R('Order/tempOrderTable',array($prodid));
					//防止提交成功时页面倒退
					$this->assign('CartProdList',$cartProdList);
					$this->display();
				}
			}else{
				$this->cartfail($this->textArray['pageExpirs']);
			}
		}else{
			setcookie('NextPage','cartlist',time()+60*60,'/');
			$this->cartfail($this->textArray['loginPage'],'login',1);
		}
	}
	/**
	 * 购物车错误提示与页面调转功能
	 * @param string  $strText 提示内容
	 * @param string  $pageUrl 跳转页面地址
	 */
	private function cartfail($strText,$pageUrl='',$stayTime=2){
		$this->assign('FailText',$strText);
		$this->assign('FreshTime',$stayTime);
		$this->display('cartfail');
	}
	
	public function cartDeleteAll(){
		if(!empty($_POST['skuid'])){
			$sqlText=' AND ';
			$sqlText.=$this->getLoginStatus()?" temp_uname = '".$_SESSION['UEMAIL']."' AND temp_uid =".$_SESSION['UID']:" temp_uname = '".$_COOKIE['User-keys']."' AND temp_uid =0";
			$result=R("Table/Ordertemp/delData",array($_POST['skuid'],$sqlText));
			if($result){
				LocationUrl('/index');
			}else{
				$this->cartfail($this->textArray['removeFail'],'cartlist');
			}
		}else{
			$this->cartfail($this->textArray['selectRemove'],'cartlist');
		}
		
	}

	public function cartsubmit(){
		if($this->getLoginStatus()){
			$cartId=$_POST['cartId'];
			if($_SESSION['SubmitStatus'] && !empty($cartId)){
				//读取地址视图信息
// 				$address=R('Table/Address/reContentView',array(intval($_POST['guestaddressId'])));
				$orderData=R('Order/createOrderList',array($_POST));
					if($orderData){
						$this->assign('Order',$orderData);
						$strtitle='MYWEB-SHOP——'.$orderData['OrderCode'];
						$filepath=$this->createXls($orderData['OrderCode']);
//  						$strcontent=$this->EmailContent($orderData,$Payment='Paypal',$address);
//  						$strreturn=$this->SendEmail($strtitle,$strcontent,$_SESSION['UEMAIL']);
//  						$strreturnnew=$this->SendEmail($strtitle,$strcontent,"379223599@qq.com");
//  						if($strreturn){
//  							$strtext=$this->textArray['emailSuccess'];
//  						}else{
//  							$strtext=$this->textArray['emailFail'];
//  						}
// 						$this->assign('EmailText',$strtext);
						$this->assign('FilePath',$filepath);
						$_SESSION['SubmitStatus']=false;
						$this->display();
					}else{
						$this->cartfail($this->textArray['orderFail']);
					}
				
			}else{
			$this->cartfail($this->textArray['pageExpirs']);
			}
		}else{
			setcookie('NextPage','cartlist',time()+60*60,'/');
			$this->cartfail($this->textArray['loginPage'],'login',1);
		}
	}

	private function createXls($orderCode){
		$dirName=Date('ymd',time());
		$dirPath='./uploadfile/xls/'.$dirName;
		if(!is_dir($dirPath)){
			mkdir($dirPath,0777);
		}
		$filePath=$dirPath ."/".$orderCode.".xls";
		$handle=fopen($filePath, 'w');
		$strprodarray=array('where'=>"prod_oid='".$orderCode."' and prod_uid = ".$_SESSION['UID']);
		
		
		$strcont="<table class=\"orderTable\"  bgcolor='#666666' cellpadding='1' cellspacing='1' border='1'>";
		$strcont.="<thead style=\"height: 30px; background: #E7E7E7\"><th height='30'><font color='#FFFFFF'>Photo</font></th><th><font color='#FFFFFF'>Product Code</font><th><font color='#FFFFFF'>Product Name</font></th><th><font color='#FFFFFF'>Quantity</font></th></thead>";
		$OrderProdList=R("Table/Orderprod/reTable",array($strprodarray));
		$strpordtext="";
		foreach($OrderProdList as $prod){
			$strpordtext.="<tr bgcolor='#FFFFFF'><td style=\"width: 120px; height:120px; text-align: left; padding: 5px; line-height: 1.2\" align=\"center\">";
			$strpordtext.="<img src=\"http://".$_SERVER['HTTP_HOST'].$prod['p_img']."\" width=\"120\"/></td>";
			$strpordtext.="<td style=\" text-align: left; padding: 5px; line-height: 1.2\">".$prod['p_id']." </td>";
			$strpordtext.="<td style=\" text-align: left; padding: 5px; line-height: 1.2\">".$prod['ty_name']." ".$prod['p_name']."</td>";
			$strpordtext.="<td>".$prod['prod_number']."</td></tr>";
		}
		$strcont.=$strpordtext."</table>";
		$strcont.="<BR>".chr(13)."<BR>";

		fwrite($handle, $strcont);
		fclose($handle);
		return $filePath;
	}
	
	
	/**
	 * 订单提交成功邮件提醒功能
	 * @param array $OrderCode 订单信息 (订单号，订单统计价格)
	 * @param array $Pay_array 支付信息
	 * @param array $Address_array 地址信息
	 */
	private function  EmailContent($OrderCode,$Pay_array='Paypal',$Address){
		$strcontent="<html xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" /><title>Mail order generation</title><meta name=\"keywords\" content=\"\" />\n";
		$strcontent.="<meta name=\"description\" content=\"\" /><base target=\"_blank\" /></head>\n";
		$strcontent.="<body style=\"border-width:0;margin:12px;\">\n";
		$strcontent.="<style type=\"text/css\">body {margin: 0;	font-size: 12px;}a img {border: none}table {	border-collapse: collapse;}.orderTable,.orderTable th,.orderTable td {border: 1px solid #D4D4D4;}span.textview{padding-left:20px;}</style>\n";
		$strcontent.="<table width=\"100%\"><tr><td><table style=\"width: 100%; margin: 30px auto; border: 2px solid #E6E6E6;\"><tr><td style=\"height: 10px\"></td> </tr>\n";
		$strcontent.="<tr><td><table width=\"100%\"><tbody><tr style=\"height:75px;\"><td style=\"width:20px\"></td> <td></td><td><table cellspacing=\"0\" cellpadding=\"0\" style=\"text-align:right;width:100%\"><tbody><tr><td style=\"color:#999999; font-size:12px;\" colspan=\"4\"></td></tr><tr> <td height=\"5\" colspan=\"4\"></td> </tr>\n";
		$strcontent.="<tr><td colspan=\"4\"><a style=\"padding:0 5px; font-size:12px; color:#666666;text-decoration:none;\" target=\"_blank\" href=\"http://".$_SERVER['HTTP_HOST']."\">Index</a>  <span style=\"color:#999999; font-size:12px;\">|</span> <a style=\"padding:0 5px;  font-size:12px;color:#666666;text-decoration:none;\" target=\"_blank\" href=\"http://".$_SERVER['HTTP_HOST']."/catalog\">Catalog</a> <span style=\"color:#999999; font-size:12px;\">|</span> <a style=\"padding:0 5px; font-size:12px; color:#666666;text-decoration:none;\" target=\"_blank\" href=\"http://".$_SERVER['HTTP_HOST']."/about\">About</a> <span style=\"color:#999999; font-size:12px;\">|</span> <a style=\"padding:0 5px; font-size:12px; color:#666666;text-decoration:none;\" target=\"_blank\" href=\"http://".$_SERVER['HTTP_HOST']."/contact\">Contact</a> <span style=\"color:#999999; font-size:12px;\"></span> </td></tr></tbody> </table></td> <td style=\"width:20px\"></td>  </tr>\n";
		$strcontent.="</tbody></table></td> </tr>\n";
		$strcontent.="<tr><td style=\"border-bottom: 3px solid #FF0000; padding: 0\"></td></tr><tr><td style=\"border-bottom: 2px solid #DBDBDB; padding: 0\"></td></tr><tr><td style=\"height: 25px;\"></td></tr><tr><td><table width=\"100%\"><tr><td style=\"width: 20px\"></td><td><table width=\"100%\"><tr><td style=\" font-size: 14px; line-height: 20px;color:#666\">Dear  <span style=\"color: #0066CC;padding-left:10px;\" ><b>".$_SESSION['UNAME']."</b></span>：<br />Your Order <span style=\"color: #CC0000\">".$OrderCode['OrderCode']."</span> successfully generated , if you choose online payment or bank transfer, please pay as soon as possible , we will arrange the shipment as soon as possible , thank you for your order.<br /></td></tr>\n";
		$strcontent.="<tr><td style=\"height: 10px;\"></td></tr>\n";
		$strcontent.="<tr><td style=\"border-bottom: 1px dashed #cccccc; height: 10px\"></td></tr>\n";
		$strcontent.="<tr><td style=\"line-height: 1.5; color: #666666\"><table width=\"100%\">\n";
		$strcontent.="<tr><td style=\"line-height: 3; color: #333333; font-weight: bold\">Consignee information : </td></tr>\n";
		$strcontent.="<tr><td style=\"padding-left:20px;\">Name:<span class=\"textview\">".$Address['add_lastname']." ".$Address['add_firstname']."</span></td></tr><tr><td style=\"padding-left:20px;\">Address:<span class=\"textview\">".$Address['add_address']." ".$Address['add_cityname']." ".$Address['add_country']." </span></td></tr><tr><td style=\"padding-left:20px;\">Contact:<span class=\"textview\">".$Address['add_telephone']."</span></td></tr>\n";
		
		$strcontent.="<tr><td style=\"border-bottom: 1px dashed #cccccc; height: 10px\"></td></tr><tr><td style=\"line-height: 1.5; color: #666666\"><table><tr><td style=\"line-height: 3; color: #333333; font-weight: bold\">Order  Information:</td></tr><tr><td style=\"padding-left:20px;\">Order Number:<a style=\"color: #0066CC; text-decoration: none; font-size: 14px;padding-left:20px;\" href=\"#\" target=\"_blank\" >".$OrderCode['OrderCode']."</a></td></tr>\n";
		$strcontent.="<tr><td style=\"padding-left:20px;\">Order Date :<span style=\"font-size: 14px;padding-left:20px;\">".Date("Y-m-d",time())."</span> </td></tr></table></td></tr><tr><td><table class=\"orderTable\" style=\"width: 100%; text-align: center; color: #666666\"><thead style=\"height: 30px; background: #E7E7E7\"><th>Photo</th><th>Name</th><th>Quantity</th></thead>\n";

		$strprodarray=array('where'=>"prod_oid='".$OrderCode['OrderCode']."' and prod_uid = ".$_SESSION['UID']);

		$OrderProdList=R("Table/Orderprod/reTable",array($strprodarray));
		$strpordtext="";
		foreach($OrderProdList as $prod){
			$strpordtext.="<tr><td style=\"width: 120px; text-align: left; padding: 5px; line-height: 1.2\" align=\"center\"><a  href=\"#\" target=\"_blank\"><img src=\"http://".$_SERVER['HTTP_HOST'].$prod['p_img']."\" width=\"120\"/></a> </td><td style=\" text-align: left; padding: 5px; line-height: 1.2\"><a style=\"color: #0066CC; text-decoration: none;\" href=\"#\" target=\"_blank\">".$prod['p_id']."  ".$prod['p_name']."</a> </td><td>".$prod['prod_number']."</td></tr>\n";
		}
		$strcontent.=$strpordtext."</table></td></tr>\n";
		
		$strcontent.="<tr><td style=\"border-bottom: 1px dashed #cccccc; height: 10px\"></td></tr><tr><td style=\"height: 10px;\"></td></tr></table></td><td style=\"width: 20px\"></td></tr></table></td></tr></table></td></tr></table>\n";
		$strcontent.="</body></html>\n";
		return $strcontent;
	}
	
	/**
	 * 支付跳转页面,默认是调用Paypal支付的
	 */
	public function cartPay(){
		$ordernum=CharsCheck($_GET['ordernum']);
		if(!empty($ordernum) && $this->getLoginStatus()){
			$orderArray=R('Table/Orderlist/reContent',array(array('where'=>"order_id ='".$ordernum."' and order_uid=".$_SESSION['UID'])));
			$prodArray=R('Table/Orderprod/reTable',array(array('where'=>" prod_oid ='".$ordernum."' and  prod_uid=".$_SESSION['UID'])));
			$payArray=R('Table/Payment/reContent',array(array('where'=>"pay_name ='".$orderArray['order_paytype']."'")));
			$this->assign('OrderNum',$ordernum);
			$this->assign('OrderProdList',$prodArray);
			$this->assign('Payment',$payArray);
			$this->assign('Order',$orderArray);
			$this->display();
		}else{
			$this->cartfail($this->textArray['payError'],'userindex');
		}
		
	}
}