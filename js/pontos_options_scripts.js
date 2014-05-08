/**
 * 
 */

jQuery(function()
{
	jQuery("#importcsv").click(function(event)
	{
		event.preventDefault();
		var data =
        {
                action: 'ImportarCsv',
        };
         
        jQuery.ajax(
        {
            type: 'POST',
                    url: pontos_options_scripts_object.ajax_url,
            data: data,
            success: function(response)
            {
            	jQuery('#result').replaceWith(response);
            },
        });
	});
});