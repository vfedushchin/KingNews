<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package __tm
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php __tm_get_page_preloader(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '__tm' ); ?></a>
	<header id="masthead" <?php __tm_header_class(); ?> role="banner">
		<div class="top-panel">
			<div class="container">
				<div <?php echo __tm_get_container_classes( array( 'top-panel__wrap' ) ); ?>><?php
							__tm_top_message( '<div class="top-panel__message">%s</div>' );
							__tm_top_sign_register();
							__tm_top_search( '<div class="top-panel__search">%s</div>' );
							__tm_top_menu();
						?></div>
			</div><!-- .container -->
		</div><!-- .top-panel -->

		<div class="header-container">
			<div class="container">
				<div <?php echo __tm_get_container_classes( array( 'header-container_wrap' ) ); ?>>
					<?php get_template_part( 'template-parts/header/layout', get_theme_mod( 'header_layout_type' ) ); ?>
				</div>
			</div>
		</div><!-- .header-container -->
	</header><!-- #masthead -->

	<div id="content" <?php __tm_content_class(); ?>>
