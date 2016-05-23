/*********************************************
 * 树形结构菜单展开
 * 采用点击某个对象时才展开
*/
;(function($){
	$.fn.SubMenuShow=function(options){
		var opts=$.extend({},$.fn.SubMenuShow.defaults,options);
		return this.click(function(){
			$submenuobj=$(this);
			$submenuobjsrc=$submenuobj.attr('src');
			if($submenuobjsrc==opts.showimg){
				$submenuobj.next().slideDown();
				$submenuobj.attr('src',opts.hideimg);
			}else{
				$submenuobj.next().slideUp();
				$submenuobj.attr('src',opts.showimg);
			}
		})
	};
	$.fn.SubMenuShow.defaults={};
	$.fn.SubMenuShow.setDefaults=function(settings){
		$.extend($.fn.SubMenuShow.defaults,settings);
	}
})(jQuery);