<?php
/**
 * Widget king_news subscribe and follow
 *
 * @package king_news
 */

class KING_NEWS_Subscribe_Follow_Widget extends Cherry_Abstract_Widget {

	/**
	 * MailChimp API server
	 *
	 * @var string
	 */
	private $api_server = 'https://%s.api.mailchimp.com/2.0/';

	/**
	 * Service errors set
	 *
	 * @var array
	 */
	public $errors = array();

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->widget_cssclass    = 'king_news widget-subscribe';
		$this->widget_description = __( 'Display subscribe form and follow links.', 'king_news' );
		$this->widget_id          = 'king_news_widget_subscribe_follow';
		$this->widget_name        = __( 'Subscribe and Follow', 'king_news' );
		$this->settings           = array(
			'enable_subscribe' => array(
				'type'   => 'checkbox',
				'value'  => array(
					'enable_subscribe' => 'true',
				),
				'options' => array(
					'enable_subscribe' => __( 'Enable Subscribe Box', 'king_news' ),
				),
			),
			'subscribe_title' => array(
				'type'  => 'text',
				'value' => __( 'Subscribe', 'king_news' ),
				'label' => __( 'Subscribe Title', 'king_news' ),
			),
			'subscribe_message' => array(
				'type'  => 'textarea',
				'label' => __( 'Subscribe text message', 'king_news' ),
			),
			'subscribe_input' => array(
				'type'  => 'text',
				'value' => __( 'Enter your email', 'king_news' ),
				'label' => __( 'Subscribe input placeholder', 'king_news' ),
			),
			'subscribe_submit' => array(
				'type'  => 'text',
				'value' => __( 'Subscribe', 'king_news' ),
				'label' => __( 'Subscribe submit label', 'king_news' ),
			),
			'subscribe_success' => array(
				'type'  => 'text',
				'value' => __( 'You successfully subscribed', 'king_news' ),
				'label' => __( 'Subscribe success', 'king_news' ),
			),
			'enable_follow' => array(
				'type'   => 'checkbox',
				'value'  => array(
					'enable_follow' => 'true',
				),
				'options' => array(
					'enable_follow' => __( 'Enable Follow Box', 'king_news' ),
				),
			),
			'follow_title' => array(
				'type'  => 'text',
				'value' => __( 'Follow', 'king_news' ),
				'label' => __( 'Follow Title', 'king_news' ),
			),
			'follow_message' => array(
				'type'  => 'textarea',
				'label' => __( 'Follow text message', 'king_news' ),
			),
		);

		add_action( 'wp_ajax_king_news_subscribe', array( $this, 'process_subscribe' ) );
		add_action( 'wp_ajax_nopriv_king_news_subscribe', array( $this, 'process_subscribe' ) );

		$this->errors = array(
			'nonce'     => esc_html__( 'Security validation failed', 'king_news' ),
			'mail'      => esc_html__( 'Please, provide valid mail', 'king_news' ),
			'mailchimp' => esc_html__( 'Please, set up MailChimp API key and List ID', 'king_news' ),
			'internal'   => esc_html__( 'Internal error. Please, try again later', 'king_news' ),
		);

		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		$this->setup_widget_data( $args, $instance );
		$this->widget_start( $args, $instance );

		$subscribe_enabled = ( ! empty( $instance['enable_subscribe'] ) ) ? $instance['enable_subscribe'] : false;

		if ( is_array( $subscribe_enabled ) && 'true' === $subscribe_enabled['enable_subscribe'] ) {
			$subscribe_enabled = true;
		} else {
			$subscribe_enabled = false;
		}

		$follow_enabled = ( ! empty( $instance['enable_follow'] ) ) ? $instance['enable_follow'] : false;

		if ( is_array( $follow_enabled ) && 'true' === $follow_enabled['enable_follow'] ) {
			$follow_enabled = true;
		} else {
			$follow_enabled = false;
		}

		$follow_template = locate_template( 'inc/widgets/tm-subscribe-follow-widget/view/follow-view.php' );

		// Load follow template
		if ( $follow_template && $follow_enabled ) {
			include $follow_template;
		}

		$subscribe_template = locate_template( 'inc/widgets/tm-subscribe-follow-widget/view/subcribe-view.php' );

		$api_key = get_theme_mod( 'mailchimp_api_key' );
		$list_id = get_theme_mod( 'mailchimp_list_id' );

		// Load subscribe tamplate
		if ( $subscribe_enabled && $subscribe_template && $api_key && $list_id ) {
			include $subscribe_template;
		} elseif ( ! $api_key || ! $list_id ) {
			_e( 'Please set up MailChimp API key and List ID', 'king_news' );
		}

		$this->widget_end( $args );
		$this->reset_widget_data();

		echo $this->cache_widget( $args, ob_get_clean() );
	}

	/**
	 * Get social navigation menu
	 *
	 * @return string
	 */
	public function get_social_nav() {
		return king_news_get_social_list( 'widget' );
	}

	/**
	 * Get subscribe button HTML.
	 *
	 * @param  string $class CSS class.
	 * @return string
	 */
	public function get_subscribe_submit( $class ) {

		$subscribe_submit = ( ! empty( $this->instance['subscribe_submit'] ) ) ? $this->instance['subscribe_submit'] : '';

		return '<a href="#" class="subscribe-block__submit ' . esc_attr( $class ) . '">' . esc_html( $subscribe_submit ) . '</a>';
	}

	/**
	 * Get subscribe or follow block title.
	 *
	 * @param  string $block Block name to get title for.
	 * @return string
	 */
	public function get_block_title( $block = 'follow' ) {

		$setting = $block . '_title';
		$title   = ( ! empty( $this->instance[ $setting ] ) ) ? $this->instance[ $setting ] : '';

		if ( $title ) {
			return $this->args['before_title'] . $title . $this->args['after_title'];
		}
	}

	/**
	 * Get subscribe or follow block title.
	 *
	 * @param  string $block Block name to get title for.
	 * @return string
	 */
	public function get_block_message( $block = 'follow' ) {

		$setting = $block . '_message';
		$message = ( ! empty( $this->instance[ $setting ] ) ) ? $this->instance[ $setting ] : '';

		if ( $message ) {
			return '<div class="' . $block . '-block__message">' . wp_kses( $message, wp_kses_allowed_html( 'post' ) ) . '</div>';
		}

	}

	/**
	 * Get subscribe form input
	 *
	 * @return string
	 */
	public function get_subscribe_input() {
		return '<input class="subscribe-block__input" type="email" name="subscribe-mail" value="" placeholder="' . esc_attr( $this->instance['subscribe_input'] ) . '">';
	}

	/**
	 * Get subscribe form service messages
	 *
	 * @return string
	 */
	public function get_subscribe_messages() {

		$success = ( ! empty( $this->instance['subscribe_success'] ) ) ? $this->instance['subscribe_success'] : '';

		return '<div class="subscribe-block__messages">
					<div class="subscribe-block__success hidden">' . esc_html( $success ) . '</div>
					<div class="subscribe-block__error hidden"></div>
				</div>';
	}

	/**
	 * Process subscribtion form
	 *
	 * @return void
	 */
	public function process_subscribe() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'king_news_subscribe' ) ) {
			wp_send_json_error( array( 'message' => $this->errors['nonce'] ) );
		}

		$mail = ( ! empty( $_POST['mail'] ) ) ? esc_attr( $_POST['mail'] ) : false;

		if ( ! is_email( $mail ) ) {
			wp_send_json_error( array( 'message' => $this->errors['mail'] ) );
		}

		$args = array(
			'email' => array(
				'email' => $mail,
			),
			'double_optin' => false,
		);

		$response = $this->api_call( 'lists/subscribe', $args );

		if ( false === $response ) {
			wp_send_json_error( array( 'message' => $this->errors['mailchimp'] ) );
		}

		$response = json_decode( $response, true );

		if ( empty( $response ) ) {
			wp_send_json_error( array( 'message' => $this->errors['internal'] ) );
		}

		if ( isset( $response['status'] ) && 'error' == $response['status'] ) {
			wp_send_json_error( array( 'message' => esc_html( $response['error'] ) ) );
		}

		wp_send_json_success();

	}

	/**
	 * Make remote request to mailchimp API
	 *
	 * @param  string $method API method to call.
	 * @param  array  $args   API call arguments.
	 * @return array|bool
	 */
	public function api_call( $method, $args = array() ) {

		if ( ! $method ) {
			return false;
		}

		$api_key = get_theme_mod( 'mailchimp_api_key' );
		$list_id = get_theme_mod( 'mailchimp_list_id' );

		if ( ! $api_key || ! $list_id ) {
			return false;
		}

		$key_data = explode( '-', $api_key );

		if ( empty( $key_data ) || ! isset( $key_data[1] ) ) {
			return false;
		}

		$this->api_server = sprintf( $this->api_server, $key_data[1] );

		$url      = esc_url( trailingslashit( $this->api_server . $method ) );
		$defaults = array( 'apikey' => $api_key, 'id' => $list_id );
		$data     = json_encode( array_merge( $defaults, $args ) );

		$request = wp_remote_post( $url, array( 'body' => $data ) );

		return wp_remote_retrieve_body( $request );

	}

}

add_action( 'widgets_init', 'king_news_register_subscribe_follow_widgets' );
function king_news_register_subscribe_follow_widgets() {
	register_widget( 'KING_NEWS_Subscribe_Follow_Widget' );
}
