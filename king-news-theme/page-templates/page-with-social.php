<?php
/**
 * Template Name: Page with social icons
 *
 * @package WordPress
 * @since King_News
 */

?>


	<div class="post-left-column">
		<?php king_news_share_buttons( 'page-social' ); ?>
	</div>
	<div class="post-right-column">

			<?php while ( have_posts() ) : the_post(); ?>


						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title screen-reader-text">', '</h1>' ); ?>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php
									the_content();

									wp_link_pages( array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'king_news' ),
										'after'  => '</div>',
									) );
								?>
							</div><!-- .entry-content -->

							<footer class="entry-footer">
								<?php
									edit_post_link(
										sprintf(
											/* translators: %s: Name of current post */
											esc_html__( 'Edit %s', 'king_news' ),
											the_title( '<span class="screen-reader-text">"', '"</span>', false )
										),
										'<span class="edit-link">',
										'</span>'
									);
								?>
							</footer><!-- .entry-footer -->
						</article><!-- #post-## -->



			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop. ?>

	</div><!-- .post-right-column -->