var _URL = window.URL || window.webkitURL;
function displayPreview(files, id) {
   var file = files[0]
   var img = new Image();
   var sizeKB = file.size / 1024;
   img.onload = function() {
      jQuery('.images-'+id).append(img);
      //alert("Size: " + sizeKB + "KB\nWidth: " + img.width + "\nHeight: " + img.height);
   }
   img.src = _URL.createObjectURL(file);
}

jQuery(document).ready(function()
{
	jQuery('#pratica-suporte-option-1, #pratica-suporte-option-2').click(function() {
		jQuery('.pratica-suporte-tempo, .pratica-suporte-esfera').fadeIn(600);
	});
	jQuery('#pratica-suporte-option-0').click(function() {
		jQuery('.pratica-suporte-tempo, .pratica-suporte-esfera').fadeOut(600);
	});
	
	
	if(jQuery('#pratica-suporte-option-1:checked, #pratica-suporte-option-2:checked').length > 0)
	{
		jQuery('.pratica-suporte-tempo, .pratica-suporte-esfera').show();
	}
	else
	{
		jQuery('.pratica-suporte-tempo, .pratica-suporte-esfera').hide();
	}
	
	jQuery(".nova-pratica .iconlist div.icon").click(function () {
		jQuery(this).find('input').prop('checked', true);
		jQuery(this).find('input').change();
		jQuery(".nova-pratica .iconlist div.icon").removeClass("active");
		jQuery(this).addClass("active");
	});
	
	jQuery(".nova-pratica .iconlist div.icon").each(function () {
		if(jQuery(this).find("input[type='radio']:checked").length > 0)
		{
			jQuery(this).addClass("active");
		}
	});
	
	jQuery("#mpv_search_address").unbind("keypress");
	
	jQuery("#mpv_search_address").keypress(function(e){
        if(e.charCode===13 || e.keyCode===13){ // carriage return
            geocoder.geocode({'address': jQuery(this).val()}, function (results, status)
            		{
            	  if (status == google.maps.GeocoderStatus.OK) {
            	    var location = results[0].geometry.location;
            	    googlemap.setCenter(location);
            	    fill_fields(location.lat(), location.lng());

            	var city = '';
            	var uf = '';
            	var postal_code = '';
            	    
            	    for( i = 0; i < results[0].address_components.length; i++ )
            	    {
            	      if(results[0].address_components[i].types[0] == "administrative_area_level_2")
            		{
            			//alert("cidade: "+results[0].address_components[i].long_name);
            			city = results[0].address_components[i].long_name;
            		}
            	      if(results[0].address_components[i].types[0] == "administrative_area_level_1")
            		{
            			//alert("UF: "+results[0].address_components[i].short_name);
            			uf = results[0].address_components[i].short_name;
            			
            		}
            	      if(results[0].address_components[i].types[0] == "postal_code")
            		{
            			//alert("CEP: "+results[0].address_components[i].long_name);
            			postal_code = results[0].address_components[i].long_name;
            		}
            	    }

            		jQuery(".dropdown-estado select").val(jQuery(".dropdown-estado option:contains("+uf+")").val());
            		jQuery(".dropdown-estado").change();
            		setTimeout(function() {
            			jQuery(".dropdown-cidade select").val(jQuery(".dropdown-cidade option:contains("+city+")").val());
            		}, 600);
            		jQuery("#pratica-cep").val(postal_code);

            	    if(googlemarker) {
            	      googlemarker.setPosition(location)
            	    } else {
            	      googlemarker = new google.maps.Marker({
            	        map: googlemap,
            	        draggable: true,
            	        position: location
            	      });
            	    }
            	  }
            	});
            return false;
        }
    });
	
});


function pratica_scroll_to_anchor(id)
{
	jQuery('body, html').animate({
	    scrollTop:   jQuery('#'+id).offset().top - 100
	}, 800);
}