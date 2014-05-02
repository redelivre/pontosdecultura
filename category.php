<?php
if(get_query_var('post_type')) // workaround to load category template for post_type 
{
	include get_query_var('post_type').'-category.php';
}
else
{
	get_header();?>
	
	<?php get_footer(); 
}	
?>