jQuery(document).ready(function()
{
	jQuery(".filter-panel-tooglebox-meta-head").click(function () {
		jQuery(this).parent('div').children('.filter-panel-tooglebox-list').toggle(400);
		jQuery(this).parent('div').toggleClass("filter-panel-tooglebox--toggled");
	});
});