var dropdown_estado_select = '';

jQuery(document).ready(function()
{
	jQuery(".dropdown-estado").change(function () {
		var selected = jQuery( ".dropdown-estado option:selected" ).val();
		if(dropdown_estado_select != selected)
		{
			dropdown_estado_select = selected;
			var data =
		    {
		            action: 'select_dropdown_cidade',
		            uf: selected
		    };
			jQuery.ajax(
		    {
		        type: 'POST',
		                url: EstadosCidades_object.ajax_url,
		        data: data,
		        success: function(response)
		        {
		        	jQuery("select.dropdown-cidade").replaceWith(response);
		        	jQuery(".Ajax-Loader").toggle();
		        },
		        beforeSend: function()
		        {
		        	jQuery(".Ajax-Loader").toggle();
		        }, 
		    });
		}
	});
	
});