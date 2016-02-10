jQuery(document).ready(function()
{
	jQuery(window).on('resize', fix_bg_offset);
	fix_bg_offset();
});

function fix_bg_offset() {
  var h = jQuery('#masthead').height();
  jQuery('.site-content').css('background-position', '0px ' + -h + 'px');
}

