var _URL = window.URL || window.webkitURL;
function displayPreview(files, id)
{
	var file = files[0]
	if(validateFile(id))
	{
		jQuery('.'+id+"-file-name").remove();
		if(iniciativa_is_image(id))
		{
			var img = new Image();
			var sizeKB = file.size / 1024;
			img.className = id+"-file-name";
			img.onload = function()
			{
				jQuery('.images-'+id).append(img);
			}
			img.src = _URL.createObjectURL(file);
		}
		else
		{
			
			var newlabel = document.createElement("Label");
			newlabel.innerHTML = file.name;
			newlabel.className = id+"-file-name";
			jQuery('.images-'+id).append(newlabel);
		}
	}
}

function validateFile(id) 
{
    var allowedExtension = new_iniciativa.exts;
    var fileExtension = document.getElementById(id).value.split('.').pop().toLowerCase();
    var isValidFile = false;

        for(var index in allowedExtension) {

            if(fileExtension === allowedExtension[index]) {
                isValidFile = true; 
                break;
            }
        }

        if(!isValidFile) {
            alert(new_iniciativa.error + allowedExtension.join(', *.'));
        }

        return isValidFile;
}

function iniciativa_is_image(id)
{
	var allowedExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'ico'];
    var fileExtension = document.getElementById(id).value.split('.').pop().toLowerCase();
    var isValidFile = false;

    for(var index in allowedExtension)
    {
        if(fileExtension === allowedExtension[index])
        {
            isValidFile = true; 
            break;
        }
    }

    return isValidFile;
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