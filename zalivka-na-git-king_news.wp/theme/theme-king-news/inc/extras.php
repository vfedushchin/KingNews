<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package king_news
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function king_news_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'king_news_body_classes' );

/**
 * Set post specific sidebar position
 *
 * @param  string $position Default sidebar position.
 * @return string
 */
function king_news_set_sidebar_position( $position ) {

	if ( is_front_page() || ! is_singular() ) {
		return $position;
	}

	$post_id = get_the_id();

	if ( ! $post_id ) {
		return $position;
	}

	$post_position = get_post_meta( $post_id, '_tm_sidebar_position', true );

	if ( ! $post_position || 'inherit' === $post_position ) {
		return $position;
	}

	return $post_position;

}
add_filter( 'theme_mod_sidebar_position', 'king_news_set_sidebar_position' );

/**
 * Render existing macros in passed string.
 *
 * @since  1.0.0
 * @param  string $string String to parse.
 * @return string
 */
function king_news_render_macros( $string ) {

	$macros = apply_filters( 'king_news_data_macros', array(
		'/%%year%%/' => date( 'Y' ),
		'/%%date%%/' => date( get_option( 'date_format' ) ),
	) );

	return preg_replace( array_keys( $macros ), array_values( $macros ), $string );

}

/**
 * Render font icons in content
 *
 * @param  string $content content to render
 * @return string
 */
function king_news_render_icons( $content ) {

	$icons     = king_news_get_render_icons_set();
	$icons_set = implode( '|', array_keys( $icons ) );

	$regex = '/icon:(' . $icons_set . ')?:?([a-zA-Z0-9-_]+)/';

	return preg_replace_callback( $regex, 'king_news_render_icons_callback', $content );
}

/**
 * Callback for icons render.
 *
 * @param  array $matches Search matches array.
 * @return string
 */
function king_news_render_icons_callback( $matches ) {

	if ( empty( $matches[1] ) && empty( $matches[2] ) ) {
		return $matches[0];
	}

	if ( empty( $matches[1] ) ) {
		return sprintf( '<i class="fa fa-%s"></i>', $matches[2] );
	}

	$icons = king_news_get_render_icons_set();

	if ( ! isset( $icons[ $matches[1] ] ) ) {
		return $matches[0];
	}

	return sprintf( $icons[ $matches[1] ], $matches[2] );
}

/**
 * Get list of icons to render
 *
 * @return array
 */
function king_news_get_render_icons_set() {
	return apply_filters( 'king_news_render_icons_set', array(
		'fa'       => '<i class="fa fa-%s"></i>',
		'material' => '<i class="material-icons">%s</i>',
	) );
}
