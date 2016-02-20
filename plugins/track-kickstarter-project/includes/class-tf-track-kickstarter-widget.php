<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Adds TF_Track_Kickstarter_Widget widget.
 */
class TF_Track_Kickstarter_Widget extends WP_Widget {

	/**
	 * Widget fields.
	 */
	private $fields;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		parent::__construct(
			'tf_track_kickstarter',
			__( 'Track Kickstarter Project', 'track-kickstarter-project' ),
			array(
				'description' => __( 'Show stats from your Kickstarter project', 'track-kickstarter-project' ),
			)
		);

		/**
		 * Filter widget fields.
		 *
		 * @since 1.0.1
		 * @param array Default fields.
		 */
		$this->fields = apply_filters( 'tf_track_kickstarter_widget_fields', array(
			'title' => array(
				'label'    => __( 'Title', 'track-kickstarter-project' ),
				'type'     => 'text',
				'value'    => '',
				'sanitize' => 'strip_tags',
			),
			'url' => array(
				'label'    => __( 'Kickstarter project page URL', 'track-kickstarter-project' ),
				'type'     => 'text',
				'value'    => '',
				'sanitize' => 'esc_url',
			),
			'descr' => array(
				'label'    => __( 'Project description', 'track-kickstarter-project' ),
				'type'     => 'textarea',
				'value'    => '',
				'sanitize' => 'esc_textarea',
			),
			'project_button' => array(
				'label'    => __( 'Project link text (leave empty to hide link)', 'track-kickstarter-project' ),
				'type'     => 'text',
				'value'    => '',
				'sanitize' => 'esc_html',
			),
		) );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		if ( empty( $instance['url'] ) ) {
			return;
		}

		$widget_header = tf_track_kickstarter_tools()->locate_template( 'widget-header.php' );
		if ( $widget_header ) {
			include $widget_header;
		}

		$handler         = tf_track_kickstarter_handle( $instance['url'] );
		$data            = $handler->get_data();
		$widget_template = tf_track_kickstarter_tools()->locate_template( 'default.php' );
		$url             = esc_url( $instance['url'] );
		$descr           = ! empty( $instance['descr'] ) ? $instance['descr'] : '';
		$project_button  = ! empty( $instance['project_button'] ) ? $instance['project_button'] : '';

		if ( $data && $widget_template ) {
			include $widget_template;
		}

		$widget_footer = tf_track_kickstarter_tools()->locate_template( 'widget-footer.php' );
		if ( $widget_footer ) {
			include $widget_footer;
		}
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$url   = ! empty( $instance['url'] ) ? $instance['url'] : '';
		$descr = ! empty( $instance['descr'] ) ? $instance['descr'] : '';

		foreach ( $this->fields as $field => $data ) {

			if ( ! isset( $instance[ $field ] ) ) {
				$value = $data['value'];
			} else {
				$value = $instance[ $field ];
			}

			?>
			<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php
				echo $data['label'];
			?></label>
			<?php
			switch ( $data['type'] ) {
				case 'text':
					?>
					<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>">
					<?php
					break;
				case 'textarea':
					?>
					<textarea class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" ><?php echo esc_attr( $value ); ?></textarea>
					<?php
					break;
				default:

					/**
					 * Allow to use custom controls in widget form
					 */
					do_action( 'tf_track_kickstarter_widget_form_contol_' . $data['type'], $field, $data, $instance );
					break;
			}
			?>
			</p>
			<?php
		}
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		foreach ( $this->fields as $field => $data ) {

			if ( ! isset( $data['sanitize'] ) ) {
				$data['sanitize'] = 'esc_attr';
			}

			if ( ! empty( $new_instance[ $field ] ) ) {
				$instance[ $field ] = call_user_func( $data['sanitize'], $new_instance[ $field ] );
			} else {
				$instance[ $field ] = '';
			}
		}

		return $instance;
	}

}
