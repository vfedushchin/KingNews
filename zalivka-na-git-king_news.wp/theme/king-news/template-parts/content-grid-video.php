<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package King_News
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card' ); ?>>
	<div class="post-list__item-content">
	

			<figure class="grid-view-main">
				<?php do_action( 'cherry_post_format_video', array( 'width'  => 536, 'height' => 411, ) ); ?>

				<figcaption class="grid-view-figcaption">
					<span></span>

					<div class="grid-view__footer">
						<?php
							if ( is_single() ) {
								the_title( '<h2 class="entry-title">', '</h2>' );
							} else {
								echo '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_short_title(50) . '</a></h3>';
								/*the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );*/
							}
						?>

						<div class="grid-view__footer-2">
							<div class="grid-view__author-date">
								<?php
									king_news_meta_author(
										'loop',
										array(
											'before' => esc_html__( 'by', 'king_news' ) . ' ',
										)
									);
								?>

								<?php
									king_news_meta_date( 'loop', array(
										'before' => '<i class="material-icons">access_time</i>',
									) );
								?>
							</div>

							<?php king_news_share_buttons( 'loop' ); ?>
						</div>
					</div>

				</figcaption>

				<footer class="entry-footer">
					<?php king_news_read_more(); ?>
					<?php king_news_share_buttons( 'loop' ); ?>
				</footer><!-- .entry-footer -->
			</figure>



		</div>

</article><!-- #post-## -->
