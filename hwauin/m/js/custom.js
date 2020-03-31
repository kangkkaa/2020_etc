$(document).ready(function(){
	

	$('.navi-open-btn').click(function(){
		$('.navigation').fadeIn(100);
		$(this).hide();
		$('.navi-close-btn').show();
		return false;
	});
	
	$('.navi-close-btn').click(function(){
		$('.navigation').fadeOut(100);
		$(this).hide();
		$('.navi-open-btn').show();
		return false;
	});
		
	$('.submenu-icon').click(function(){
		$(this).parent().find('.submenu').toggle(100);
		return false;
	});
			
	$('.bxslider').bxSlider({
		pager:false,
		controls:true,
		touchEnabed:true,
		infiniteLoop: true,
		preventDefaultSwipeX:true
	});	
	
	$('.bx-next').click(function(){
		return false;
	});
	
	$('.bx-prev').click(function(){
		return false;
	});	
	
	$('.page-coach').hide();
	
	$('.nav-coach').click(function(){
		$('.page-coach').fadeIn(200);
		document.ontouchmove = function(event){ event.preventDefault();}
		snapper.close();
	});
	
	$('.page-coach').click(function(){
		$('.page-coach').fadeOut(200);
		document.ontouchmove = function(event){ event.allowDefault();}
	});
	
});

