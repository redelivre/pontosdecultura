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
var adv_search_cenico = "";
var adv_search_natureza = "";
var adv_search_desdobramentos = "";
var adv_search_publico_alvo = "";
var adv_search_ressonancias = "";

var adv_search_estado = "";
var adv_search_estado_select = "";
var adv_search_cidade = "";

var adv_search_inicio = "";
var adv_search_integrantes = "";
var adv_search_ponto = "";
var adv_search_vinculo = "";
var adv_search_fotos = "";
var adv_search_links = "";
var adv_search_videos = "";
var adv_search_facebook = "";

jQuery(document).ready(function()
{
	
	jQuery(window).on('resize', fix_bg_offset);
	fix_bg_offset();

	search_result_left = jQuery("#search-result").position().left;
	
	jQuery(".adv-search-estado").change(function () {
		var selected = jQuery( ".adv-search-estado option:selected" ).val();
		if(adv_search_estado_select != selected)
		{
			adv_search_estado_select = selected;
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
		        	jQuery('.adv-search-cidade option:selected').text('Carregando Cidades...');
		        }, 
		    });
		}
	});
	
	jQuery(".adv-search-submit").click(function(event)
	{
		event.preventDefault();
		
		map_show_result('adv', function (){
			
			var title = jQuery(".adv-search-title").val();
			var cenico =  jQuery(".adv-search-cenico-performativa option:selected").val();
			var natureza = jQuery(".adv-search-natureza option:selected").val();
			var desdobramentos = jQuery(".adv-search-desdobramentos option:selected").val();
			var publico_alvo = jQuery(".adv-search-publico-alvo option:selected").val();
			var ressonancias = jQuery(".adv-search-ressonancias option:selected").val();
			var estado = jQuery(".adv-search-estado option:selected").val();
			var cidade = jQuery(".adv-search-cidade option:selected").val();
			
			var inicio = jQuery(".adv-search-ano-inicio option:selected").val();
			var integrantes = jQuery('.adv-search-numero-integrantes option:selected').val();;
			var ponto = jQuery('.adv-search-e-ponto option:selected').val();;
			var vinculo = jQuery('.adv-search-vinculo option:selected').val();;
			var fotos = jQuery('.adv-search-fotos option:selected').val();;
			var links = jQuery('.adv-search-links option:selected').val();;
			var videos = jQuery('.adv-search-videos option:selected').val();;
			var facebook = jQuery('.adv-search-facebook option:selected').val();;
			
			if(
					inicio != '' ||
					integrantes != '' ||
					ponto != '' ||
					vinculo != '' ||
					fotos != '' ||
					links != '' ||
					videos != '' ||
					facebook != ''
			) // using ajax
			{
				var fields = {
						"title":title,
						"cenico":cenico,
						"natureza":natureza,
						"desdobramentos":desdobramentos,
						"publico_alvo":publico_alvo,
						"ressonancias":ressonancias,
						"estado":estado,
						"cidade":cidade,
						"_pratica-ano-inicio":inicio,
						"_pratica-numero-integrantes":integrantes,
						"pratica-e-ponto":ponto,
						"pratica-vinculo":vinculo,
						"_pratica-tem-fotos":fotos,
						"_pratica-tem-links":links,
						"pratica-videos":videos,
						"pratica-facebook":facebook
				};
				
				pontosdecultura_update_posts_advsearch(fields);
			}
			else
			{
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
				adv_search_cenico
				if(cenico != adv_search_cenico)
				{
					do_filter = true;
					if(adv_search_cenico != "")
					{
						mapstraction.removeFilter('cenico-performativa', 'in', adv_search_cenico);
					}
					adv_search_cenico = cenico;
					if(cenico != "")
					{
						mapstraction.addFilter('cenico-performativa', 'in', cenico);
					}
				}
				
				if(natureza != adv_search_natureza)
				{
					do_filter = true;
					if(adv_search_natureza != "")
					{
						mapstraction.removeFilter('natureza', 'in', adv_search_natureza);
					}
					adv_search_natureza = natureza;
					if(natureza != "")
					{
						mapstraction.addFilter('natureza', 'in', natureza);
					}
				}
				if(desdobramentos != adv_search_desdobramentos)
				{
					do_filter = true;
					if(adv_search_desdobramentos != "")
					{
						mapstraction.removeFilter('desdobramentos', 'in', adv_search_desdobramentos);
					}
					adv_search_desdobramentos = desdobramentos;
					if(desdobramentos != "")
					{
						mapstraction.addFilter('desdobramentos', 'in', desdobramentos);
					}
				}
				if(publico_alvo != adv_search_publico_alvo)
				{
					do_filter = true;
					if(adv_search_publico_alvo != "")
					{
						mapstraction.removeFilter('publico-alvo', 'in', adv_search_publico_alvo);
					}
					adv_search_publico_alvo = publico_alvo;
					if(publico_alvo != "")
					{
						mapstraction.addFilter('publico-alvo', 'in', publico_alvo);
					}
				}
				if(ressonancias != adv_search_ressonancias)
				{
					do_filter = true;
					if(adv_search_ressonancias != "")
					{
						mapstraction.removeFilter('ressonancias', 'in', adv_search_ressonancias);
					}
					adv_search_ressonancias = ressonancias;
					if(ressonancias != "")
					{
						mapstraction.addFilter('ressonancias', 'in', ressonancias);
					}
				}
				
				if(cidade != adv_search_cidade)
				{
					do_filter = true;
					if(adv_search_cidade != "")
					{
						mapstraction.removeFilter('territorio', 'in', adv_search_cidade);
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
							mapstraction.removeFilter('territorio', 'in', adv_search_estado);
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
				mapstraction.visibleCenterAndZoom();
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
	if (jQuery('.search-estado').css('display') == 'none')
		estadoPosition = jQuery('.advanced-search').position();
	
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
	
	jQuery('a.pontos-js-link-to-post').live('click', function() {
		pontos_linkToPost(document.getElementById(jQuery(this).attr('id')));
        return false;
    });
	
	jQuery(".balloon a.read-more").live('click', function() {
		pontos_linkToPost(document.getElementById(jQuery(this).attr('id')));
        return false;
    });
	
	jQuery('a#pontos_close_post_overlay').click(function() {
		jQuery('#post_overlay').fadeOut(800);
        //mapasdevista.updateHash(false);
    });
	
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

function fix_bg_offset() {
  var h = jQuery('#masthead').height();
  jQuery('.search-intro').css('background-position', '0px ' + -h + 'px');
  jQuery('.login-entry').css('background-position', '0px ' + -h + 'px');
}

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
	var topObject = jQuery('.search-estado').css('display') == 'none'?
		jQuery('.advanced-search') : jQuery('.search-estado');
	topObject.animate({'margin-top' : '-='+jQuery("#search-result").height()}, {'duration' : 800, 'queue' : false})
}
var from_search = '';
var result_callback_func = function () { alert("Error!");}
var scrollOnce = false;

function map_show_result(from, callback)
{
	from_search = from;
	result_callback_func = callback;
	jQuery('#post_overlay').hide();
	var topObject = jQuery('.search-estado').css('display') == 'none'?
		jQuery('.advanced-search') : jQuery('.search-estado');
	jQuery('body, html').animate({scrollTop:jQuery("#search-result").offset().top}, {
		'dutarion' : 1200,
		'queue' : false,
		'complete' : function ()
		{
			if(!scrollOnce)
			{
				scrollOnce = true;
				if( parseInt(topObject.css('margin-top')) < 100 )
				{
					topObject.animate (
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
	jQuery("#progressbar").progressbar( "value", 100 );
	scrollOnce = false;
	jQuery(".Ajax-Loader").toggle();
	//jQuery('[src="http://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png"]:first').click();
	setTimeout(function() 
       	{
			jQuery('[src="http://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png"]:first').click();
		}, 2000
	);
}

function pontos_openInfoBubble()
{
	mapstraction.markers[0].openBubble();
	jQuery(".gm-style-iw").parent().children(":first-child").children(":last-child").css({"background-color" : "#faba09"});
	jQuery(".gm-style-iw").parent().children(":first-child").children("div:nth-child(3)").children(":first-child").children(":first-child").css({"background-color" : "#faba09"});
	jQuery(".gm-style-iw").parent().children(":first-child").children("div:nth-child(3)").children("div:nth-child(2)").children(":first-child").css({"background-color" : "#faba09"});
	mapstraction.setCenterAndZoom(new mxn.LatLonPoint(parseFloat(mapinfo.lat), parseFloat(mapinfo.lng)), parseInt(mapinfo.zoom));
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
        			//mapstraction.markers[i].closeBubble();
        			mapstraction.markers[i].setInfoBubble(jQuery('#balloon_' + mapstraction.markers[i].attributes['ID']).html());
        			//jQuery('#balloon_' + mapstraction.markers[i].attributes['ID']).remove();
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
    var posts_per_page = 400;

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

        	//jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 5 );
        	
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
            	//jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 5 );
            	setTimeout(function() 
	            	{
	            		//jQuery("#progressbar").progressbar( "value", jQuery("#progressbar").progressbar( "value" ) + 5 );
	    				//result_callback_func();
	            		pontos_openInfoBubble();
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
	            location: 'home'
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



function pontosdecultura_update_posts_advsearch(fields)
{
		mapstraction.removeAllFilters();
        var data =
        {
                action: 'home_adv_search',
                data: fields
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

