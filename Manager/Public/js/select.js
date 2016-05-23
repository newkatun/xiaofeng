// JavaScript Document
function selectAll(){
	$("input[type='checkbox'][name='id[]']").attr("checked","checked");
	
}
function selectOther(){
	$("input[type='checkbox'][name='id[]']").each(function(){
		var obj=$(this);
		if(obj.attr('checked')=="checked"){
			obj.removeAttr('checked');
		}else{
			obj.attr('checked','checked');
		}
	})
}

function showUploadDialog(strinput){
	var returnValue  = showModalDialog("../uploadfile/upform.php?pfnial="+strinput,window, "dialogWidth:380px;dialogHeight:150px;help:no;scroll:no;status:no");
	if (returnValue  == undefined) {
		returnValue = window.returnValue ;
	}	
	$('#'+strinput).attr('value',returnValue);
}
