var webUrl="http://"+location.hostname+"/manager.php/";
var webRoot="http://"+location.hostname+"/";
document.ondragstart=function(){return false;}
function LanguageView(strlang){
	$.cookie("MLANGUAGE",strlang,{expires:5,path:"/"});
	   window.location.reload();
}

$(document).ready(function(){
	$("input.selectall").click(function(){
		$("input:checkbox").prop("checked",true);
	});
	
	$("input.selectOther").click(function(){
		$("input:checkbox").each(function(){
			var $obj=$(this);
			if($obj.prop('checked')){
				$obj.prop('checked',false);
			}else{
				$obj.prop('checked',true);
			}
		});
	});
	
	$("input.unselectall").click(function(){
		$("input:checkbox").prop("checked",false);
	});
	
	$("input#search").click(function(){
		var pageUrl=window.document.URL;
		var pageName=pageUrl.replace(webUrl,"");
		var pageFlag=pageName.indexOf("/");
		var keyword=$("input#keyword").val();
		if(pageFlag>0){
			pageName=pageName.substr(0,pageFlag)
		}
		if(keyword!=""){
			window.location.href=webUrl+pageName+"/index/keyword/"+keyword;
		}
	});
	
	$("div.imgRemove").click(function(){
		if(confirm("确定要删除该图片")){
			var imgid=$(this).attr("attrid");
			var	t=parseInt(Math.random()*100);
			$.post(webUrl+"ajaxdata/delImgData/t/"+t,{imgid:imgid},function(data){
				if(data){
					$("ul#imgUL_"+imgid).remove();
				}
			})
		}
	})
});