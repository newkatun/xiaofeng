(function($){
/**
 * @倒计时插件
 * @ 2012-10-22
*/
	$.fn.CountDown=function(options){
		var opts=$.extend({},$.fn.CountDown.defaults,options);
		return this.each(function(){
			var $ObjSpan=$(this);
			var Endtime=$ObjSpan.attr(opts.dataattr);
			var TimeLeft=setInterval(function(){
				var CountDownObj=new countdown_obj(Endtime,$ObjSpan);
				CountDownObj.countdown();
			},1000);
		});
	}
	function countdown_obj(datestr,strobj){
		this.datetime=datestr;
		this.countdown=function(){
			var str;
			today=new Date();
			msPerDay=24*60*60*1000
			BirthDay1=new Date(this.datetime);//改成你的计时日期
			timeold1=(BirthDay1.getTime()-today.getTime());
			sectimeold1=timeold1/1000
			secondsold1=Math.floor(sectimeold1);
			e_daysold1=timeold1/msPerDay;
			daysold1=Math.floor(e_daysold1);
			e_hrsold1=(e_daysold1-daysold1)*24;
			hrsold1=Math.floor(e_hrsold1);
			e_minsold1=(e_hrsold1-hrsold1)*60;
			minsold1=Math.floor((e_hrsold1-hrsold1)*60);
			seconds1=Math.floor((e_minsold1-minsold1)*60);
			if(daysold1<0) {
				str="<font style=\"font-style:italic\" color=\"red\">End</font>"
				strobj.html(str);
			}else{
				if(parseInt(daysold1)<10 ) daysold1="0"+daysold1;
				if(parseInt(hrsold1)<10 ) hrsold1="0"+hrsold1;
				if(parseInt(minsold1)<10 ) minsold1="0"+minsold1
				if (parseInt(seconds1)<10) seconds1="0"+seconds1
				str=daysold1+"Days&nbsp;"+hrsold1+":"+minsold1+":"+seconds1+"</li></ul>";
				strobj.html(str);
			}
		}
	}
	
	$.fn.CountDown.defaults={
		
	};

	$.fn.CountDown.setDefaults=function(settings) {
		$.extend( $.fn.CountDown.defaults, settings );
	};
})(jQuery);