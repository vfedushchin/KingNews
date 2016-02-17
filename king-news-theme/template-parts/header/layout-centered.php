<?php
/**
 * Template part for centered Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package king_news
 */
?>

<div class="site-branding">
	<div class="row">
    <div class="col-xs-12 col-md-7 col-xl-4  col-xl-offset-4 ">
      <div class="site-branding__logo">
        <?php king_news_header_logo() ?>
        <?php king_news_site_description(); ?>
      </div>
    </div>
    <div class="col-xs-12 col-md-5 col-xl-4 ">
      <?php king_news_social_list( 'header' ); ?>
    </div>
  </div>
</div>


<?php king_news_main_menu(); ?>