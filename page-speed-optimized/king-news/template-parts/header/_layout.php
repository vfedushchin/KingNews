<?php
/**
 * Template part for default Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package king_news
 */
?>


<div class="row">

  <div class="col-xs-12 col-md-12 col-lg-3 ">
    <div class="site-branding">
      <?php king_news_header_logo() ?>
      <?php king_news_site_description(); ?>
    </div>
  </div>

  <div class="col-xs-12 col-md-12 col-lg-6">
    <?php king_news_main_menu(); ?>
  </div>

  <div class="col-xs-12 col-md-12 col-lg-3">
    <?php king_news_social_list( 'header' ); ?>
  </div>
</div>
