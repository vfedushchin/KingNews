<?php
/**
 * Template part for posts pagination.
 *
 * @package King_News
 */
the_posts_pagination(
	array(
		'prev_text' => '<i class="material-icons">navigate_before</i>' . __( 'Prev', 'king_news' ),
		'next_text' => __( 'Next', 'king_news' ) . '<i class="material-icons">navigate_next</i>'
	)
);
