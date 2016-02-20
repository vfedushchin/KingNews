<?php
/**
 * Tracker Shortcode
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'TF_Track_Kickstarter_Shortcode' ) ) {

	/**
	 * Base plugin class
	 *
	 * @since 1.0.0
	 */
	class TF_Track_Kickstarter_Shortcode {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Define shortocde
		 */
		public function __construct() {
			add_shortcode( 'tf_track_project', array( $this, 'shortcode' ) );
		}

		/**
		 * Main shortocde function.
		 *
		 * @since  1.0.0
		 * @param  array $atts Shortcode attributes.
		 * @return string
		 */
		public function shortcode( $atts ) {
			$atts = shortcode_atts( array(
				'descr'          => '',
				'url'            => '',
				'project_button' => '',
			), $atts, 'tf_track_project' );

			if ( ! $atts['url'] ) {
				return;
			}

			$handler        = tf_track_kickstarter_handle( $atts['url'] );
			$data           = $handler->get_data();
			$template       = tf_track_kickstarter_tools()->locate_template( 'default.php' );
			$url            = esc_url( $atts['url'] );
			$descr          = ! empty( $atts['descr'] ) ? $atts['descr'] : '';
			$project_button = ! empty( $atts['project_button'] ) ? $atts['project_button'] : '';

			ob_start();

			if ( $data && $template ) {
				include $template;
			}

			return ob_get_clean();
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance )
				self::$instance = new self;

			return self::$instance;
		}

	}

	/**
	 * Returns instance of tools class.
	 *
	 * @since  1.0.0
	 * @return TF_Track_Kickstarter_Shortcode
	 */
	function tf_track_kickstarter_shortcode() {
		return TF_Track_Kickstarter_Shortcode::get_instance();
	}

}
