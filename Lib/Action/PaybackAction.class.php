<?php
class PaybackAction extends CommonAction{
	public function index(){
		$ordernum=htmlspecialchars($_GET['ordernum']);
		$req = 'cmd=_notify-validate';
		foreach ($_POST as $key=> $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		//建议在此将接受到的信息记录到日志文件中以确认是否收到IPN信息
		//将信息POST回给PayPal进行验证
		
		$header="POST /cgi-bin/webscrHTTP/1.0\r\n";
		$header.="Content-Type:application/x-www-form-urlencoded\r\n";
		$header.="Content-Length:" .strlen($req) ."\r\n\r\n";

		//在Sandbox情况下，设置：

		$fp = fsockopen('www.paypal.com',80,$errno,$errstr,30);

		//$fp = fsockopen ('www.paypal.com', 80,$errno,$errstr, 30);
		//将POST变量记录在本地变量中
		//该付款明细所有变量可参考：
		//https://www.paypal.com/IntegrationCenter/ic_ipn-pdt-variable-reference.html

		
		$strarray['payer_fname']=urldecode($_POST['first_name']);
		$strarray['payer_lname']=urldecode($_POST['last_name']);
		$strarray['payer_id']=urldecode($_POST['first_name']);
		$strarray['payer_email']=urldecode($_POST['payer_email']);
		$strarray['payer_street']=urldecode($_POST['address_street']);
		$strarray['payer_city']=urldecode($_POST['address_city']);
		$strarray['payer_state']=urldecode($_POST['address_state']);
		$strarray['pay_country']=urldecode($_POST['address_country']);
		$strarray['payer_zip']=urldecode($_POST['address_zip']);
		$strarray['payer_paytype']=urldecode($_POST['payment_type']);
		$strarray['payer_total']=urldecode($_POST['mc_gross']);
		$strarray['payer_txid']=urldecode($_POST['txn_id']);
		$strarray['payer_reciver']=urldecode($_POST['receiver_email']);
		$strarray['payer_business']=urldecode($_POST['business']);
		$strarray['payer_datetime']=urldecode($_POST['payment_date']);
		$strarray['payer_order']=$ordernum;
		
		$strupdate['order_status']='ReadyOrder';
		$strupdate['order_payment']='PayMoney';
		
		//...

		//判断回复POST是否创建成功

		if (!$fp) {
			//HTTP错误
			datarecord("The ".$ordernum ." Order  are not validated![".date("Y-m-d H-i-s",time())."]");
		}else {
			//将付款信息插入到数据据中
			$result=R("Table/Paymentback/saveData",array($strarray,array('options'=>'insertTable')));
			//更新订单信息,此处没有与数据库中帐号匹配
			if(!empty($strarray['payer_txid'])){
				$cartStatus=R("Table/Orderlist/saveData",array($strupdate,array('options'=>'updateTable','where'=>" order_id ='".$ordernum."'")));
			}
			//将回复POST信息写入SOCKET端口			
			fputs ($fp, $header.$req);
			//开始接受PayPal对回复POST信息的认证信息
			while (!feof($fp)) {
				$res = fgets($fp, 1024);
				//已经通过认证
				if (strcmp ($res, "VERIFIED") == 0){
					//检查付款状态
					//检查txn_id是否已经处理过
					//检查receiver_email是否是您的PayPal账户中的EMAIL地址
					//检查付款金额和货币单位是否正确
					//处理这次付款，包括写数据库
					datarecord('success['.date("Y-m-d H-i-s",time()).']');
				}else if (strcmp ($res, "INVALID") == 0) {
					//未通过认证，有可能是编码错误或非法的POST信息
					datarecord('fail['.date("Y-m-d H-i-s",time()).']');
				}
			}
			fclose ($fp);
		}

	}
	
}