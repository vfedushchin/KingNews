<?php
/**
 * Template part for posts pagination.
 *
 * @package King_News
 */
the_posts_pagination(
	array(
		'prev_text' => '<i class="material-icons">navigate_before</i> Prev',
		'next_text' => 'Next <i class="material-icons">navigate_next</i>'
	)
);
