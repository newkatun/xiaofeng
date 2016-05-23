<?php
class AddresslistAction extends CommonAction{ 
	public function _initialize(){
		
	}
	
	public function addressTable(){
		$result=false;
		if(isset($_SESSION['UID']) && isset($_SESSION['UEMAIL'])){
			$result=R("Table/Address/reTableView",array(array('where'=>'add_gid='.$_SESSION['UID']." and add_gname='".$_SESSION['UEMAIL']."'")));
		}
		return $result;
	}
	
	public function address(){
		$result=R('Table/Country/reTable',array(array('order'=>'country_name asc')));
		$this->assign('CountryList',$result);
		$this->getPublic();
		$this->display();
	}
	
	public function formaddress(){
		
		$result=R('Table/Address/checkData',array($_POST,array('options'=>'insertTable')));
		if($result){
			$guestFname=CharsCheck($_POST['guestaccptname']);
			$guestLname=CharsCheck($_POST['guestlastname']);
			$guestPhone=CharsCheck($_POST['guestphone']);
			$guestCountry=CharsCheck($_POST['guestcountry']);
			$guestCity=CharsCheck($_POST['guestcity']);
			$guestZIP=CharsCheck($_POST['guestpostcode']);
			$guestAdd=CharsCheck($_POST['guestaddress']);
			
			$shipping=R('Table/Countrylist/reContent',array(array('where'=>"country_name='".$guestCountry."'")));
			//运费计算
			if(is_numeric($shipping['country_shipping'])){
				$Shipping_price=floatval($shipping['country_shipping']);
			}else{
				$Shipping_price=C('SHIPPING_DEFAULT');
			}
			$this->assign('addressId',$result);
			$this->assign('guestName',$guestLname." ".$guestFname);
			$this->assign('guestAddress',$guestAdd);
			$this->assign('guestCountry',$guestCountry);
			$this->assign('guestCity',$guestCity);
			$this->assign('guestPhone',$guestPhone);
			$this->assign('guestPostcode',$guestZIP);
			$this->assign('Shipping',$Shipping_price);

		}
		

		
		$this->getpublic();
		$this->display();
	}
}