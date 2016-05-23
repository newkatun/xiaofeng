$(document).ready(function(){
	var index = parent.layer.getFrameIndex();
	var strtext=$('#addressnew').html();
	var strmessage=$("div.table_address").attr('straddressdata');
	var straddId=$("div.table_address").attr('strAddressId');
	var strshipping=$("div.table_address").attr('strship');
	$(window.parent.document).find('div').remove("div.table_selectdiv");
	$(window.parent.document).find('.table_address').removeClass('table_addselect');
	$(window.parent.document).find('#checkaddreess').removeAttr('disabled');
	$(window.parent.document).find('.div_insertafter').after($("#addressnew").html(strtext));
	$(window.parent.document).find('span.confirm_p_address').text(strmessage);
	$(window.parent.document).find('#guestaddressId').attr('value',straddId);
	parent.layer.close(index);
});