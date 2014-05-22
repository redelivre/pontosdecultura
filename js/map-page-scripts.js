var filter_panel_estado_select = '';
var filter_panel_cidade = "";

jQuery(document).ready(function()
{
	mapstraction.maps[mapinfo.api].setOptions({
        mapTypeControl: mapinfo.control_map_type,
        panControl: mapinfo.control_pan,
        zoomControl: mapinfo.control_zoom != false,
        zoomControlOptions:{
            style: mapinfo.control_zoom ? google.maps.ZoomControlStyle[mapinfo.control_zoom.toUpperCase()] : 0 ,
            position: google.maps.ControlPosition.RIGHT_CENTER
        },
        panControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER
        },
        scrollwheel: true
    });
	
	jQuery(".filter-panel-tooglebox-meta-head").click(function () {
		jQuery(this).parent('div').children('.filter-panel-tooglebox-list').toggle(400);
		jQuery(this).children('.filter-panel-tooglebox-button').toggleClass("icon-up icon-down");
	});

	// Count the checkboxes inside each toggle box
	jQuery(".taxonomy-filter-checkbox").on("change", function()
	{
		var $this = jQuery(this);
		var togglebox_panel = '.filter-panel-tooglebox';
		var counter_container = '.filter-panel-tooglebox-counter';
		var counter = $this.parents(togglebox_panel).find(".taxonomy-filter-checkbox:checked").length;

		if ( counter > 0 )
		{
			$this.parents(togglebox_panel).find(counter_container).text( counter );
		}
		else {
			$this.parents(togglebox_panel).find(counter_container).text( '' );
		}
	});
	
	jQuery(".filter-panel-estado").change(function () {
		var selected = jQuery( ".filter-panel-estado option:selected" ).val();
		if(filter_panel_estado_select != selected)
		{
			if(filter_panel_cidade != '')
			{
				mapstraction.removeFilter('territorio', 'in', filter_panel_cidade);
				filter_panel_cidade = '';
			}
			
			if(filter_panel_estado_select != "")
			{
				mapstraction.removeFilter('territorio', 'in', filter_panel_estado_select);
			}
			filter_panel_estado_select = selected;
			if(selected != "")
			{
				mapstraction.addFilter('territorio', 'in', selected);
			}
			mapstraction.doFilter();
			//updateResults();
			mapstraction.visibleCenterAndZoom();
			
			var data =
		    {
		            action: 'filter_select_cidade',
		            uf: selected
		    };
			jQuery.ajax(
		    {
		        type: 'POST',
		                url: mapinfo.ajaxurl,
		        data: data,
		        success: function(response)
		        {
		        	jQuery(".filter-panel-cidade").replaceWith(response);
		        	
		        	jQuery(".filter-panel-cidade").change(function () {
		        		var selected = jQuery( ".filter-panel-cidade option:selected" ).val();
		        		if(selected != filter_panel_cidade)
		        		{
		        			if(filter_panel_cidade != "")
		        			{
		        				mapstraction.removeFilter('territorio', 'in', filter_panel_cidade);
		        			}
		        			filter_panel_cidade = selected;
		        			if(selected != "")
		        			{
		        				mapstraction.addFilter('territorio', 'in', selected);
		        			}
		        			mapstraction.doFilter();
		        			//updateResults();
		        			//mapstraction.visibleCenterAndZoom();
		        		}
		        	});
		        	
		        	//jQuery(".Ajax-Loader").toggle();
		        },
		        beforeSend: function()
		        {
		        	//jQuery(".Ajax-Loader").toggle();
		        }, 
		    });
		}
	});
	
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
	
});

