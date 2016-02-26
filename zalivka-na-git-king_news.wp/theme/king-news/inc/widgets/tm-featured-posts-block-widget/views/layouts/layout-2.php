<?php
/**
 * Template part to display posts in a Layout #2 view
 *
 * @package    __tm/widgets
 */

global $post;

$posts = get_posts(
	array(
		'orderby'     => 'date',
		'order'       => 'ASC',
		'numberposts' => 5,
	)
);

$item_count    = 1;
$special_class = 'large';
$image_size    = $this->image_sizes['large'];
$template      = locate_template( 'inc/widgets/tm-featured-posts-block-widget/views/loop.php' );

?>
<?php if ( 0 < sizeof( $posts ) ) : ?>
	<div class="tm_fpblock tm_fpblock-layout-2">
		<?php
		foreach ( $posts as $post ) {
			setup_postdata( $post );

			if ( true === has_post_thumbnail() ) {
				if ( ! empty( $template ) ) {
					include $template;
				}

				if ( 0 < $item_count ) {
					$special_class = 'small';
					$image_size    = $this->image_sizes['small'];
				}
				$item_count = $item_count + 1;
			}

			wp_reset_postdata();
		}
		?>
	</div>
<?php endif; ?>
