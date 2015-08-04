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
	jQuery('#iniciativa-suporte-option-1, #iniciativa-suporte-option-2').click(function() {
		jQuery('.iniciativa-suporte-tempo, .iniciativa-suporte-esfera').fadeIn(600);
	});
	jQuery('#iniciativa-suporte-option-0').click(function() {
		jQuery('.iniciativa-suporte-tempo, .iniciativa-suporte-esfera').fadeOut(600);
	});
	
	
	if(jQuery('#iniciativa-suporte-option-1:checked, #iniciativa-suporte-option-2:checked').length > 0)
	{
		jQuery('.iniciativa-suporte-tempo, .iniciativa-suporte-esfera').show();
	}
	else
	{
		jQuery('.iniciativa-suporte-tempo, .iniciativa-suporte-esfera').hide();
	}
	
});


function iniciativa_scroll_to_anchor(id)
{
	jQuery('body, html').animate({
	    scrollTop:   jQuery('#'+id).offset().top - 100
	}, 800);
}