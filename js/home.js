/**
 * 
 */

var searchtext = '';

jQuery(function()
{
	jQuery("#searchsubmit").button().click(function(event)
	{
		event.preventDefault();
		if(searchtext != jQuery('#s').val())
		{
			/*if(searchtext != '')
			{
				mapstraction.removeFilter('title', 'like', searchtext);
			}
			searchtext = jQuery('#s').val();
			mapstraction.addFilter('title', 'like', jQuery('#s').val());
			mapstraction.doFilter();
	        updateResults();*/
			pontosdecultura_update_posts();
		}
	});
});

function pontosdecultura_update_posts()
{
        /*var regiao_filtro = new Array();
        jQuery("input[name='regiao_filtro[]']:checked").each(function() {regiao_filtro.push(jQuery(this).val());});
        var idioma_filtro = new Array();
        jQuery("input[name='idioma_filtro[]']:checked").each(function() {idioma_filtro.push(jQuery(this).val());});*/
	
        var data =
        {
                action: 'home_search',
                s: jQuery('#s').val()
        };
         
        jQuery.ajax(
        {
            type: 'POST',
                    url: homescripts_object.ajax_url,
            data: data,
            success: function(response)
            {
            	jQuery('#results').replaceWith(response); 
            },
            beforeSend: function()
            {
            	//overlay_filtro('lista-de-pautas');
            }, 
        });
}