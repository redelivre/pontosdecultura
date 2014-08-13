<?php
/**
 * The template for displaying search forms
 *
 * @package Recid
 * @since Recid 1.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Digite aqui a sua busca', 'pontosdecultura' ); ?>" value="<?php get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
</form>