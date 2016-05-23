/**
 * 微店H5首页
 */
define([
    "../peach",
    "../jquery",
    "../common/Common",
    "../ui/jqLazyload"
], function (peach, $, common) {
    return peach.declare("Index", null, {
        data: null,
        pageData: null,
        category: null,
        dimension: {width: 200,height: 'auto'},
        constructor: function(params){
            peach.mixin(this, params);
            common.setFloatNav();
            common.initGoTopButton();
            window._bd_share_config = {};
            var self=this;
            self.initBanner();
            self.bindEvents();
            //$('img.lazy').lazyload({ effect : 'fadeIn'});
            $('img.lazy').lazyload();
        },
        bindEvents:function(){
        	//banner轮播
            $('#J_Slider').delegate('li','click',function(){
                var url = $(this).attr('data-url'), index = $('#J_Slider li').index(this), spmFlag = 'infr_p=banner_' + (index+1);
                if(url.indexOf('?') > -1){
                	url += '&' + spmFlag;
                }
                else{
                	url += '?' + spmFlag;
                }
                window.open(url);
            });
            //滚动时实时改变遮罩层高度
            $(window).scroll(function(){
            	$('.overlay').css('height',$('#J_Container').height());
            });
            //分享赚佣金链接
            $('body').delegate('.J_shareBtn','click',function(){
            	var goodsId = $(this).data('id');
            	_paq.push(['trackEvent','分享赚佣金','click', goodsId]);
                $('#J_List li').removeClass('current');
                $(this).parents('li').eq(0).addClass('current');
                if(cookie.get('cForCpsPhone')){
                    showSharePanel();
                }
                else{
                	$('body').css('overflow','hidden');
                    $('#J_LoginLayer,.overlay').show();
                    $('#J_LoginLayer').find('.J_Title').text('分享赚佣金');
                    $('#J_GoShare').text('立即去分享').data('flag','share');
                }
                $('.overlay').show().css('height',$('#J_Container').height());
            });
            $('body').delegate('.J_GoH5Item','click',function(){
            	var goodsId = $(this).data('id');
            	_paq.push(['trackEvent','查看详情','click', goodsId]);
            	$('#J_List li').removeClass('current');
                $(this).parents('li').eq(0).addClass('current');
                goH5Item();
                /*** 以下是旧逻辑，填写手机生成sd值带到h5
                if(cookie.get('cForCpsPhone')){
                    goH5Item();
                }
                else{
                	$('body').css('overflow','hidden');
                    $('#J_LoginLayer,.overlay').show();
                    $('.overlay').show().css('height',$('#J_Container').height());
                    $('#J_LoginLayer').find('.J_Title').text('购买返佣金');
                    $('#J_GoShare').text('立即去购买').data('flag','buy');
                }
                ***/
            });
            $('.J_Close').on('click',function(e){
                $('.overlay-box,.overlay').hide();
                $('body').css('overflow','auto');
            });
            $("#J_Phone").on('keyup', function() {
                if($(this).val() != ''){
                    $('#J_GoShare').removeClass('enabled');
                }
                else{
                    $('#J_GoShare').addClass('enabled');
                }
        	});
            $('#J_GoShare').click(function(){
            	var _this = $(this);
                if(!_this.hasClass('enabled')){
                    if(validPhone()){
                        cookie.set('cForCpsPhone',$('#J_Phone').val(),30);
                        if(_this.data('flag') == 'share'){
                        	_paq.push(['trackEvent','输入手机号-去分享','click', '']);
                        	showSharePanel();
                        }
                        else{
                        	_paq.push(['trackEvent','输入手机号-去购买','click', '']);
                        	goH5Item();
                        }
                    }
                }
            });
            $('#J_SharePanel a').click(function(){
               var type = $(this).attr('class');
               shareAPI(type);
            });
        },
        initBanner:function(){
            var index = 1,
                active = 0,
                as = document.getElementById('J_SliderOpt').getElementsByTagName('span');
            var t2=new TouchSlider({id:'J_Slider', speed:600, timeout:4000, before:function(index){
                as[active].className='';
                active=index;
                as[active].className='active';
            }});
        }
    });
    function goH5Item(){
    	var currentItem = $('#J_List li.current'),
    		itemPosFlag = '#' + currentItem.attr('id'),
            phoneNum = '',
            itemId   = currentItem.find('.shareBtn').data('id'),
            wfr = 'beimcu4z';
    	if(common.getQueryString('wfr')!=null){
    		wfr += '_' + common.getQueryString('wfr');
    	}
    	$.ajax({
            url: '/act/url?phoneNum=' + phoneNum + '&itemId=' + itemId  + '&wfr=' + wfr,
            dataType: 'json',
            success: function(data){
                if(data.itemUrl){
                	var localUrl = window.location.href.toString();
                	localUrl = localUrl.split('#')[0];
                	localUrl += itemPosFlag;
                    window.location.href = data.itemUrl + '&skitemId=sk' + itemId + '&eventBackURL=' + encodeURIComponent(localUrl);
                }
            },
            error:function(){

            }
        });
        
    }
    function showSharePanel(){
        var currentItem = $('#J_List li.current'),
            phoneNum = cookie.get('cForCpsPhone'),
            itemId   = currentItem.find('.shareBtn').data('id'),
            title    = '好喜欢这件宝贝！好想买哎...',
            content  = currentItem.find('.description').text(),
            imageUrl = currentItem.find('.img').attr('src'),
            wfr = 'g5vuiiqm';
        if(common.getQueryString('wfr')!=null){
    		wfr += '_' + common.getQueryString('wfr');
    	}
        $('#J_ShareLayer .copy-panel').hide();
        $.ajax({
            url: '/act/url?phoneNum=' + phoneNum + '&itemId=' + itemId + '&wfr=' + wfr,
            dataType: 'json',
            success: function(data){
                if(data.itemUrl){
                	window._bd_share_config.bdItemId = itemId;
                    window._bd_share_config.bdTitle = title;
                    window._bd_share_config.bdDesc = content;
                    window._bd_share_config.bdUrl  = data.itemUrl;
                    window._bd_share_config.bdPic  = imageUrl;
                    $('body').css('overflow','hidden');
                    $('#J_LoginLayer').hide();
                    $('#J_ShareLayer').show();
                    $('.overlay').css('height',$('#J_Container').height());
                    $.ajax({
                        url: 'https://api.weibo.com/2/short_url/shorten.json',
                        type: "get",
                        dataType: 'jsonp',
                        data: {"source": 1681459862, "url_long": window._bd_share_config.bdUrl + '&eventBackURL=' + encodeURIComponent(window.location.href.toString())},
                        async: true,
                        success: function (result) {
                            if (result.code === 1) {
                                $('#J_ShortUrlBox').val(result.data.urls[0].url_short);
                                $('#J_ShareLayer .copy-loading').hide();
                                $('#J_ShareLayer .copy-panel').show();
                            }
                        }
                    });
                }
            },
            error:function(){
            	console.log('数据加载错误');
            }
        });
    }
    function shareAPI(type){
        var itemId = window._bd_share_config.bdItemId,
        	title = encodeURIComponent(window._bd_share_config.bdTitle),
            content = encodeURIComponent(window._bd_share_config.bdDesc),
            url = encodeURIComponent(window._bd_share_config.bdUrl + '&eventBackURL=' + window.location.href.toString()),
            imgUrl = encodeURIComponent(window._bd_share_config.bdPic),
            rnd = new Date().getTime();
        switch(type){
            case 'bds_qzone' :
            	_paq.push(['trackEvent', '分享—QQ空间', 'click', itemId]);
                window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' + url +'&title=' + title + '&desc=' + content + '&summary= &site=&pics=' + imgUrl);
                break;
            case 'bds_tqq' :
            	_paq.push(['trackEvent', '分享—腾讯微博', 'click', itemId]);
                window.open('http://v.t.qq.com/share/share.php?title='+ title +'&url='+ url+'&appkey=801cf76d3cfc44ada52ec13114e84a96&pic='+ imgUrl);
                break;
            case 'bds_tsina' :
            	_paq.push(['trackEvent', '分享—新浪微博', 'click', itemId]);
                window.open('http://v.t.sina.com.cn/share/share.php?appkey=779844294&type=3&searchPic=false&language=zh_cn&rnd=' + rnd + '&title=' + title + '&url=' + url + '&pic=' + imgUrl);
                break;
            case 'popup_douban' :
            	_paq.push(['trackEvent', '分享商品-douban', 'click', itemId]);
                window.open('http://www.douban.com/share/service?href=' + url + '&name=' + title + '&text=' + content + '&image=' + imgUrl);
                break;
            case 'bds_renren' :
            	_paq.push(['trackEvent', '分享商品-renren', 'click', itemId]);
                window.open('http://widget.renren.com/dialog/share?resourceUrl=' + url + '&srcUrl=' + url + '&title=' + title +'&description=' + content + '&pic=' + imgUrl);
                break;
        }
    }
    function validPhone(){
        var phone = $('#J_Phone').val();
        if(!/^[1][34578]\d{9}$/.test(phone)){
            $('#J_ErrorTips').removeClass('none');
            $('#J_GoShare').addClass('enabled');
            return false;
        }
        else{
            $('#J_ErrorTips').addClass('none');
            $('#J_GoShare').removeClass('enabled');
            return true;
        }
    }
});