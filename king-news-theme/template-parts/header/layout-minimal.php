<?php
/**
 * Template part for minimal Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package king_news
 */
?>
<div class="header-container__flex">
	<?php king_news_social_list( 'header' ); ?>
	<div class="site-branding">
		<?php king_news_header_logo() ?>
		<?php king_news_site_description(); ?>
	</div>
	<?php king_news_main_menu(); ?>
</div>
