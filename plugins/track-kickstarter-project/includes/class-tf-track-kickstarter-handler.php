<?php
/**
 * Main handler. Gets and parse data from kickstarter.com
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'TF_Track_Kickstarter_Handle' ) ) {

	/**
	 * Base plugin class
	 *
	 * @since 1.0.0
	 */
	class TF_Track_Kickstarter_Handle {

		/**
		 * Handler settings.
		 *
		 * @since 1.0.0
		 * @var   array
		 */
		public static $settings = null;

		/**
		 * Allowed data to hadle.
		 *
		 * @since 1.0.0
		 * @var   array
		 */
		public static $data = null;

		/**
		 * URL to parse
		 *
		 * @since 1.0.0
		 * @var   string
		 */
		public $url = null;

		/**
		 * Constructor for the class.
		 *
		 * @since 1.0.0
		 */
		public function __construct( $url ) {
			$this->url = esc_attr( $url );
		}

		/**
		 * Try to get data from passed URL
		 *
		 * @since  1.0.0
		 * @return array|bool
		 */
		public function get_data() {

			$cached = $this->get_cached();

			if ( $cached ) {
				return $cached;
			}

			if ( false === strrpos( $this->url, $this->get_setting( 'base_url' ) ) ) {
				return false;
			}

			$response = wp_remote_get( $this->url );

			if ( is_wp_error( $response ) ) {
				return false;
			}

			$response_body = wp_remote_retrieve_body( $response );

			$data = $this->parse_data( $response_body );

			set_transient( $this->get_transient_key(), $data, $this->get_setting( 'cache_expire' ) );

			return $data;
		}

		/**
		 * Try to found required data in retrieved ducument body
		 *
		 * @since  1.0.0
		 * @param  string $body Retrieved project body.
		 * @return mixed
		 */
		public function parse_data( $body ) {

			$data = array();

			foreach ( $this->get_data_to_parse() as $key => $item_data ) {

				preg_match( $this->prepare_regex( $item_data ), $body, $matches );

				if ( ! isset( $matches[1] ) ) {
					$data[ $key ] = '';
					continue;
				}

				$data[ $key ] = $matches[1];
			}

			return $data;

		}

		/**
		 * Build regex to catch data  from document body.
		 *
		 * @since  1.0.0
		 * @param  array $data Data to build regex from.
		 * @return string
		 */
		public function prepare_regex( $data ) {

			$regex = '';

			switch ( $data['type'] ) {
				case 'attr':
					$regex = '<' . preg_quote( $data['tag'] ) . '[^>]*' . preg_quote( $data['name'] ) . '=[\'\"]([^\'\"]*)[\'\"]';
					break;

				default:
					$regex = '<' . preg_quote( $data['tag'] ) . '[^>]*' . preg_quote( $data['attr'] ) . '=[\'\"]' . preg_quote( $data['val'] ) . '[\'\"][^>]*>(.*)<\/' . preg_quote( $data['tag'] ) . '>';
					break;
			}

			return '/'. $regex . '/';
		}

		/**
		 * Try to get chaed data
		 *
		 * @since  1.0.0
		 * @return array|bool
		 */
		public function get_cached() {
			return get_transient( $this->get_transient_key() );
		}

		/**
		 * Get transient key for current handler instance
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_transient_key() {
			return md5( $this->url );
		}

		/**
		 * Get data list to try parse it from project.
		 *
		 * @since  1.0.0
		 * @return array
		 */
		public function get_data_to_parse() {

			if ( null === self::$data ) {
				self::$data = apply_filters( 'tf_track_kickstarter_data', array(
					'backers' => array(
						'type' => 'attr',
						'name' => 'data-backers-count',
						'tag'  => 'div',
					),
					'pledged' => array(
						'type' => 'attr',
						'name' => 'data-pledged',
						'tag'  => 'div',
					),
					'goal' => array(
						'type' => 'attr',
						'name' => 'data-goal',
						'tag'  => 'div',
					),
					'end_time' => array(
						'type' => 'attr',
						'name' => 'data-end_time',
						'tag'  => 'div',
					),
				) );
			}

			return self::$data;
		}

		/**
		 * Returns passed setting value all array with all settings.
		 *
		 * @since  1.0.0
		 * @param  string $setting Setting name to get.
		 * @param  mixed  $default Default setting value.
		 * @return mixed
		 */
		public function get_setting( $setting = null, $default = false ) {

			if ( null === self::$settings ) {
				self::$settings = apply_filters( 'tf_track_kickstarter_settings', array(
					'cache_expire' => 6*HOUR_IN_SECONDS,
					'base_url'     => 'https://www.kickstarter.com/',
				) );
			}

			if ( null === $setting ) {
				return self::$settings;
			}

			if ( ! isset( self::$settings[ $setting ] ) ) {
				return $default;
			}

			return self::$settings[ $setting ];

		}

	}

	/**
	 * Returns new handler instance for passed URL
	 *
	 * @since  1.0.0
	 * @param  string $url URL to parse.
	 * @return TF_Track_Kickstarter_Handle
	 */
	function tf_track_kickstarter_handle( $url = null ) {
		return new TF_Track_Kickstarter_Handle( $url );
	}

}
