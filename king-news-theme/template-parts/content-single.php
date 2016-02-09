<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package __Tm
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			__tm_meta_categories( 'single' );
			the_title( '<h1 class="entry-title">', '</h1>' );
		?>

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">

				<?php
					__tm_meta_author(
						'single',
						array(
							'before' => esc_html__( 'Posted by', '__tm' ) . ' ',
						)
					);

					__tm_meta_date( 'single', array(
						'before' => '<i class="material-icons">event</i>',
					) );

					__tm_meta_comments( 'single', array(
						'before' => '<i class="material-icons">mode_comment</i>',
						'zero'   => esc_html__( 'Leave a comment', '__tm' ),
						'one'    => '1',
						'plural' => '%',
					) );
				?>

			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	<figure class="post-thumbnail">
		<?php __tm_post_thumbnail( false ); ?>
	</figure><!-- .post-thumbnail -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '__tm' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			__tm_meta_tags( 'loop', array(
				'before'    => '<i class="material-icons">folder_open</i>',
				'separator' => ', ',
			) );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
