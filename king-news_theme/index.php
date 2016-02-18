<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package king_news
 */

if ( have_posts() ) :

	if ( is_home() && ! is_front_page() ) : ?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>

	<?php
	endif; ?>


	<!-- title -->
	<h2 class="title-line"><?php esc_html_e( 'Latest news', 'king_news' ); ?></h2>

	<div <?php king_news_posts_list_class(); ?>>



	<?php /* Start the Loop */
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */

		//if need different templates for grid and masonry layouts
		$layout = get_theme_mod( 'blog_layout_type', 'default' );

		switch ( $layout ) {
			case 'grid-2-cols':
			case 'grid-3-cols':
				$layout = 'grid';
				break;
			
			case 'masonry-2-cols':
			case 'masonry-3-cols':
				$layout = 'masonry';
				break;

			case 'minimal':
				$layout = 'minimal';
				break;

			case 'default':
				$layout = 'default';
				break;
		}

		$format = get_post_format();

		if ( ! in_array( $layout, array( 'default', 'minimal' ) ) ) {
			if ( $format ) {
				$layout .= '-' . $format;
			}
		}
		$layout .= '-' . $format;

		echo " format = " . $format;
		echo "<br> layout = " . $layout;

		get_template_part( 'template-parts/content', $layout );

	endwhile; ?>

	</div><!-- .posts-list -->

	<?php get_template_part( 'template-parts/content', 'pagination' );

else :

	get_template_part( 'template-parts/content', 'none' );

endif; ?>
