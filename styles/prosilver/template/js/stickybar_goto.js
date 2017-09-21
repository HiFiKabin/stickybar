$( document ).ready(function() {
    console.log( "ready!" );
});

(function($) {  
    var headerHeight = $("#static-header").height();
    var anchor = window.location.hash.substring(1);
	var target = $('#' + anchor)
    if (target.length) 
    {
        $('html,body').animate({
          scrollTop: target.offset().top - headerHeight
        }, 100);
        return false;
    }
})(jQuery);
