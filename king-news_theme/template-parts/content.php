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


			<figure class="post-thumbnail <?php king_news_post_thumbnail_class(); ?> ">
				<?php king_news_post_thumbnail( true ); ?>
				<?php king_news_meta_categories( 'loop' ); ?>
				<?php king_news_sticky_label(); ?>
			</figure><!-- .post-thumbnail -->


		<div class="post-body-right">
			<header class="entry-header">



				<?php
					if ( is_single() ) {
						the_title( '<h2 class="entry-title">', '</h2>' );
					} else {
						the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
					}
				?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php king_news_blog_content(100); ?>
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
								'zero'   => esc_html__( 'Leave a comment', '__tm' ),
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
