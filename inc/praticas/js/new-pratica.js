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
	
});