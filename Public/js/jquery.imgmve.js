(function($){
	$.fn.ImgSlide=function(options){
		var opts=$.extend({},$.fn.ImgSlide.defaults,options);
		var str_ti=0;
		return this.each(function(){
			var $str_obj=$(this);
			var $str_html=$str_obj.html();
			;//将父容器对象里面容复制一遍
			
			var $str_subobj=$("div."+opts.subname);
			$str_obj.append($str_html);//* 如果放在上一条的前面是显示数量将是放在此处数量的两倍
			var $str_sublen=$str_subobj.length;
			
			
			ImgMoveUp(str_ti);
			
		});
		function ImgMoveUp(str_ti){
		
			
			$("div.teacher_view").eq(str_ti).slideUp(3000);
			
		}
	};
	$.fn.ImgSlide.defaults={
		divname:'teacher_big',	//默认容器对象
		subname:'teacher_view'  //子容器对象
	};
	$.fn.ImgSlide.setDefaults=function(settings){
		$.extend($.fn.ImgSlide.defaults,settings)
	};


})(jQuery);