<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package King_News
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			king_news_meta_categories( 'single' );
			the_title( '<h1 class="entry-title">', '</h1>' );
		?>

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">

				<?php
					king_news_meta_author(
						'single',
						array(
							'before' => esc_html__( 'By', 'king_news' ) . ' ',
						)
					);

					king_news_meta_date( 'single', array(
						'before' => '<i class="material-icons">access_time</i>',
					) );

					king_news_meta_comments( 'single', array(
						'before' => '<i class="material-icons">chat_bubble_outline</i>',
						'zero'   => esc_html__( 'Leave a comment', 'king_news' ),
						'one'    => '1',
						'plural' => '%',
					) );
				?>

			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	<figure class="post-thumbnail">
		<?php king_news_post_thumbnail( false ); ?>
	</figure><!-- .post-thumbnail -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'king_news' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			king_news_meta_tags( 'single', array(
				'before'    => '<i class="material-icons">folder_open</i>Tagged in: ',
				'separator' => ', ',
			) );
		?>
		
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
