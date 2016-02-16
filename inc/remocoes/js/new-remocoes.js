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
	jQuery('#remocoes-suporte-option-1, #remocoes-suporte-option-2').click(function() {
		jQuery('.remocoes-suporte-tempo, .remocoes-suporte-esfera').fadeIn(600);
	});
	jQuery('#remocoes-suporte-option-0').click(function() {
		jQuery('.remocoes-suporte-tempo, .remocoes-suporte-esfera').fadeOut(600);
	});
	
	
	if(jQuery('#remocoes-suporte-option-1:checked, #remocoes-suporte-option-2:checked').length > 0)
	{
		jQuery('.remocoes-suporte-tempo, .remocoes-suporte-esfera').show();
	}
	else
	{
		jQuery('.remocoes-suporte-tempo, .remocoes-suporte-esfera').hide();
	}
	
	jQuery(".nova-remocoes .iconlist div.icon").click(function () {
		jQuery(this).find('input').prop('checked', true);
		jQuery(".nova-remocoes .iconlist div.icon").removeClass("active");
		jQuery(this).addClass("active");
	});
	
	jQuery(".nova-remocoes .iconlist div.icon").each(function () {
		if(jQuery(this).find("input[type='radio']:checked").length > 0)
		{
			jQuery(this).addClass("active");
		}
	});

	jQuery('.remocoes-add-another').click(function()
	{
		var copy = jQuery(this).parent().children('.remocoes-set').eq(0).clone();
		copy.children('input').val('');
		copy.children('input').html('');
		jQuery(this).before(copy);
		copy.find('input.hasdatepicker')
			.attr('id', '')
			.removeClass('hasDatepicker')
			.removeData('datepicker')
			.unbind()
			.datepicker({
				userLang	: 'pt-BR',
				americanMode: false,
		});
	});
});


function remocoes_scroll_to_anchor(id)
{
	jQuery('body, html').animate({
	    scrollTop:   jQuery('#'+id).offset().top - 100
	}, 800);
}
