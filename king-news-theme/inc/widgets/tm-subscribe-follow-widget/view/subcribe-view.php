<?php
/**
 * Template part to display subscribe form
 *
 * @package __tm/widgets
 */
?>
<div class="subscribe-block">

	<?php echo $this->get_block_title( 'subscribe' ); ?>
	<?php echo $this->get_block_message( 'subscribe' ); ?>

	<form method="POST" action="" class="subscribe-block__form"><?php
		wp_nonce_field( '__tm_subscribe', '__tm_subscribe' );
		echo $this->get_subscribe_input();

		$btn = 'btn';
		if ( 'footer-area' === $this->args['id'] ) {
			$btn .= ' btn-secondary';
		}

		echo $this->get_subscribe_submit( $btn );
		echo $this->get_subscribe_messages();
	?></form>
</div>