<?php
/**
 * Default Tracker template
 */

$percent = false;

if ( ! empty( $data['goal'] ) && ! empty( $data['pledged'] ) ) {
	$percent = round( 100 * floatval( $data['pledged'] ) / floatval( $data['goal'] ) );
}

$bg_image = '';
if ( isset( $instance['bg_image'] ) ) {
	$bg_image = 'background-image: url(' . esc_url( $instance['bg_image'] ) . ')';
}

?>
<div class="tf-tracker-wrap" style="<?php echo $bg_image; ?>">
	<div class="tf-tracker">
		<?php
			if ( ! empty( $instance['title'] ) ) {
				printf( '<h4>%s</h4>', apply_filters( 'widget_title', $instance['title'] ) );
			}
		?>
		<?php if ( ! empty( $descr ) ) : ?>
		<div class="tf-tracker-descr">
			<?php echo $descr; ?>
		</div>
		<?php endif; ?>
		<?php if ( ! empty( $data['pledged'] ) ) : ?>
		<div class="tf-tracker-item tf-pledged">
			<span class="tf-tracker-value">$<?php echo number_format( round( floatval( $data['pledged'] ) ) ); ?></span>
			<span class="tf-tracker-label"><?php _e( 'pledged', 'king_news' ); ?></span>
		</div>
		<?php endif; ?>
		<?php if ( $percent ) : ?>
		<div class="tf-tracker-item tf-percent">
			<span class="tf-tracker-value"><?php echo $percent; ?>%</span>
			<span class="tf-tracker-label"><?php _e( 'funded', 'king_news' ); ?></span>
		</div>
		<?php endif; ?>
		<?php if ( ! empty( $data['backers'] ) ) : ?>
		<div class="tf-tracker-item tf-backers">
			<span class="tf-tracker-value"><?php echo $data['backers']; ?></span>
			<span class="tf-tracker-label"><?php _e( 'backers', 'king_news' ); ?></span>
		</div>
		<?php endif; ?>
		<?php if ( ! empty( $data['end_time'] ) ) : ?>
		<div class="tf-tracker-item tf-end-time">
			<span class="tf-tracker-value"><?php
				echo tf_track_kickstarter_tools()->time_diff(
					current_time( 'timestamp' ),
					strtotime( $data['end_time'] ),
					'd'
				);
			?></span>
			<span class="tf-tracker-label"><?php _e( 'days to go', 'king_news' ); ?></span>
		</div>
		<?php endif; ?>
		<?php if ( ! empty( $project_button ) ) : ?>
		<div class="tf-tracker-action">
			<a href="<?php echo $url; ?>" class="btn btn-fullwidth"><?php echo $project_button; ?></a>
		</div>
		<?php endif; ?>
	</div>
</div>
