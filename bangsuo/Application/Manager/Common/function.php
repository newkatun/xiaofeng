<?php
function check_verify($code, $id = ''){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}
function UserPower($strtext,$strkey){
	$strreturn=-1;
	if(!empty($strkey)){
		$strArray=explode(",",$strtext);
		$key_pos=array_search($strkey,$strArray);
		if(is_numeric($key_pos)){
			$strreturn=$key_pos;
		}
	}
	return $strreturn;
}
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

function ProdStatus($strKey){
	
	if(true===$strKey || 'T'==$strKey || 'Y'==$strKey || (is_int($strKey) && $strKey>0)){
			$strReturn="<font color='green'>是</font>";
	}else{
		$strReturn="<font color='red'>否</font>";
	}
	return $strReturn;
}
//字符比较，相等时返回选中
function CheckStr($str1,$str2){
	if($str1==$str2){
		return "checked=checked";
	}
}

function SelectChars($str1,$str2){
	if($str1==$str2){
		return "selected='selected'";
	}	
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
 * 保存访问过页面地址，以便于提交表格之后返回到对应的页面，适用于分页
 * @param string $pageName
 * @param number $pageNum
 */	
function ReturnUrl($pageName,$pageNum=1){
	$pageUrl=$pageName.'/index/p/'.$pageNum.'.html';
	 setcookie('PageName',$pageUrl,time()+3600,'/');
}

/**
 * 将名称转为url字符串
 */
function NameToUrl($str){
	$str =str_replace(' ', '-', $str);
	$str =str_replace("'", '', $str);
	$str =str_replace('(', '', $str);
	$str =str_replace(')', '', $str);
	return $str;
}

function compareArray($array1,$array2){
	if(is_array($array1)){
		foreach($array1 as $key=>$vaue){
			if(strcmp($vaue,$array2[$key])===0)
				unset($array1[$key]);
		}
	}
	return $array1;
}



function compareArrays($array1,$array2){
	if(is_array($array1)){
		foreach($array1 as $key=>$value){
			foreach($array2 as $field=>$data){
				if(isset($array1[$key][$field])) {
					if(strcmp($array1[$key][$field],$data)===0){
						unset($array1[$key][$field]);
					}
				}
			}
		}
	}
	return $array1;
}


