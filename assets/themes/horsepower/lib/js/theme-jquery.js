jQuery(document).ready(function($) {	
    $('*:first-child').addClass('first-child');
    $('*:last-child').addClass('last-child');
    $('*:nth-child(even)').addClass('even');
    $('*:nth-child(odd)').addClass('odd');
	
	var numwidgets = $('#footer-widgets div.widget').length;
	$('#footer-widgets').addClass('cols-'+numwidgets);
	
	//special for lifestyle
	$('.ftr-menu ul.menu>li').after(function(){
		if(!$(this).hasClass('last-child') && $(this).hasClass('menu-item') && $(this).css('display')!='none'){
			return '<li class="separator">|</li>';
		}
	});
	$('.page-template-page-sectioned .site-inner').css('display',function(){
	    var content = $(this).find('.entry-content').html();
	    if(content.length == 0){
	        $('.sectioned-page-wrapper').css('margin-top','20px');
	        return 'none';
	    } else {
	        return 'block';
	    }
	});
});