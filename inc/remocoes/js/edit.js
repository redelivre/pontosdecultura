function addValue(field, values)
{
	var id = field.children('.remocoes-value-id').val();

	for (var i in values)
	{
		value = values[i];
		if (value == "")
			continue

		var elem = jQuery('#remocoes-default-value').clone();

		elem.attr('id', '');
		elem.children('.remocoes-value-remove').click(function()
		{
			jQuery(this).parent().remove();
		});

		elem.children().each(function()
		{
			var name = jQuery(this).attr('name');
			if (name != undefined)
			{
				jQuery(this).attr('name', name.replace('%ID%', id));
			}

			var val = jQuery(this).val();
			jQuery(this).val(val.replace('%VALUE%', value));
		});

		elem.children('label').text(value);

		field.parent().children('.remocoes-values').append(elem);
	}
}

function addField(data)
{
	var type = data.type;
	var fieldsDiv = jQuery('#remocoes-custom-fields');
	var field = jQuery('#remocoes-default-' + type).clone();

	field.attr('id', '');
	field.children('.remocoes-remove-field').click(function()
	{
		jQuery(this).parent().remove();
	});

	field.find('.remocoes-value-form').submit(function(e)
	{
		e.preventDefault();
		var name = jQuery(this).children('.remocoes-value-name');
		addValue(jQuery(this), [name.val()]);
		name.val('');
	});

	field.children('.remocoes-number').keyup(function ()
	{
		var number = this.value.replace(/[^0-9\.]/g, '');
		if (this.value != number)
		{
			this.value = number;
		}
	});

	field.children().each(function()
	{
		name = jQuery(this).attr('name');
		if (name != undefined)
		{
			jQuery(this).attr('name', name.replace('%ID%', nextID));
		}
	});

	field.find('input').each(function()
	{
		value = jQuery(this).val();
		if (value != "")
		{
			jQuery(this).val(value.replace('%ID%', nextID));
		}
	});

	for (attr in data)
	{
		if (typeof data[attr] == "boolean")
		{
			if (data[attr])
				field.find('.remocoes-custom-' + attr).attr('checked', true);
		}
		else
			field.find('.remocoes-custom-' + attr).each(function()
			{
				if (jQuery(this).is('select'))
				{
					jQuery(this).children('option').each(function()
					{
						if (jQuery(this).val() == data[attr])
							jQuery(this).attr('selected', 'true');
					});
				}
				else
					jQuery(this).val(data[attr]);
			});
	}

	field.find('.remocoes-value-form').each(function()
	{
		addValue(jQuery(this), data['values']);
	});

	nextID++;
	fieldsDiv.append(field);
}

function validateInput()
{
	var form = jQuery('#remocoes-fields-form');
	var good = true;
	form.find('.remocoes-required').each(function()
	{
		if (jQuery(this).val().trim() == "")
		{
			good = false;
		}
	});

	form.find('.remocoes-not-empty').each(function()
	{
		if (!jQuery(this).children().length)
		{
			good = false;
		}
	});

	form.find('.remocoes-not-zero').each(function()
	{
		var v = parseInt(jQuery(this).val());
		if (v <= 0)
		{
			good = false;
		}
	});

	return good;
}

function addStored()
{
	stored = jQuery.parseJSON(jQuery('#remocoes-stored-values').text());

	for (var field in stored) {
		addField(stored[field]);
	}
}

jQuery(document).ready(function()
{
	nextID = 0;
	jQuery('#remocoes-add-field-form').submit(function(e)
	{
		e.preventDefault();
		addField({type : jQuery('#remocoes-add-field-type').val()});
	});
	jQuery('#remocoes-fields-form').submit(function(e)
	{
		if (!validateInput()) {
			e.preventDefault();
			jQuery('#remocoes-error-required').css('visibility', 'visible');
		}
	});

	addStored();
});
