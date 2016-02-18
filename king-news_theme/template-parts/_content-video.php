<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package __Tm
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card' ); ?>>

	<div class="post-list__item-content">

		<div class="post-featured-content invert">
			<?php do_action( 'cherry_post_format_video', array( 'width'  => 770, 'height' => 480, ) ); ?>
			<?php king_news_meta_categories( 'loop' ); ?>
			<?php king_news_sticky_label(); ?>
		</div><!-- .post-featured-content -->

		<header class="entry-header">
			<?php
				king_news_meta_author(
					'loop',
					array(
						'before' => esc_html__( 'Posted by', '__tm' ) . ' ',
					)
				);
			?>
			<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php king_news_blog_content(); ?>
		</div><!-- .entry-content -->

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">
				<?php
					king_news_meta_date( 'loop', array(
						'before' => '<i class="material-icons">event</i>',
					) );

					king_news_meta_comments( 'loop', array(
						'before' => '<i class="material-icons">mode_comment</i>',
						'zero'   => '0',
						'one'    => '1',
						'plural' => '%',
					) );

					king_news_meta_tags( 'loop', array(
						'before'    => '<i class="material-icons">folder_open</i>',
						'separator' => ', ',
					) );
				?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

	</div>
	<footer class="entry-footer">
		<?php king_news_share_buttons( 'loop' ); ?>
		<?php king_news_read_more(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
