<?php
/**
 * 字符串检测
 * @param String $strText
 * @return string 
 */
function CheckString($strText = '') {
	if (! empty ( $strText )) {
		$strText = htmlspecialchars ( trim ( $strText ) );
	}
	return $strText;
}
/**
 * 去除内容中的HTML标签内容
 *
 * @param string $sourcestr        	
 * @return string
 */
function RemoveHtml($sourcestr) {
	$sourcestr = htmlspecialchars_decode ( trim ( $sourcestr ) );
	$sourcestr = strip_tags ( $sourcestr );
	return $sourcestr;
}

/**
 * 根据产品类型编号读取产品类型中的名称
 */
function CataNameView($dataArray, $mainid, $subid = 0) {
	if (is_array ( $dataArray ) && ! empty ( $dataArray )) {
		foreach ( $dataArray as $data ) {
			if ($data ['autoid'] == $mainid) {
				if ($subid > 0 && is_array ( $data ['subCatalog'] )) {
					foreach ( $data ['subCatalog'] as $subData ) {
						if ($subData ['autoid'] == $subid) {
							return $subData ['ty_name'];
						}
					}
				}
				return $data ['ty_name'];
			}
		}
	}
}
/**
 * 字符截取功能
 *
 * @param string $sourcestr        	
 * @param int $cutlength        	
 * @return string
 */
function GetStrLen($sourcestr, $cutlength) {
	$returnstr = '';
	$i = 0;
	$n = 0;
	$str_length = strlen ( $sourcestr ); // 字符串的字节数
	if ($str_length > 0) {
		$sourcestr = RemoveHtml ( $sourcestr );
		while ( ($n < $cutlength) and ($i <= $str_length) ) {
			$temp_str = substr ( $sourcestr, $i, 1 );
			$ascnum = Ord ( $temp_str ); // 得到字符串中第$i位字符的ascii码
			if ($ascnum >= 224) 			// 如果ASCII位高与224，
			{
				$returnstr = $returnstr . substr ( $sourcestr, $i, 3 ); // 根据UTF-8编码规范，将3个连续的字符计为单个字符
				$i = $i + 3; // 实际Byte计为3
				$n ++; // 字串长度计1
			} elseif ($ascnum >= 192) 			// 如果ASCII位高与192，
			{
				$returnstr = $returnstr . substr ( $sourcestr, $i, 2 ); // 根据UTF-8编码规范，将2个连续的字符计为单个字符
				$i = $i + 2; // 实际Byte计为2
				$n ++; // 字串长度计1
			} elseif ($ascnum >= 65 && $ascnum <= 90) 			// 如果是大写字母，
			{
				$returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
				$i = $i + 1; // 实际的Byte数仍计1个
				$n ++; // 但考虑整体美观，大写字母计成一个高位字符
			} else 			// 其他情况下，包括小写字母和半角标点符号，
			{
				$returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
				$i = $i + 1; // 实际的Byte数计1个
				$n = $n + 0.5; // 小写字母和半角标点等与半个高位字符宽...
			}
		}
		if ($str_length > $cutlength) {
			$returnstr = $returnstr . "..."; // 超过长度时在尾处加上省略号
		}
	}
	return $returnstr;
}
/**
 * 显示不同尺寸图片
 *
 * @param string $imgUrl
 *        	图片路径
 * @param
 *        	string @imgType 显示类型 默认是大图
 * @param int $imgSize
 *        	图片大小
 * @return string
 */
function ImgShowType($imgUrl, $imgType = '', $smaimg = false, $imgSize = 100) {
	if (empty ( $imgUrl )) {
		return '';
		exit ();
	}
	$dataImg = pathinfo ( $imgUrl );
	if ($imgType == 'smallimg') {
		$imgUrl = str_replace ( 'image', 'smallimg', $dataImg ['dirname'] ) . '/' . $dataImg ['filename'];
		if ($smaimg)
			$imgUrl .= '_' . $imgSize;
		$imgUrl .= '.' . $dataImg ['extension'];
		// str_replace('image','smallimg',$dataImg['dirname']).'/'.$dataImg['filename'].'_'.$imgSize.'.'.$dataImg['extension'];
		return $imgUrl;
	} else {
		if ($smaimg) {
			$strNum = strpos ( $dataImg ['filename'], '_' );
			if (! $strNum)
				$strNum = strlen ( $dataImg ['filename'] );
			$filename = substr ( $dataImg ['filename'], 0, $strNum );
			return str_replace ( 'smallimg', 'image', $dataImg ['dirname'] ) . '/' . $filename . '.' . $dataImg ['extension'];
		} else {
			return str_replace ( 'smallimg', 'image', $imgUrl );
		}
	}
}
function TimeShort($strTime) {
	if (strtotime ( $strTime )) {
		$timestamp = strtotime ( $strTime );
		return date ( 'Y-m-d', $timestamp );
	} else {
		return "格式错误";
	}
}

/**
 * 将指定的数据加入到COOKIE中，
 *
 * @param int $pid
 *        	产品编号
 * @param int $len
 *        	存储长度
 */
/* function getCookieProd($pid, $cookieName = 'ProdId', $len = 4) {
	$prodId = cookie ( $cookieName );
	if (empty ( $prodId )) {
		$prodId = $pid;
		cookie ( $cookieName, $pid );
	} else {
		$prodArray = explode ( ',', $prodId );
		if (array_search ( $pid, $prodArray ) === false) {
			if (count ( $prodArray ) < $len) {
				$prodId .= ',' . $pid;
				cookie ( $cookieName, $prodId );
			} else {
				array_unshift ( $prodArray, $pid );
				unset ( $prodArray [$len] );
				$prodId = implode ( ',', $prodArray );
				cookie ( $cookieName, $prodId );
			}
		}
	}
	return $prodId;
} */


function HtmlWords($str) {
	$str = str_replace ( '&gt;', '>', $str );
	$str = str_replace ( '&lt;', '<', $str );
	return $str;
}
function CheckIsSet($strObj) {
	if (isset ( $strObj ) && ! empty ( $strObj )) {
		return $strObj;
	}
}
function QqNumber($strQQ, $strOne = true) {
	if (! empty ( $strQQ )) {
		$strArray = explode ( '|', $strQQ );
		if ($strOne) {
			return $strArray [0];
		} else {
			$strText = '';
			foreach ( $strArray as $strQ ) {
				$strText .= '<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=' . $strQ . '&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:' . $strQ . ':51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>';
			}
			return $strText;
		}
	}
}

function PhoneNumber($strPhone){
	if (! empty ( $strPhone )) {
		
		return str_replace('|', '<br/>', $strPhone)	;
			
	}
	
}
function CheckHttpUrl($strUrl) {
	// if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='off')
	return strpos ( $strUrl, 'http://' ) === false && strpos ( $strUrl, 'https://' ) === false ? true : false;
}
function DateFormate($strTime, $str = '') {
	$time = strtotime ( $strTime );
	if ($time) {
		if (empty ( $str ))
			return date ( 'Y-m-d', $time );
		else
			return date ( $str, $time );
	}
}

/**
 * 网页跳转链接地址
 *
 * @param string $pageName
 *        	页面名称
 * @param int $pageStyle
 *        	0：内容型 1：文章列表 2：图片类型
 * @param string $strurl
 *        	跳转地址
 */
function UrlHrefAdd($pageName, $pageStyle = 0, $strUrl = '') {
	if (! empty ( $strUrl )) {
		$strUrl = strpos ( $strUrl, '://' ) > 0 ? $strUrl : __ROOT__ . '/home' . $strUrl;
		return $strUrl;
	}
	$pagePrefix = $pageStyle > 0 ? 'artlist' : 'content';
	return __ROOT__ . '/home/' . $pagePrefix . '/index/rurl/' . strtolower ( $pageName );
}
function UrlHrefNavAdd($strUrl) {
	if (! empty ( $strUrl )) {
		$strUrl = strpos ( $strUrl, '://' ) > 0 ? $strUrl : __ROOT__ . '/home' . $strUrl;
		return $strUrl;
	}
}
function isMobile() {
	// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	if (isset ( $_SERVER ['HTTP_X_WAP_PROFILE'] )) {
		return true;
	}
	// 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	if (isset ( $_SERVER ['HTTP_VIA'] )) {
		// 找不到为flase,否则为true
		return stristr ( $_SERVER ['HTTP_VIA'], "wap" ) ? true : false;
	}
	// 判断手机发送的客户端标志,兼容性有待提高
	if (isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
		$clientkeywords = array (
				'nokia',
				'sony',
				'ericsson',
				'mot',
				'samsung',
				'htc',
				'sgh',
				'lg',
				'sharp',
				'sie-',
				'philips',
				'panasonic',
				'alcatel',
				'lenovo',
				'iphone',
				'ipod',
				'blackberry',
				'meizu',
				'android',
				'netfront',
				'symbian',
				'ucweb',
				'windowsce',
				'palm',
				'operamini',
				'operamobi',
				'openwave',
				'nexusone',
				'cldc',
				'midp',
				'wap',
				'mobile'
		);
		// 从HTTP_USER_AGENT中查找手机浏览器的关键字
		if (preg_match ( "/(" . implode ( '|', $clientkeywords ) . ")/i", strtolower ( $_SERVER ['HTTP_USER_AGENT'] ) )) {
			return true;
		}
	}
	// 协议法，因为有可能不准确，放到最后判断
	if (isset ( $_SERVER ['HTTP_ACCEPT'] )) {
		// 如果只支持wml并且不支持html那一定是移动设备
		// 如果支持wml和html但是wml在html之前则是移动设备
		if ((strpos ( $_SERVER ['HTTP_ACCEPT'], 'vnd.wap.wml' ) !== false) && (strpos ( $_SERVER ['HTTP_ACCEPT'], 'text/html' ) === false || (strpos ( $_SERVER ['HTTP_ACCEPT'], 'vnd.wap.wml' ) < strpos ( $_SERVER ['HTTP_ACCEPT'], 'text/html' )))) {
			return true;
		}
	}
	return false;
}