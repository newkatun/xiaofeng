function formsearch(){
	var keyword=$("#search_keybtn").val();
	window.navigate("result.php?keyword="+keyword);
}
//通用网址转换
//strid 表示要对象的ID strquery表示要指定参数
function getQueryStringview(strid,strquery){
		 var perpage=$("#"+strid).val();
		 var result = location.search.match(new RegExp("[\?\&][^\?\&]+=[^\?\&]+","g")); 
		 if(result == null){
			 window.location="?"+strquery+"="+perpage;
		 }
		 for(var i = 0; i < result.length; i++){
			 result[i] = result[i].substring(1);
			 if(result[i].indexOf(strquery+"=")===0||result[i].indexOf(strquery+"=")>0){
				result[i]=strquery+"="+perpage;
			 }
		 }
		 queryerul=result.join("&");
		 if(queryerul.indexOf(strquery+"=")===0||queryerul.indexOf(strquery+"=")>0){
			window.location="?"+queryerul;
		 }else{
			window.location="?"+queryerul+"&"+strquery+"="+perpage;
		 }
	}

function getQueryString(){

     var result = location.search.match(new RegExp("[\?\&][^\?\&]+=[^\?\&]+","g")); 

     if(result == null){

         return "";

     }

     for(var i = 0; i < result.length; i++){

         result[i] = result[i].substring(1);
     }
     return result;
	
}

//根据QueryString参数名称获取值

function getQueryStringByName(name){

     var result = location.search.match(new RegExp("[\?\&]" + name+ "=([^\&]+)","i"));

     if(result == null || result.length < 1){

         return "";

     }

     return result[1];

}

//根据QueryString参数索引获取值

function getQueryStringByIndex(index){

     if(index == null){

         return "";

     }

     var queryStringList = getQueryString();

     if (index >= queryStringList.length){

         return "";

     }

     var result = queryStringList[index];

     var startIndex = result.indexOf("=") + 1;

     result = result.substring(startIndex);

     return result;

}
//产品详细页点击产品图出现大图
	 function prodbig_img(imgid){
		$("a#"+imgid).fancybox();
	}
//产品详细页点击产品多图出现大图
	 function prodsma_img(bigimgid,smaimgid,smaurl){
		bigurl=$("#"+smaimgid).attr("src");
		bigurl=bigurl.replace("/smallimg","");
		$("#prod_showimgurl").attr("src",bigurl);
		$("a#"+bigimgid).attr("href",bigurl);
		//$("a#"+smaurl).fancybox();
	}
	
//点击出现层 显示客服账号
	function clickshow(){
		$("div.guestcontact").slideDown();
	}

//得分点击

function change_score(strnum){
	var guest_score=$("#guest_score").val();
	
	if(strnum!=guest_score){
		$("#strcoment_score").removeClass("nsa"+guest_score).addClass("nsa"+strnum);
		$("#guest_score").attr('value',strnum);
	}

}


function showcomments(prodid,pagenum){
	var ttime=new Date();
	var t=ttime.getMilliseconds();
	var strdata;
	$("#prodcomm_text").ajaxStart(function(){
		$("#prodcomm_text").html('<div style=\"width:100px;height:100px;\"><img src=\"'+locationurl+'/images/loading.gif\"></div>');
	});
	$.get(locationurl+"/getajaxcoment.php?action=comment&comid="+prodid+"&page="+pagenum+"&t="+t , function(data) {
		strdata=unescape(data);
		$("#prodcomm_text").html(strdata);
	});
}

