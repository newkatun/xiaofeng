<?php
	//对输入的内容进行字符转换，去掉空格
	function  CharsCheck($strtext){
		return htmlspecialchars(trim($strtext));
	}
	//验证字符
	function CharsMatch($strtext,$strtype=0){
		switch($strtype){
		  case 0:
			return CheckString(strtext);
			break;
		  case 1:
			return CheckNum(strtext);
			break;
		  default:
		    return $strtext;
		}
	}
	/**
	 *验证名称
	 *@param string $strtext 
	 *@return string
	 */
	function CheckString($strtext){
		$strexp="/[a-zA-Z0-9_@]+$/";
		$strreturn=preg_match($strexp,$strtext,$strarray);
		return $strarray[0];
	}
	/**
	 *验证数字
	 *@param int $strtext 
	 *@return int
	 */
	function CheckNum($strnum){
		$strnum=is_numeric($strnum)?$strnum:0;
		return $strnum;
	}
	
	/**
	 *获取IP地址
	 */
	function GetIP(){
		if(!empty($_SERVER["HTTP_CLIENT_IP"]))
		   $cip = $_SERVER["HTTP_CLIENT_IP"];
		else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
		   $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		else if(!empty($_SERVER["REMOTE_ADDR"]))
		   $cip = $_SERVER["REMOTE_ADDR"];
		else
		   $cip = "无法获取！";
		return $cip;
	}
	/**
	 *跳转网址
	 */
	function LocationUrl($strurl=""){
		if(empty($strurl)){
			echo "<script type='text/javascript'>window.location.href='http://".$_SERVER['HTTP_HOST']."';</script>";
		}else{
			echo "<script type='text/javascript'>window.location.href='".$strurl."';</script>";
		}
	}

	function  StrCompare($stvalue,$strpost){
		$strreturn=$stvalue===$strpost?true:false;
		return $strreturn;
	}
	
	//产品是否处于生产状态
	function ProdStatus($strKey){
		if($strKey==0){
			$strReturn="<font color='green'>上线</font>";
		}else{
			$strReturn="<font color='red'>下线</font>";
		}
		return $strReturn;
	}
	//字符比较，相等时返回选中
	function CheckStr($str1,$str2){
		if($str1==$str2){
			return "checked=checked";
		}
	}
	//文章类型是内容型还是列表型
	function GetStrType($strnum){
		if($strnum){
			return "列表型";
		}else{
			return "内容型";
		}
	}
	//产品是否热卖
	function GetStrHot($strnum){
		if($strnum){
			return "<font color='red'>热卖模式</font>";
		}else{
			return "正常模式";
		}
	}
	
	//产品是否推荐
	function GetStrRed($strnum){
		if($strnum){
			return "<font color='red'>推荐模式</font>";
		}else{
			return "正常模式";
		}
	}
	
	function GetStatus($strtime){
		if(!empty($strtime)){
			return "已审核";
		}else{
			return "未审核";
		}
	}
	
	/**
	 * 将提交的数组内容转为字符串
	 * @param void $strArray 数组或为字符串
	 * @return string
	 */
	function  PostArrayToString($strArray){
		if(is_array($strArray)){
			$strReturn=implode(",",$strArray);
		}else{
			$strReturn=$strArray;
		}
		return $strReturn;
	}
	
	/**
	 * 验证值是否存在于指定字符串，主要用来控制前台页面多选按钮
	 * @param string $strtext 指定字符串
	 * @param string $strkey 验证值
	 */
	function HtmlCheck($strtext,$strkey){
		$strreturn="";
		if(!empty($strkey)){
			$strArray=explode(",",$strtext);
			$key_pos=array_search($strkey,$strArray);
			if(is_numeric($key_pos)){
				$strreturn = "checked='checked'";
			}
		}
		return $strreturn;
	}
	
	function UserPower($strtext,$strkey){
		$strreturn=-1;
		if(!empty($strkey)){
			$strArray=explode(",",$strtext);
			$key_pos=array_search($strkey,$strArray);
			if(is_numeric($key_pos)){
				$strreturn=$key_pos;
			}else{
				$strreturn=-1;
			}
		}
		return $strreturn;
	}
	/**
	 * 将数组中的键值与其对应的值转化成字符串 如 array('name'=>'my name') => name='my name'
	 * @param Array $strArray 数组内容
	 * @param string $strJoin 连接字符
	 */
	function ArrayToString($strArray,$strJoin=','){
		if(is_array($strArray)){
			$strText=' ';
			foreach($strArray as $strKey=>$strValue){
				$strText.=' '. $strKey . " = '".$strValue ."' ".$strJoin ;
			}
			$strText=rtrim($strText,$strJoin);
		}else{
			$strText=$strArray;
		}
		return $strText;
	}
	
	/**
	 * 将时间按照指定的格式输出
	 * @param string $timestamp 要转化的时间
	 * @return string 输出指定为Y-m-d格式化时间
	 */
	function TimeFormat($timestamp){
		if(strtotime($timestamp)){
			return date("Y-m-d",strtotime($timestamp));
		}else{
			return $timestamp;
		}
	}
	