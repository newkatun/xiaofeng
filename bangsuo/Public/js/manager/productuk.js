$(document).ready(function(){
	$("#ProdUpOnline").click(function(){
		$("form#formlist").attr("action",webUrl+"manager/productlistuk/statuschg/name/upline");
	});
	
	$("#ProdDownline").click(function(){
		$("form#formlist").attr("action",webUrl+"manager/productlistuk/statuschg/name/downline");
	});
	
	$("#prod_mainid").change(function(){
			var mainid=parseInt($("#prod_mainid").val());
			var subid = 0;
			GetAjaxSelect(mainid,subid);
	});
	$("input#soletype").click(function(){
		$("form#formlist").attr("action",webUrl+"manager/productlistuk/Selectview");
	});
	
	$("select#prodtype").change(function(){
		var typeId,paramText='';
		typeId=$("select#prodtype").val();
		if(isNaN(typeId)) typeId =0;
		typeId=parseInt(typeId);
		if(typeId>0) paramText='/mid/'+typeId;
		window.location.href=webUrl+'manager/productlistuk/index'+paramText;
			
	})
	
	$("div.imgRemove").click(function(){
		if(confirm("确定要删除该图片")){
			var imgid=$(this).attr("attrid");
			var	t=parseInt(Math.random()*100);
			$.post(webUrl+"manager/prodimguk/dellist/t/"+t,{imgid:imgid},function(data){
				if(data){
					$("ul#imgUL_"+imgid).remove();
				}
			})
		}
	});
	$("div.imgsetDefault").click(function(){
		if(confirm("确定要设置该图片为产品图片")){
			var imgid=$(this).attr("attrid");
			var pid=$(this).attr("prodId");
			var imgsrc = $("#img_"+imgid).attr("src");
			var	t=parseInt(Math.random()*100);
			$.post(webUrl+"manager/prodimguk/setimg/t/"+t,{imgid:imgid,prodid:pid,imgsrc:imgsrc},function(data){
				if(data==1){
					$("ul#imgUL_"+imgid).css('border','1px solid red');
				}
			})
		}
	});
	var mainid=parseInt($("#prod_mainid").val());
	var subid = parseInt($("#subvalue").val());
	GetAjaxSelect(mainid,subid);
})

function GetAjaxSelect(mainid,subid){

		var	t=parseInt(Math.random()*100);
		if(mainid>0){
			$.post(webUrl+"manager/categoryuk/getAjaxData/t/"+t,{mid:mainid,sid:subid},function(data){
				$("#prod_subid").empty();
				$("#prod_subid").append(data);
			});
		}else{
		$("#prod_sub").empty();
		$("#prod_sub").append("<option value='0'>选择产品二级类别</option>");
		}
}