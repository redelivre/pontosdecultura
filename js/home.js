/**
 * 
 */

var searchtext = '';

jQuery(function()
{
	jQuery(".search-submit").click(function(event)
	{
		event.preventDefault();
		if(searchtext != jQuery('.search-field').val())
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
			searchtext = jQuery('.search-field').val();
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
        mapstraction.markers[i].closeBubble();
    }
    
    jQuery('#filter_total').html(count);
    
    mapstraction.markerclusterer.setOptions({map:mapstraction.getMap()});
    
    mapstraction.setCenterAndZoom(new mxn.LatLonPoint(parseFloat(mapinfo.lat), parseFloat(mapinfo.lng)), parseInt(mapinfo.zoom));

}

function pontosdecultura_update_posts()
{
        /*var regiao_filtro = new Array();
        jQuery("input[name='regiao_filtro[]']:checked").each(function() {regiao_filtro.push(jQuery(this).val());});
        var idioma_filtro = new Array();
        jQuery("input[name='idioma_filtro[]']:checked").each(function() {idioma_filtro.push(jQuery(this).val());});*/
	
		var searchVal = jQuery('.search-field').val();
		
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
	                s: searchVal
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

/*jQuery(document).ready(function()
{
	var data =
    {
            action: 'map_results',
    };
	jQuery.ajax(
    {
        type: 'POST',
                url: homescripts_object.ajax_url,
        data: data,
        success: function(response)
        {
        	jQuery("#search-result-list").replaceWith(response);
        },
        beforeSend: function()
        {
        	//overlay_filtro('lista-de-pautas');
        }, 
    });
	
});*/

var search_result_left = "";
jQuery(document).ready(function()
{
	search_result_left = jQuery(".search-result").position().left;
});

var estado_search = "";
function map_estados_click(lat, lon, zoom, term)
{
	mapstraction.setCenterAndZoom(new mxn.LatLonPoint(parseFloat(lat), parseFloat(lon)), parseInt(zoom));
	
	if(estado_search != "")
	{
		mapstraction.removeFilter('territorio', 'in', estado_search);
	}
	else
	{
		var left = jQuery(".search-result").position().left;
		
		jQuery(".search-result").css( { 'left' : "-"+(jQuery( window ).width()+jQuery(".search-result").width())+"px", 'position' : 'absolute' });
		
		jQuery(".search-estado").prepend(jQuery(".search-result"));
		//jQuery(".search-estado .container").css({'margin-top' : '-540px'});
		jQuery('.search-estado .container').animate({
		    'padding-left' : "+="+(jQuery( window ).width()+jQuery(".search-estado .container").width())+"px",
		}, { duration: 5000, queue: false });
		jQuery('.search-result').animate({
		    'left' : search_result_left
		}, 5000);
	}
	
	if(estado_search != term)
	{
		mapstraction.addFilter('territorio', 'in', term);
		mapstraction.doFilter();
		updateResults();
		estado_search = term;
	}
}
