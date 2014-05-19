/**
 * 
 */

var searchtext = '';
var map_data_loaded = false;
var map_last_search = '';

jQuery(function()
{
	jQuery(".search-submit").click(function(event)
	{
		event.preventDefault();
		if(searchtext != jQuery('.search-field').val())
		{
			map_show_result('all', function (){
				pontosdecultura_update_posts();
				searchtext = jQuery('.search-field').val();
			});
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
	            	map_show_result_end();
	            },
	            beforeSend: function()
	            {
	            	//jQuery(".Ajax-Loader").toggle();
	            }, 
	        });
		}
}

function pontosdecultura_update_posts_mais_buscadas(str)
{
	map_show_result('mais', function (){
		var old = jQuery('.search-field').val();
		jQuery('.search-field').val(str);
		pontosdecultura_update_posts();
		jQuery('.search-field').val(old);
	});
}

var search_result_left = "";

var adv_search_title = "";
var adv_search_tipo = "";
var adv_search_publicoalvo = "";
var adv_search_estado = "";
var adv_search_cidade = "";

jQuery(document).ready(function()
{
	search_result_left = jQuery("#search-result").position().left;
	
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
		        	jQuery(".Ajax-Loader").toggle();
		        },
		        beforeSend: function()
		        {
		        	jQuery(".Ajax-Loader").toggle();
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
		
		map_show_result('adv', function (){
			
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
				map_show_result_end();
			}
		});
	});
	
	jQuery(".tag-link-0").click(function(event){
		event.preventDefault();
		pontosdecultura_update_posts_mais_buscadas(jQuery(this).text());
        return false;
	});
	
	jQuery('.search-load-button').click(function() {
		//load_map_data('load');
		loadBubbles();
	});
	
	var estadoPosition = jQuery(".search-estado").position();
	
	jQuery("#search-result").css({ 'left' : "-"+(estadoPosition.left + (jQuery( window ).width()+jQuery(".search-estado .container").width())), 'top' : estadoPosition.top });
	jQuery("#search-result").ajaxloader("Aguarde um instante enquanto os dados são carregados<br/>Atenção: Primeira pesquisa é mais demorada.");
	
	jQuery('.search-result-button').click(function() {
		map_voltar_click();
	});
	
	//alert('Fim');
	var datapins =
    {
			get: 'totalPosts',
	        action: 'mapasdevista_get_posts',
	        api: mapinfo.api,
	        page_id: mapinfo.page_id,
	        search: mapinfo.search
    };
	
	jQuery.ajax(
    {
        type: 'POST',
        url: mapinfo.ajaxurl,
        data: datapins,
        success: function(data) {
            totalPosts = parseInt(data);
            
            map_data_loaded_total = totalPosts;
            
            if(totalPosts > 0)
            	pontos_loadPosts(totalPosts, 0);
            
        },
        beforeSend: function()
        {
        	//overlay_filtro();
        }, 
    });
	
});

var estado_search = "";
var map_result_animation_durations = 3000;
function map_estados_click(lat, lon, zoom, term)
{
	mapstraction.setCenterAndZoom(new mxn.LatLonPoint(parseFloat(lat), parseFloat(lon)), parseInt(zoom));
	map_show_result('estados', function (){
	
		if(estado_search != "")
		{
			mapstraction.removeFilter('territorio', 'in', estado_search);
		}
		else
		{
			/*var left = jQuery("#search-result").position().left;
			
			jQuery("#search-result").css( { 'left' : "-"+(jQuery( window ).width()+jQuery("#search-result").width())+"px", 'position' : 'absolute' });
			
			jQuery(".search-estado").prepend(jQuery("#search-result"));
			//jQuery(".search-estado .container").css({'margin-top' : '-540px'});
			jQuery('.search-estado .container').animate({
			    'padding-left' : "+="+(jQuery( window ).width()+jQuery(".search-estado .container").width())+"px",
			}, { duration: map_result_animation_durations, queue: false });
			jQuery('#search-result').animate({
			    'left' : search_result_left
			}, map_result_animation_durations);*/
		}
		
		if(estado_search != term)
		{
			/*jQuery('.search-estado .container').animate({
			    'padding-left' : "+="+(jQuery( window ).width()+jQuery(".search-estado .container").width())+"px",
			}, { duration: map_result_animation_durations, queue: false });
			jQuery('#search-result').animate({
			    'left' : search_result_left
			}, map_result_animation_durations);*/
			mapstraction.addFilter('territorio', 'in', term);
			mapstraction.doFilter();
			updateResults();
			estado_search = term;
		}
		
		jQuery("#progressbar").progressbar( "value", 100 );
		map_show_result_end();
	});
	
}

function map_voltar_click(search)
{
	/*jQuery(search).animate({
	    'padding' : '2em',
	}, { duration: map_result_animation_durations, queue: false });
	jQuery('#search-result').animate({
	    'left' : "-"+(jQuery( window ).width()+jQuery("#search-result").width())+"px"
	}, map_result_animation_durations);*/
	jQuery('.search-estado').animate({'margin-top' : '-='+jQuery("#search-result").height()}, {'duration' : 1200, 'queue' : false})
}
var from_search = '';
var result_callback_func = function () { alert("Error!");}
var scrollOnce = false;

function map_show_result(from, callback)
{
	from_search = from;
	result_callback_func = callback;
	jQuery('#post_overlay').hide();
	jQuery('body, html').animate({scrollTop:jQuery("#search-result").offset().top}, {
		'dutarion' : 1200,
		'queue' : false,
		'complete' : function ()
		{
			if(!scrollOnce)
			{
				scrollOnce = true;
				if( parseInt(jQuery('.search-estado').css('margin-top')) < 100 )
				{
					jQuery('.search-estado').animate (
						{
							'margin-top' : '+='+jQuery("#search-result").height()
						},
						{	
							'duration' : 1200,
							'complete' : function () {
								jQuery(".Ajax-Loader").toggle({'complete' : function(){
									load_map_data(from_search);
								}});
								
							} 
					});
				}
				else
				{
					jQuery(".Ajax-Loader").toggle({'complete' : function(){
						load_map_data(from_search);
					}});
				}
			}
		}
	});
}

function map_show_result_end()
{
	scrollOnce = false;
	jQuery(".Ajax-Loader").toggle();
}

var map_data_bubbles_loaded_total = 0;
function loadBubbles()
{
	var data =
    {
            action: 'mapasdevista_load_bubbles',
            offset: map_data_bubbles_loaded_total
    };
	jQuery.ajax(
    {
        type: 'POST',
                url: homescripts_object.ajax_url,
        data: data,
        success: function(response)
        {
        	if(response == 0)
        	{
        		for (var i = 0; i < mapstraction.markers.length; i ++)
        		{
        			mapstraction.markers[i].setInfoBubble(jQuery('#balloon_' + mapstraction.markers[i].attributes['ID']).html());
        			//jQuery('#balloon_' + mapstraction.markers[i].attributes['ID']).remove();
        			//mapstraction.markers[i].update()
        		}
        	}
        	else
        	{
        		jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 6 );
        		jQuery("#mapasdevista_load_bubbles").append(response);
        		map_data_bubbles_loaded_total += jQuery(response).find('.balloon').length;
        		loadBubbles();
        	}
        },
        beforeSend: function()
        {
        	//overlay_filtro();
        }, 
    });
	
}

function pontos_loadPosts(total, offset)
{
    var posts_per_page = 250;

    jQuery.ajax({
        type: 'post',
        url: mapinfo.ajaxurl,
        dataType: 'json',
        data: {
            page_id: mapinfo.page_id,
            action: 'mapasdevista_get_posts',
            get: 'posts',
            api: mapinfo.api,
            offset: offset,
            total: total,
            posts_per_page: posts_per_page,
            search: mapinfo.search
        },
        success: function(data) {
            
            //console.log('loaded posts:'+offset);

        	jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 3 );
        	
            if (data.newoffset != 'end') {
            	pontos_loadPosts(total, data.newoffset);
                jQuery('#posts-loader-loaded').html(data.newoffset);
            } else {
                jQuery('#posts-loader').hide();
            }
        
            
            for (var p = 0; p < data.posts.length; p++) {
                var pin = data.posts[p].pin;
                if(data.posts[p].link){
                    jQuery(document).data('links-'+data.posts[p].ID,  data.posts[p].link);
                }
                
                
                var pin_size = [pin['1'], pin['2']];

                var ll = new mxn.LatLonPoint( data.posts[p].location.lat, data.posts[p].location.lon );
                var marker = new mxn.Marker(ll);
                
                if(mapinfo.api == 'googlev3'){
                    marker.toProprietary = function(){
                        var args = Array.prototype.slice.call(arguments);
                        var gmarker = mxn.Marker.prototype.toProprietary.apply(this,args);
                        gmarker.setOptions({
                            optimized: false
                        });
                        return gmarker;
                    }
                }
                    
                
                if(mapinfo.api !== 'image' && pin['anchor']) {
                    var adjust = mapinfo.api==='openlayers'?-1:1;
                    var pin_anchor = [parseInt(pin['anchor']['x']) * adjust, parseInt(pin['anchor']['y']) * adjust];
                    marker.setIcon(pin[0], pin_size, pin_anchor);
                } else {
                    marker.setIcon(pin[0]);
                }

                if(pin['clickable']) {
                    marker.setAttribute( 'ID', data.posts[p].ID );
                    marker.setAttribute( 'title', data.posts[p].title );
                    marker.setAttribute( 'date', data.posts[p].date );
                    marker.setAttribute( 'post_type', data.posts[p].post_type );
                    marker.setAttribute( 'number', data.posts[p].number );
                    marker.setAttribute( 'author', data.posts[p].author );
                    marker.setInfoBubble('<div>Loading...</div>');
                    marker.setLabel(data.posts[p].title);
                    
                    
                    //marker.setHover = true;
                    //marker.click.addHandler(function(event) { console.log(event); });
                    
                    
                    for (var att = 0; att < data.posts[p].terms.length; att++) {

                        if (typeof(marker.attributes[ data.posts[p].terms[att].taxonomy ]) != 'undefined' && typeof(marker.attributes[ data.posts[p].terms[att].taxonomy ].push) != 'undefined') {
                            marker.attributes[ data.posts[p].terms[att].taxonomy ].push(data.posts[p].terms[att].slug);
                        } else {
                            marker.attributes[ data.posts[p].terms[att].taxonomy ] = [ data.posts[p].terms[att].slug ];
                        }

                    }
                }
                //jQuery('#balloon_' + data.posts[p].ID).remove();

                mapstraction.addMarker( marker );
                
                if(mapstraction.markerclusterer != null)
                {
                	mapstraction.markerclusterer.addMarker(marker.proprietary_marker);
                }
                if (mapinfo.api == 'openlayers' && pin['clickable']) {
                    marker.proprietary_marker.icon.imageDiv.onclick = function(event) {
                        marker.click.fire();
                    }
                }

            }
            
            if (data.newoffset == 'end')
            {
            	jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 5 );
            	setTimeout(function() 
	            	{
	            		jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 5 );
	    				//result_callback_func();
	    			}, 1000
    			);
            	
            }
        }

    });

}

function load_map_data(from)
{
	jQuery("#progressbar").progressbar( "value", 0 );
	if(map_last_search != from)
	{
		map_last_search = from;
		if(map_last_search != '') mapstraction.removeAllFilters();
	}
	
	if(map_data_loaded == false)
	{
		map_data_loaded = true; // prevent load again
		
		jQuery.ajaxSetup({async:false});
		
		loadBubbles();
		
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
	        	jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 4 );
	        	jQuery(".search-result-list").replaceWith(response);
	        	jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 16 );
            	setTimeout(function() 
	            	{
	            		jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 10 );
	    				result_callback_func();
	    			}, 1000
    			);
	        },
	        beforeSend: function()
	        {
	        	//overlay_filtro();
	        }, 
	    });
		jQuery.ajaxSetup({async:true});
	}
	else
	{
		result_callback_func();
	}
	
}

