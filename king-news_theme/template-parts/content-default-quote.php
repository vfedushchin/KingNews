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




		<div class="post-body-right">


			<div class="entry-content">
				<?php king_news_sticky_label(); ?>
				<a href="<?php echo get_permalink() ?>" class="quote-link" rel="bookmark">
					<?php do_action( 'cherry_post_format_quote' ); ?>
				</a>
			</div><!-- .entry-content -->

			<?php if ( 'post' === get_post_type() ) : ?>

				<div class="entry-meta-sharing">
					<div class="entry-meta">
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

							king_news_meta_comments( 'loop', array(
								'before' => '<i class="material-icons">chat_bubble_outline</i>',
								'after' => '',
								'zero'   => esc_html__( 'Leave a comment', 'king_news' ),
								'one'    => '1 comment',
								'plural' => '% comments',
							) );

							king_news_meta_tags( 'loop', array(
								'before'    => '<i class="material-icons">folder_open</i>',
								'separator' => ', ',
							) );
						?>
					</div><!-- .entry-meta -->
					<?php king_news_share_buttons( 'loop' ); ?>
				</div><!-- .entry-meta-sharing -->

			<?php endif; ?>


		<footer class="entry-footer">
			<?php king_news_read_more(); ?>
			<?php king_news_share_buttons( 'loop' ); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .post-body-right -->
</article><!-- #post-## -->
