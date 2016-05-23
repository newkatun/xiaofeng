KindEditor.ready(function(K){
	var  editor =K.editor({  
		allowFileManager : true
	});
	K('input.uploadimg').click(function() {  
		var attrname=K('input.uploadimg').attr('attrname');
		editor.loadPlugin('image', function() {  
		editor.plugin.imageDialog({ 
			imageUrl : K('#'+attrname).val(), 	
			clickFn : function(url, title, width, height, border, align) { 
				K('#'+attrname).val(url);  
						editor.hideDialog();
				}			
			});
		});
	});
	
	K('#addMoreImg').click(function(){
		var addImgtable=K('td.table_imgcont').css("display","block");
		editor.loadPlugin('multiimage', function() {  
			editor.loadPlugin('multiimage', function() {
				editor.plugin.multiImageDialog({
					clickFn : function(urlList) {
						var tableImg = K('#imgContainer');
						var  strText="";
						K.each(urlList, function(i, data) {
							strText="<ul >";
							strText+="<li><img src='"+data.url+"' width='160' height='113'><input type='hidden' name='imgurl[]' value='" + data.url + "' /></li>";
							strText+="<li class='li_input'><input type='text' name='imgname[]' size='20'/></li>";
							strText+="</ul>";
							tableImg.append(strText);
						});
						editor.hideDialog();
					}
				});
			});
		})
	})
})
