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
			searchtext = jQuery('#s').val();
		}
	});
});

function pontosdecultura_updateResults(ids)
{
    
    var count = 0;
    
    mapstraction.markerclusterer.setOptions({map:null});
    jQuery(".result").hide();
    
    for (var i = 0; i < mapstraction.markers.length; i ++)
    {
        if (ids.indexOf(mapstraction.markers[i].attributes['ID']) > -1)
        {
            jQuery('#result_' + mapstraction.markers[i].attributes['ID']).show();
            mapstraction.markers[i].show();
            count++;
        }
        else
        {
        	mapstraction.markers[i].hide();
        }
    }
    
    jQuery('#filter_total').html(count);
    
    mapstraction.markerclusterer.setOptions({map:mapstraction.getMap()});

}

function pontosdecultura_update_posts()
{
        /*var regiao_filtro = new Array();
        jQuery("input[name='regiao_filtro[]']:checked").each(function() {regiao_filtro.push(jQuery(this).val());});
        var idioma_filtro = new Array();
        jQuery("input[name='idioma_filtro[]']:checked").each(function() {idioma_filtro.push(jQuery(this).val());});*/
	
		var searchVal = jQuery('#s').val();
		
		if(searchVal == '')
		{
			mapstraction.markerclusterer.setOptions({map:null});
			jQuery(".result").show();
			for (var i = 0; i < mapstraction.markers.length; i ++)
		    {
				mapstraction.markers[i].show();
		    }
			mapstraction.markerclusterer.setOptions({map:mapstraction.getMap()});
			jQuery('#filter_total').html(mapstraction.markers.length);
		}
		else
		{
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
	            	pontosdecultura_updateResults(response);
	            },
	            beforeSend: function()
	            {
	            	//overlay_filtro('lista-de-pautas');
	            }, 
	        });
		}
}

