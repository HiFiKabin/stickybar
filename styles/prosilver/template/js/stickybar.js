/**
* 
* @package Sticky Bar
* @copyright (c) 2017 javiexin
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* 
*/

$(document).ready(function() {

var fixedNav = function(){
	var fixedTop = $('#page-header > .navbar').offset().top,
		fixedWidth = $('#page-body').width(),
		scrollTop = $(window).scrollTop();

	if (scrollTop > fixedTop) {
		$('#static-header').addClass("shown").removeClass("not-shown").width(fixedWidth);
	} else {
		$('#static-header').addClass("not-shown").removeClass("shown").width(fixedWidth);
	}
};

fixedNav();

$(window).scroll(fixedNav);
$(window).resize(fixedNav);
});
