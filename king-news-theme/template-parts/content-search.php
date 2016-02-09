<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package __Tm
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item' ); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php __tm_post_excerpt( array( 'length' => 45, 'more' => '&hellip;' ) ); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php __tm_read_more(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
