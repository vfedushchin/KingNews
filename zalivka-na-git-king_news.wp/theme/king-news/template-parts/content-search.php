<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package King_News
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item' ); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php king_news_post_excerpt( array( 'length' => 45, 'more' => '&hellip;' ) ); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<!-- <?php king_news_read_more(); ?> -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
