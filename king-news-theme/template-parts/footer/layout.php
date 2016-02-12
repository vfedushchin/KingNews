<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package king_news
 */

?>
<div class="footer-area-wrap invert">
	<div class="container">
		<?php do_action( 'king_news_render_widget_area', 'footer-area' ); ?>
	</div>
</div>

<div class="footer-container">
	<div <?php echo king_news_get_container_classes( array( 'site-info' ) ); ?>>
		<div class="site-info__flex">
			<?php king_news_footer_logo(); ?>
			<div class="site-info__mid-box"><?php
				king_news_footer_copyright();
				king_news_footer_menu();
			?></div>
			<?php king_news_social_list( 'footer' ); ?>
		</div>
	</div><!-- .site-info -->
</div><!-- .container -->