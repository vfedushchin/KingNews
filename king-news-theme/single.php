<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package king_news
 */

while ( have_posts() ) : the_post();


	?><div class="post-left-column"><?php
		king_news_share_buttons( 'single' );
	?></div><div class="post-right-column"><?php
		get_template_part( 'template-parts/content', 'single' );
		king_news_post_author_bio();
	?></div><?php

	the_post_navigation( array(
		'next_text' => '<span class="meta-nav" aria-hidden="true">Next Post</span> ' .
										'<span class="screen-reader-text">Next Post</span> ' .
										'<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav" aria-hidden="true">Previous Post</span> ' .
										'<span class="screen-reader-text">Previous Post</span> ' .
										'<span class="post-title">%title</span>',
	) );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
