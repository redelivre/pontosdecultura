
function pontos_linkToPost(el)
{
	var post_id = jQuery('#'+el.id).attr('id').replace(/[^0-9]+/g, '');
	
	var data =
    {
            action: 'pontos_load_post',
            post_id: post_id
    };
	jQuery.ajax(
    {
        type: 'POST',
        url: mapinfo.ajaxurl,
        data: data,
        success: function(data)
        {
            if (data != 'error')
            {
                jQuery('#post_overlay_content').html(data);
                //jQuery("#post_overlay_content .gallery .gallery-item a").click(mapasdevista.openGalleryImage);
                
                //hide bubbles
                for (var ii = 0; ii < mapstraction.markers.length; ii ++) {
                    mapstraction.markers[ii].closeBubble();
                }
                
                jQuery('#post_overlay').fadeIn(800);
                ajaxizeComments();
            }
        },
        beforeSend: function()
        {
        	//overlay_filtro();
        }, 
    });
	
}