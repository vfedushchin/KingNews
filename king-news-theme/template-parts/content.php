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

	<figure class="post-thumbnail post-thumbnail--left">
		<?php
			// filter for choising of image size: if return true -> ultra-small
			// add_filter( '__tm_post_thumbail_size', '__return_true' );
			__tm_post_thumbnail( true, "" ); 
		?>
		<?php __tm_meta_categories( 'loop' ); ?>
		<?php __tm_sticky_label(); ?>
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
			<?php __tm_blog_content(); ?>
		</div><!-- .entry-content -->

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">
				<?php
					__tm_meta_author(
						'loop',
						array(
							'before' => esc_html__( 'by', '__tm' ) . ' ',
						)
					);
				?>

				<?php
					__tm_meta_date( 'loop', array(
						'before' => '<i class="material-icons">access_time</i>',
					) );

					__tm_meta_comments( 'loop', array(
						'before' => '<i class="material-icons">chat_bubble_outline</i>',
						'after' => '',
						'zero'   => esc_html__( 'Leave a comment', '__tm' ),
						'one'    => '1 comment',
						'plural' => '% comments',
					) );

					/*__tm_meta_tags( 'loop', array(
						'before'    => '<i class="material-icons">folder_open</i>',
						'separator' => ', ',
					) );*/
				?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php __tm_social_list( 'post' ); ?>

		<footer class="entry-footer">
			<?php /*__tm_read_more();*/ ?>
		</footer><!-- .entry-footer -->
	</div><!-- .post-body-right -->
</article><!-- #post-## -->
