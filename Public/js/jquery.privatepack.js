(function($){
/**
 * 菜单切换功能
*/
	$.fn.MenuStab=function(options){
		var opts=$.extend({},$.fn.MenuStab.defaults,options);
		return this.each(function(){
			var	$str_obj=$(this);
			var $str_li=$(opts.attrTag+" li["+opts.attrName+"="+opts.attrValue+"]");
			//console.log($str_obj);
			$str_obj.click(function(){
				$str_li.addClass(opts.classNameOut).removeClass(opts.classNameOn);
				$str_obj.addClass(opts.classNameOn);
				//console.log($str_obj);
			})
		})
	}
 
 
 	$.fn.MenuStab.defaults={
		attrTag:"div.manager_lefttop",	
		attrName:'menulist',
		attrValue:'menu_li',
		classNameOn:'manager_leftli2',
		classNameOut:'manager_leftli1'
		
	};

	$.fn.MenuStab.setDefaults=function(settings) {
		$.extend( $.fn.MenuStab.defaults, settings );
	};
 })(jQuery);