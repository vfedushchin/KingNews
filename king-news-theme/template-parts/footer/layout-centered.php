<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package king_news
 */

?>
<div class="footer-container">
	<div <?php echo king_news_get_container_classes( array( 'site-info' ) ); ?>>
		<?php
			king_news_footer_logo();
			king_news_social_list( 'footer' );
			king_news_footer_menu();
			king_news_footer_copyright();
		?>
	</div><!-- .site-info -->
</div><!-- .container -->