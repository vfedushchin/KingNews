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

		<figure class="post-thumbnail">
			<?php king_news_post_thumbnail( true ); ?>
			<?php king_news_meta_categories( 'loop' ); ?>
			<?php king_news_sticky_label(); ?>
			<div class="post-thumbnail__format-link">
				<?php do_action( 'cherry_post_format_link', array( 'render' => true, 'class' => 'invert' ) ); ?>
			</div>
		</figure><!-- .post-thumbnail -->

		<header class="entry-header">
			<?php
				king_news_meta_author(
					'loop',
					array(
						'before' => esc_html__( 'Posted by', 'king_news' ) . ' ',
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
						'zero'   => esc_html__( 'Leave a comment', 'king_news' ),
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