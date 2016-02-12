<?php
/**
 * Template part for default Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package king_news
 */
?>

<?php king_news_social_list( 'header' ); ?>

<div class="site-branding">
	<?php king_news_header_logo() ?>
	<?php king_news_site_description(); ?>
</div>

<?php king_news_main_menu(); ?>
