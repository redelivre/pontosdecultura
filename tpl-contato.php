<?php get_header(); ?>

		<div id="primary" class="content-area">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php _e('Contato', 'pontosdecultura' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php

						if ( $contact_text = get_option( 'campanha_contact_page_text' ) )
							echo '<p>' . nl2br( $contact_text ) . '</p>';

						if ( function_exists( 'campanha_the_contact_form' ) )
							campanha_the_contact_form();
						?>

						<a class="post-edit-link" href="<?php echo admin_url('admin.php?page=campaign_contact'); ?>"><span class="edit-link"><?php _e('Editar', 'pontosdecultura' ); ?></span></a>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>
