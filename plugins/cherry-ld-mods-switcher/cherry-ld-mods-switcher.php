<?php
/*
Plugin Name: Cherry Live Demo Mods Switcher
Description: Cherry Live Demo Mods Switcher
Plugin URI:
Author: Cherry Team
Author URI:
Version: 1.0
License: GPL2
Text Domain: cherry-ld-mods-switcher
Domain Path: lang
*/

class Cherry_LD_Switcher {

	function __construct() {
		add_action( 'after_setup_theme', array( $this, 'init_switcher' ), 10, 0 );
	}

	/**
	 * Attach callback to apropriate hook if is switcher request
	 * @return void
	 */
	function init_switcher() {

		if ( ! isset( $_GET['ld'] ) ) {
			return;
		}

		foreach ( $_GET as $key => $value ) {

			if ( 'ld' === $key ) {
				continue;
			}

			add_filter( 'theme_mod_' . esc_attr( $key ), array( $this, 'switch_cb' ) );
		}

	}

	/**
	 * Universal switch callback for gt theme mod hook
	 *
	 * @param  string $current Current mod value
	 * @return string
	 */
	function switch_cb( $current ) {

		$key = str_replace( 'theme_mod_', '', current_filter() );

		if ( ! isset( $_GET[ $key ] ) ) {
			return $current;
		}

		return esc_attr( $_GET[ $key ] );
	}

}

new Cherry_LD_Switcher();
