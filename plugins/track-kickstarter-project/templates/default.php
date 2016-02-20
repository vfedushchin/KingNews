<?php
/**
 * Default Tracker template
 */
?>
<div class="tf-tracker">
	<?php if ( ! empty( $descr ) ) : ?>
	<div class="tf-tracker-descr">
		<?php echo $descr; ?>
	</div>
	<?php endif; ?>
	<?php if ( ! empty( $data['backers'] ) ) : ?>
	<div class="tf-tracker-item tf-backers">
		<span class="tf-tracker-value"><?php echo $data['backers']; ?></span>
		<span class="tf-tracker-label"><?php _e( 'backers', 'track-kickstarter-project' ); ?></span>
	</div>
	<?php endif; ?>
	<?php if ( ! empty( $data['pledged'] ) ) : ?>
	<div class="tf-tracker-item tf-pledged">
		<span class="tf-tracker-value"><?php echo $data['pledged']; ?></span>
		<span class="tf-tracker-label"><?php _e( 'pledged', 'track-kickstarter-project' ); ?></span>
	</div>
	<?php endif; ?>
	<?php if ( ! empty( $data['goal'] ) ) : ?>
	<div class="tf-tracker-item tf-goal">
		<span class="tf-tracker-value"><?php echo $data['goal']; ?></span>
		<span class="tf-tracker-label"><?php _e( 'goal', 'track-kickstarter-project' ); ?></span>
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
		<span class="tf-tracker-label"><?php _e( 'days left', 'track-kickstarter-project' ); ?></span>
	</div>
	<?php endif; ?>
	<?php if ( ! empty( $project_button ) ) : ?>
	<div class="tf-tracker-action">
		<a href="<?php echo $url; ?>" class="tf-tracker-link"><?php echo $project_button; ?></a>
	</div>
	<?php endif; ?>
</div>