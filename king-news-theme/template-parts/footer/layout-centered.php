<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package __tm
 */

?>
<div class="footer-container">
	<div <?php echo __tm_get_container_classes( array( 'site-info' ) ); ?>>
		<?php
			__tm_footer_logo();
			__tm_social_list( 'footer' );
			__tm_footer_menu();
			__tm_footer_copyright();
		?>
	</div><!-- .site-info -->
</div><!-- .container -->