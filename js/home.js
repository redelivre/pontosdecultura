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
			if(searchtext != '')
			{
				mapstraction.removeFilter('title', 'like', searchtext);
			}
			searchtext = jQuery('#s').val();
			mapstraction.addFilter('title', 'like', jQuery('#s').val());
			mapstraction.doFilter();
	        updateResults();
		}
	});
});