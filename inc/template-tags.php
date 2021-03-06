<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Pontos de Cultura
 * @since  Pontos de Cultura 1.0
 */

if ( ! function_exists( 'pontosdecultura_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function pontosdecultura_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'pontosdecultura' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'pontosdecultura' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'pontosdecultura' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pontosdecultura_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function pontosdecultura_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'pontosdecultura' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'pontosdecultura' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'pontosdecultura' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pontosdecultura_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pontosdecultura_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'pontosdecultura' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Create a generic list for the terms present in a single map display
 *
 * @global object $post The post object
 * @param string $taxonomy The taxonomy given
 */
function pontosdecultura_the_terms( $taxonomy ) {
	global $post;
	
	$terms = get_the_terms( $post->ID, $taxonomy );
							
	if ( $terms && ! is_wp_error( $terms ) ) : 

		$terms_array = array();

		foreach ( $terms as $term ) {
			$terms_array[] = $term->name;
		}
							
		$terms_list = join( ' / ', $terms_array );

		// Define a prefix for the taxonomy classes
		$tax_class_prefix = 'tax-';

		// Create a list of taxonomy classes for the term list
		if ( is_array( $taxonomy ) ) {
			
			$tax_class = array();

			foreach ( $taxonomy as $tax ) {
				$tax_class[] = $tax_class_prefix . $tax;
			}

			$tax_classes = join( ' ', $tax_class );

		}
		else {
			$tax_classes = $tax_class_prefix . $taxonomy;
		}
	?>

		<span class="entry-term <?php echo $tax_classes; ?>">
			<?php echo $terms_list; ?>
		</span>

	<?php
	endif;
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function pontosdecultura_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'pontosdecultura_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'pontosdecultura_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pontosdecultura_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pontosdecultura_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in pontosdecultura_categorized_blog.
 */
function pontosdecultura_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'pontosdecultura_categories' );
}
add_action( 'edit_category', 'pontosdecultura_category_transient_flusher' );
add_action( 'save_post',     'pontosdecultura_category_transient_flusher' );
