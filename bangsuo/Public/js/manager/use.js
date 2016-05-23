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
});	