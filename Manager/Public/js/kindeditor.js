KindEditor.ready(function(K) {
	var editor1 = K.create('textarea[name="p_content"]', {
	allowFileManager : true,
	afterCreate : function() {
			var self = this;
			K.ctrl(document, 13, function() {
				self.sync();
				K('form[name=p_content]')[0].submit();
			});
			K.ctrl(self.edit.doc, 13, function() {
				self.sync();
				K('form[name=p_content]')[0].submit();
			});
		}
	});
	var strelelen=$('input.uploadimg').length;
	if(strelelen>0){
		K('input.uploadimg').click(function() {  
			editor1.loadPlugin('image', function() {  
				var imageObj=K('input.uploadimg').attr("attrimage");
				editor1.plugin.imageDialog({ 
					imageUrl : K('#'+imageObj).val(), 	
					clickFn : function(url, title, width, height, border, align) { 
						K('#'+imageObj).val(url);  
						editor1.hideDialog();
					}			
				});
			});
		});
	}
});