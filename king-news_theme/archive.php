<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package king_news
 */

if ( have_posts() ) : ?>

	<header class="page-header">
		<?php
			the_archive_title( '<h1 class="page-title screen-reader-text">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header><!-- .page-header -->

	<?php
	echo "<h2  class='title-line archive-title'>";
	echo single_cat_title();
	echo get_the_author( );
	echo "</h2>";

	?><div <?php king_news_posts_list_class(); ?>><?php
	/* Start the Loop */
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */

		/*if( is_category( ) ){
			$layout = '-default';
		}
		get_template_part( 'template-parts/content' . $layout, get_post_format() );*/

				//if need different post templates for grid and masonry layouts
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
				$layout = 'default';
				break;

			case 'default':
				$layout = 'default';
				break;
		}

		if( is_category( ) ){
			// $layout = 'default';
		}

		$format = get_post_format();

		if ( in_array( $layout, array( 'default', 'minimal', 'masonry', 'grid' ) ) ) {
			if ( $format ) {
				$layout .= '-' . $format;
			}
		}

		get_template_part( 'template-parts/content', $layout );



	endwhile;

	echo "</div><!-- .posts-list -->";

	get_template_part( 'template-parts/content', 'pagination' );

else :

	get_template_part( 'template-parts/content', 'none' );

endif; ?>