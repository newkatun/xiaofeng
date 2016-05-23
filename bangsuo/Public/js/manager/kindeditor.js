KindEditor.ready(function(K) {
	var editor1 = K.create('textarea[name="content"]', {
	allowFileManager : true,
	afterCreate : function() {
			var self = this;
			K.ctrl(document, 13, function() {
				self.sync();
				K('form[name=content]')[0].submit();
			});
			K.ctrl(self.edit.doc, 13, function() {
				self.sync();
				K('form[name=content]')[0].submit();
			});
		}
	});
	var strelelen=$('input.uploadimg').length;
	if(strelelen>0){
		K('input.uploadimg').click(function() {  
			editor1.loadPlugin('image', function() {  
				var imageObj=K('input.uploadimg').attr("attrimage");
				var imgWidth=K('input.uploadimg').attr('imgwidth');
				if(isNaN(imgWidth) || imgWidth=='') imgWidth=160;
				editor1.plugin.imageDialog({ 
					imageUrl : K('#'+imageObj).val(), 	
					imgWidth : imgWidth,
					clickFn : function(url, title, width, height, border, align) { 
						K('#'+imageObj).val(url);  
						editor1.hideDialog();
					}			
				});
			});
		});
	}
});