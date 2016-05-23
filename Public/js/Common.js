var WEBROOT=location.hostname+"/";
var WEBCOOKIE="/";
var SHHIPING=30.00;
//检查是否为数字
function checkNumber(String) {
	if(String==null){
		return false;
	}
	if(isNaN(String)==""){
	   return false;
	}
	var Letters = "1234567890"; 
	var i; 
	var c; 
	for( i = 0; i < String.length; i ++ ) { 
		c = String.charAt( i ); 
		if (Letters.indexOf( c ) ==-1) { 
		   return false; 
		} 
	} 
	return true; 
}
//字符验证	
function trimTxt(strTxt){
	return strTxt.replace(/(^\s*)|(\s*$)/g,"");
}
var errorInfoText={
	emailerror:'Mailbox format error',
	emaillive:"The E-amil already exists , click here<a href='login.php'>Sing in</a>！"
}

