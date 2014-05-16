(function (jQuery) {
    jQuery.fn.ajaxloader = function (msn)
    {
    	msn = typeof msn == 'undefined' ? '' : msn;
        var ajaxloader = jQuery('<div class="Ajax-Loader"><div class="Ajax-Loader-Overlay"></div><div class="Ajax-Loader-Image ui-corner-all"><div id="progressbar"></div><div class="Ajax-Loader-Text">'+msn+'</div></div></div>');
        this.after(ajaxloader);
        ajaxloader.css('top', this.position().top).width(this.outerWidth()).height(this.outerHeight());
        ajaxloader.find('.Ajax-Loader-Overlay').css('opacity', 0.5).width(this.outerWidth()).height(this.outerHeight());
        jQuery('.Ajax-Loader-Image').css({'top' : ((jQuery(window).height() / 2) - (jQuery(".Ajax-Loader-Image img").width())), 'left' : ((jQuery('.Ajax-Loader').width()/2)-(jQuery(".Ajax-Loader-Image img").width())/2)});
        jQuery('.Ajax-Loader-Text').css({'margin-left' : ("-"+(jQuery('.Ajax-Loader-Text').width()/3)+"px")});
        ajaxloader.hide();
        jQuery( "#progressbar" ).progressbar({
        	value: 0
        	});
        return ajaxloader;
    };
})(jQuery);