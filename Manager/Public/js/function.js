$(document).ready(function(){
	$("#ChkAll").click(function(){
		if($(this).attr("checked")==true){
			$("input[name='S_ID']").each(function(){
				$(this).attr("checked",true);									 
			})							
		}else{
			$("input[name='S_ID']").each(function(){
				$(this).attr("checked",false);									 
			})							
		}
	})
	
	$("#delallsel4").click(function(){
		$("#ClassIDs").show();
		$("#TopicID").hide();
		$("#deltypes").hide();
	})
	
	$("#delallsel5").click(function(){
		$("#ClassIDs").hide();
		$("#TopicID").show();
		$("#deltypes").hide();
	})
	
	$("#delallsel1").click(function(){
		$("#ClassIDs").hide();
		$("#TopicID").hide();
		$("#deltypes").show();
	})
	
	$("#delallsel6").click(function(){
		$("#ClassIDs").hide();
		$("#TopicID").hide();
		$("#deltypes").hide();
	})
})

function spango(id,url)
{
	$.get(""+url+"?id="+id+"&types=1", 
		  function(obj){
			  $("#span"+id).hide();
		  })
}