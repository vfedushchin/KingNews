<?php
/**
 * Widget header template
 */

echo $args['before_widget'];

if ( ! empty( $instance['title'] ) ) {
	echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
}
