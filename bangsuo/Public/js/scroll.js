$(function () {
	var num = $('.bot-nav p').length;
	$('.bot-nav').css('top','-'+(num * 26+10) +'px');
	showScroll();
	showBotNav();
  function showScroll() {
    $(window).scroll(function () {
      var scrollValue = $(window).scrollTop();
      scrollValue > 100 ? $('div[class=scroll]').fadeIn()  : $('div[class=scroll]').fadeOut();
    });
    $('#scroll').click(function () {
      $('html,body').animate({
        scrollTop: 0
      }, 200);
    });
  }
  
  function showBotNav(){
	  $('.bot-box').click(function(){
		  $('.bot-nav').css('display','inline');
	  }).mouseleave(function(){
		  $('.bot-nav').css('display','none');
	  });
  }
})