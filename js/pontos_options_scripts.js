/**
 * 
 */

jQuery(function()
{
	jQuery("#importcsv").click(function(event)
	{
		event.preventDefault();

		var data = new FormData();
		data.append('action', 'ImportarCsv');
		data.append('file', jQuery('#remocoes-import-csv')[0].files[0]);
				 
		jQuery.ajax(
		{
				type: 'POST',
				url: pontos_options_scripts_object.ajax_url,
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response)
				{
					jQuery('#result').replaceWith(response);
				},
			});
	});
});
