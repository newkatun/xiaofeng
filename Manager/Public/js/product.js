$(document).ready(function(){
	/* var mainid=$("#prod_main").val();
	var subid=$("#prod_sub").attr("attrvalue");
	GetAjaxSelect(mainid,subid);
	$("#prod_main").change(function(){
		mainid=$("#prod_main").val();
		GetAjaxSelect(mainid,subid);
	}) */
	$("#ProdUpOnline").click(function(){
		$("form#formlist").attr("action",webUrl+"Productlist/uponline");
	});
	
	$("#ProdDownline").click(function(){
		$("form#formlist").attr("action",webUrl+"Productlist/downline");
	});
	
	$("#p_typeid").change(function(){
		var mainid=parseInt($("#p_typeid").val());
		var	t=parseInt(Math.random()*100);
		if(mainid){
			$.post(webUrl+"ajaxdata/getCateSub/t/"+t,{mid:mainid},function(data){
				$("#p_ttypeid").empty();
				$("#p_ttypeid").append(data);
			});
		}
	});
	$("input#soletype").click(function(){
		$("form#formlist").attr("action",webUrl+"Productlist/soletype");
	})
	
})

function GetAjaxSelect(mainid,subid){
	if(mainid>0){
		var	t=parseInt(Math.random()*100);
		$.post(webUrl+"Categorysublist/getCateSubAjax/t/"+t,{mid:mainid,sid:subid},function(data){
			$("#prod_sub").empty();
			$("#prod_sub").append(data);
		})
	}else{
		$("#prod_sub").empty();
		$("#prod_sub").append("<option value='0'>选择产品二级类别</option>");
	}
}