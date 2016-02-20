<?php
/**
 * Service tools
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'TF_Track_Kickstarter_Tools' ) ) {

	/**
	 * Base plugin class
	 *
	 * @since 1.0.0
	 */
	class TF_Track_Kickstarter_Tools {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Gets time difference between two dates
		 *
		 * @param  timestamp $from     From date.
		 * @param  timestamp $to       To date
		 * @param  string    $interval Diff interval (h - hours, d - days, w - weeks).
		 * @return string|bool
		 */
		public function time_diff( $from, $to, $interval = 'd' ) {

			if ( ! $from || ! $to ) {
				return false;
			}

			$datediff = $to - $from;

			switch ( $interval ) {

				case 'h':
					return floor( $datediff / ( HOUR_IN_SECONDS ) );

				case 'd':
					return floor( $datediff / ( DAY_IN_SECONDS ) );

				case 'w':
					return floor( $datediff / ( WEEK_IN_SECONDS ) );

			}

			return false;

		}

		/**
		 * Find passed template by priority and return found path
		 * priority: child_theme/template-parts/track-kickstarter/$name
		 *           parent_theme/template-parts/track-kickstarter/$name
		 *           child_theme/track-kickstarter/$name
		 *           parent_theme/track-kickstarter/$name
		 *           plugin/templates/$name.php
		 *
		 * @param  string $name Template name to find.
		 * @return string
		 */
		public function locate_template( $name ) {

			$template_file = locate_template( array(
				"template-parts/track-kickstarter/{$name}",
				"track-kickstarter/{$name}",
			) );

			if ( ! $template_file && file_exists( tf_track_kickstarter()->plugin_dir( 'templates/' . $name ) ) ) {
				$template_file = tf_track_kickstarter()->plugin_dir( 'templates/' . $name );
			}

			if ( $template_file ) {
				return $template_file;
			}

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
	 * @return TF_Track_Kickstarter_Tools
	 */
	function tf_track_kickstarter_tools() {
		return TF_Track_Kickstarter_Tools::get_instance();
	}

}
