KindEditor.ready(function(K) {
	var editor2 = K.create('textarea[name="art_contentsp"]', {
	allowFileManager : true,
	afterCreate : function() {
			var self = this;
			K.ctrl(document, 13, function() {
				self.sync();
				K('form[name=art_contentsp]')[0].submit();
			});
			K.ctrl(self.edit.doc, 13, function() {
				self.sync();
				K('form[name=art_contentsp]')[0].submit();
			});
		}
	});
	var editor3 = K.create('textarea[name="art_contentra"]', {
	allowFileManager : true,
	afterCreate : function() {
			var self = this;
			K.ctrl(document, 13, function() {
				self.sync();
				K('form[name=art_contentra]')[0].submit();
			});
			K.ctrl(self.edit.doc, 13, function() {
				self.sync();
				K('form[name=art_contentra]')[0].submit();
			});
		}
	});
	var editor4 = K.create('textarea[name="art_contental"]', {
	allowFileManager : true,
	afterCreate : function() {
			var self = this;
			K.ctrl(document, 13, function() {
				self.sync();
				K('form[name=art_contental]')[0].submit();
			});
			K.ctrl(self.edit.doc, 13, function() {
				self.sync();
				K('form[name=art_contental]')[0].submit();
			});
		}
	});
})