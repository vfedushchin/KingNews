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

	<div class="post-format-wrap">
		<?php do_action( 'cherry_post_format_image' ); ?>
		<?php __tm_meta_categories( 'loop' ); ?>
		<?php __tm_sticky_label(); ?>
	</div>

	<header class="entry-header">
		<?php
			__tm_meta_author(
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
		<?php __tm_blog_content(); ?>
	</div><!-- .entry-content -->

	<?php if ( 'post' === get_post_type() ) : ?>

		<div class="entry-meta">
			<?php
				__tm_meta_date( 'loop', array(
					'before' => '<i class="material-icons">event</i>',
				) );

				__tm_meta_comments( 'loop', array(
					'before' => '<i class="material-icons">mode_comment</i>',
					'zero'   => esc_html__( 'Leave a comment', '__tm' ),
					'one'    => '1',
					'plural' => '%',
				) );

				__tm_meta_tags( 'loop', array(
					'before'    => '<i class="material-icons">folder_open</i>',
					'separator' => ', ',
				) );
			?>
		</div><!-- .entry-meta -->

	<?php endif; ?>

	<footer class="entry-footer">
		<?php __tm_read_more(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
