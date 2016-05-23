$(document).ready(function(){
	$("#articleview_btn").click(function(){
		$("#formlist").attr('action',Weburl+'articletypelist/changeview').submit();
	})
})