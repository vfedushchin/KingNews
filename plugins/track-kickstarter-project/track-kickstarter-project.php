<?php
/**
 * Plugin Name: Track Kickstarter Project
 * Plugin URI:
 * Description: Easly track your Kickstarter projects and show up stats in your blog.
 * Version:     1.0.1
 * Author:      teFox
 * Author URI:  http://www.tefox.net/
 * Text Domain: track-kickstarter-project
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'TF_Track_Kickstarter' ) ) {

	/**
	 * Base plugin class
	 *
	 * @since 1.0.0
	 */
	class TF_Track_Kickstarter {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Holder for plugin folder URL.
		 *
		 * @since 1.0.0
		 * @var   string
		 */
		public $plugin_url = null;
		/**
		 * Holder for plugin folder path.
		 *
		 * @since 1.0.0
		 * @var   string
		 */
		public $plugin_dir = null;

		/**
		 * Sets up needed actions/filters for the plugin to initialize.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$this->includes();
			$this->init();

		}

		/**
		 * Include globally required files.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function includes() {
			require_once $this->plugin_dir( 'includes/class-tf-track-kickstarter-widget.php' );
			require_once $this->plugin_dir( 'includes/class-tf-track-kickstarter-shortcode.php' );
			require_once $this->plugin_dir( 'includes/class-tf-track-kickstarter-handler.php' );
			require_once $this->plugin_dir( 'includes/class-tf-track-kickstarter-tools.php' );
		}

		/**
		 * Init required actions
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function init() {
			add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
			add_action( 'widgets_init', array( $this, 'register_widget' ) );
			add_action( 'after_setup_theme', 'tf_track_kickstarter_shortcode' );
		}

		/**
		 * Enqueue styles
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function assets() {
			wp_enqueue_style( 'tf-track-kickstarter', $this->plugin_url( 'assets/css/track-kickstarter.css' ), false, '1.0.0' );
		}

		/**
		 * Register Kickstarter tracker widget
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function register_widget() {
			register_widget( 'TF_Track_Kickstarter_Widget' );
		}

		/**
		 * Get plugin URL.
		 *
		 * @since  1.0.0
		 * @param  string $path Path to file or dir root to plugin dir.
		 * @return string
		 */
		public function plugin_url( $path = null ) {

			if ( ! $this->plugin_url ) {
				$this->plugin_url = trailingslashit( plugin_dir_url( __FILE__ ) );
			}
			if ( null != $path ) {
				return $this->plugin_url . $path;
			}
			return $this->plugin_url;
		}

		/**
		 * Get plugin dir path.
		 *
		 * @since  1.0.0
		 * @param  string $path Path to file or dir root to plugin dir.
		 * @return string
		 */
		public function plugin_dir( $path = null ) {

			if ( ! $this->plugin_dir ) {
				$this->plugin_dir = trailingslashit( plugin_dir_path( __FILE__ ) );
			}
			if ( null != $path ) {
				return $this->plugin_dir . $path;
			}
			return $this->plugin_dir;
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
	 * Returns base plugin instance
	 *
	 * @return TF_Track_Kickstarter
	 */
	function tf_track_kickstarter() {
		return TF_Track_Kickstarter::get_instance();
	}

	tf_track_kickstarter();
}
