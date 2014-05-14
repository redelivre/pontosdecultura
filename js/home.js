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
	            	//overlay_filtro();
	            }, 
	        });
		}
}

function pontosdecultura_update_posts_mais_buscadas(str)
{
	var old = jQuery('.search-field').val();
	jQuery('.search-field').val(str);
	pontosdecultura_update_posts();
	jQuery('.search-field').val(old);
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
        	//overlay_filtro();
        }, 
    });
	
});*/

var search_result_left = "";

var adv_search_title = "";
var adv_search_tipo = "";
var adv_search_publicoalvo = "";
var adv_search_estado = "";
var adv_search_cidade = "";

jQuery(document).ready(function()
{
	search_result_left = jQuery(".search-result").position().left;
	
	jQuery(".adv-search-estado").change(function () {
		var selected = jQuery( ".adv-search-estado option:selected" ).val();
		if(adv_search_estado != selected)
		{
			adv_search_estado = selected;
			var data =
		    {
		            action: 'select_cidade',
		            uf: selected
		    };
			jQuery.ajax(
		    {
		        type: 'POST',
		                url: homescripts_object.ajax_url,
		        data: data,
		        success: function(response)
		        {
		        	jQuery(".adv-search-cidade").replaceWith(response);
		        },
		        beforeSend: function()
		        {
		        	//overlay_filtro();
		        }, 
		    });
		}
	});
	
	/*
	var adv_search_title = "";
	var adv_search_tipo = "";
	var adv_search_publicoalvo = "";
	var adv_search_estado = "";
	var adv_search_cidade = "";
	 */
	jQuery(".adv-search-submit").click(function(event)
	{
		event.preventDefault();
		
		var title = jQuery(".adv-search-title").val();
		var tipo = jQuery(".adv-search-tipo option:selected").val();
		var publicoalvo = jQuery(".adv-search-publicoalvo option:selected").val();
		var estado = jQuery(".adv-search-estado option:selected").val();
		var cidade = jQuery(".adv-search-cidade option:selected").val();
		var do_filter = false;
		
		if(title != adv_search_title)
		{
			do_filter = true;
			if(adv_search_title != "")
			{
				mapstraction.removeFilter('title', 'like', adv_search_title);
			}
			adv_search_title = title;
			if(title != "")
			{
				mapstraction.addFilter('title', 'like', title);
			}
		}
		if(tipo != adv_search_tipo)
		{
			do_filter = true;
			if(adv_search_tipo != "")
			{
				mapstraction.removeFilter('tipo', 'in', adv_search_tipo);
			}
			adv_search_tipo = tipo;
			if(tipo != "")
			{
				mapstraction.addFilter('tipo', 'in', tipo);
			}
		}
		if(publicoalvo != adv_search_publicoalvo)
		{
			do_filter = true;
			if(adv_search_publicoalvo != "")
			{
				mapstraction.removeFilter('publicoalvo', 'in', adv_search_publicoalvo);
			}
			adv_search_publicoalvo = publicoalvo;
			if(publicoalvo != "")
			{
				mapstraction.addFilter('publicoalvo', 'in', publicoalvo);
			}
		}
		if(cidade != adv_search_cidade)
		{
			do_filter = true;
			if(adv_search_cidade != "")
			{
				mapstraction.removeFilter('cidade', 'in', adv_search_cidade);
			}
			adv_search_cidade = cidade;
			if(cidade != "")
			{
				mapstraction.addFilter('territorio', 'in', cidade);
			}
		}
		else
		{
			if(estado != adv_search_estado)
			{
				do_filter = true;
				if(adv_search_estado != "")
				{
					mapstraction.removeFilter('estado', 'in', adv_search_estado);
				}
				adv_search_estado = estado;
				if(estado != "")
				{
					mapstraction.addFilter('territorio', 'in', estado);
				}
			}
		}
		
		if(do_filter)
		{
			mapstraction.doFilter();
			updateResults();
		}
		
	});
	
	jQuery(".tag-link-0").click(function(event){
		event.preventDefault();
		pontosdecultura_update_posts_mais_buscadas(jQuery(this).text());
        return false;
	});
	
});

var estado_search = "";
var map_result_animation_durations = 3000;
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
		}, { duration: map_result_animation_durations, queue: false });
		jQuery('.search-result').animate({
		    'left' : search_result_left
		}, map_result_animation_durations);
		
		jQuery('.search-result-button').click(function() {
			map_voltar_click(".search-estado .container");
		});
	}
	
	if(estado_search != term)
	{
		jQuery('.search-estado .container').animate({
		    'padding-left' : "+="+(jQuery( window ).width()+jQuery(".search-estado .container").width())+"px",
		}, { duration: map_result_animation_durations, queue: false });
		jQuery('.search-result').animate({
		    'left' : search_result_left
		}, map_result_animation_durations);
		mapstraction.addFilter('territorio', 'in', term);
		mapstraction.doFilter();
		updateResults();
		estado_search = term;
	}
}

function map_voltar_click(search)
{
	jQuery(search).animate({
	    'padding' : '2em',
	}, { duration: map_result_animation_durations, queue: false });
	jQuery('.search-result').animate({
	    'left' : "-"+(jQuery( window ).width()+jQuery(".search-result").width())+"px"
	}, map_result_animation_durations);
}
