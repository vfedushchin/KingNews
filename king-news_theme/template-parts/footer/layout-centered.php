<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package king_news
 */

?>

<div class="footer-area-wrap invert--">
  <div class="container">
    <div class="footer-inner-line">
      <?php do_action( 'king_news_render_widget_area', 'footer-area' ); ?>
    </div><!-- .footer-inner-line -->
  </div>
</div>

<div class="footer-container">
	<div <?php echo king_news_get_container_classes( array( 'site-info' ) ); ?>>
    <div class="footer-inner">
  		<?php
  			king_news_footer_logo();
  			king_news_social_list( 'footer' );
  			king_news_footer_menu();
  			king_news_footer_copyright();
  		?>
    </div><!-- .footer-inner -->
	</div><!-- .site-info -->
</div><!-- .container -->