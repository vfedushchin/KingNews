<?php
/**
 * @package		king_news
 * @subpackage	Widget Class
 * @author		<[email address]>Cherry Team <cherryframework@gmail.com>
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

if ( !class_exists( 'King_News_Image_Grid_Widget' ) ) {

	/**
	 * Image Grid Widget
	 */
	class King_News_Image_Grid_Widget extends Cherry_Abstract_Widget {

		/**
		 * Image grid widget constructor
		 *
		 * @since  1.0.0
		 */
		public function __construct() {
			$this->widget_name			= esc_html__( 'Image Grid Widget', 'king_news' );
			$this->widget_description	= esc_html__( 'This widget displays images from post.', 'king_news' );
			$this->widget_id			= 'widget-image-grid';
			$this->widget_cssclass		= 'widget-image-grid';

			$this->settings				= array(
				'title'	=> array(
					'type'				=> 'text',
					'value'				=> '',
					'label'				=> esc_html__( 'Widget title', 'king_news' ),
				),
				'terms_type' => array(
					'type'				=> 'radio',
					'value'				=> 'category_name',
					'options'			=> array(
						'category_name' => array(
							'label'		=> esc_html__( 'Category', 'king_news' ),
						),
						'tag' => array(
							'label'		=> esc_html__( 'Tag', 'king_news' ),
						),
					),
					'label'				=> esc_html__( 'Choose taxonomy type', 'king_news' ),
				),
				'category_name' => array(
					'type'				=> 'select',
					'multiple'			=> true,
					'value'				=> '',
					'options'			=> false,
					'options_callback'	=> array( $this, 'get_terms_list', array('category') ),
					'label'				=> esc_html__( 'Select categories to show', 'king_news' ),
				),
				'tag' => array(
					'type'				=> 'select',
					'multiple'			=> true,
					'value'				=> '',
					'options'			=> false,
					'options_callback'	=> array( $this, 'get_terms_list', array('post_tag') ),
					'label'				=> esc_html__( 'Select tags to show', 'king_news' ),
				),
				'post_sort' => array(
					'type'				=> 'select',
					'value'				=> 'date',
					'options'		=> array(
						'date' 				=> esc_html__( 'Publish Date', 'king_news' ),
						'title'				=> esc_html__( 'Post Title', 'king_news' ),
						'comment_count'		=> esc_html__( 'Comment Count', 'king_news' ),
					),
					'label'				=> esc_html__( 'Post sorted', 'king_news' ),
				),
				'post_number' => array(
					'type'				=> 'stepper',
					'value'				=> '5',
					'max_value'			=> '100',
					'min_value'			=> '1',
					'step_value'		=> '1',
					'label'				=> esc_html__( 'Posts number', 'king_news' ),
				),
				'post_offset' => array(
					'type'				=> 'stepper',
					'value'				=> '0',
					'max_value'			=> '10000',
					'min_value'			=> '0',
					'step_value'		=> '1',
					'label'				=> esc_html__( 'Offset post', 'king_news' ),
				),
				'title_length' => array(
					'type'				=> 'stepper',
					'value'				=> '10',
					'max_value'			=> '500',
					'min_value'			=> '0',
					'step_value'		=> '1',
					'label'				=> esc_html__( 'Title words length ( Set 0 to hide title. )', 'king_news' ),
				),
				'columns_number' => array(
					'type'				=> 'stepper',
					'value'				=> '3',
					'max_value'			=> '4',
					'min_value'			=> '1',
					'step_value'		=> '1',
					'label'				=> esc_html__( 'Columns number', 'king_news' ),
				),
				'items_padding' => array(
					'type'				=> 'stepper',
					'value'				=> '5',
					'max_value'			=> '50',
					'min_value'			=> '0',
					'step_value'		=> '1',
					'label'				=> esc_html__( 'Items padding ( size in pixels )', 'king_news' ),
				),
			);

			$this->get_terms_list();

			add_filter( 'king_news_image_grid_widget_size', array( $this, 'set_scaled_size' ) );

			parent::__construct();

		}

		/**
		 * Set smaller sizes if area and columns allow it
		 *
		 * @param  string $size Default image size.
		 * @return string
		 */
		public function set_scaled_size( $size ) {

			if ( ! in_array( $this->args['id'], array( 'before-loop-area', 'after-loop-area' ) ) ) {
				return $size;
			}

			if ( ! isset( $this->instance['columns_number'] ) || 3 > $this->instance['columns_number'] ) {
				return $size;
			}

			return '_tm-thumb-337-258';

		}

		/**
		 * Retur post terms
		 *
		 * @since  1.0.0
		 * @return terms array
		 */
		public function get_terms_list ( $tax = 'category' ) {
			$output_terms = array();
			$terms = get_terms( $tax, array(
				'hide_empty'	=> 0,
				'hierarchical'	=> 0,
			));

			if ( $terms ){
				foreach ( $terms as $term ) {
					$output_terms[ $term->slug ] = $term->name /*. sprintf( _n( ' ( 1 post )', ' ( %s posts )', $term->count, 'king_news' ), $term->count )*/;
				}
			}

			return $output_terms;
		}

		/**
		 * Get post title
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_post_title( $post, $instance ) {
			$title = '' ;

			if( '0' !== $instance['title_length'] ){
				$title = wp_trim_words( $post->post_title, $instance['title_length'], esc_html__( ' ...', 'king_news' ) );
			}

			return $title;
		}

		/**
		 * Get post permalink
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_post_permalink() {
			return esc_url( get_the_permalink() );
		}

		/**
		 * Get post permalink
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_post_date() {
			$post_format = get_option( 'date_format' );
			$time = get_the_time( $post_format );

			return '<time class="entry-date published" datetime="' . get_the_time( 'Y-m-d\TH:i:sP' ) . '">' . $time . '</time>';
		}

		/**
		 * Get post image
		 *
 		 * @since  1.0.0
		 * @return string
		 */
		public function get_post_image( $post, $image_size ) {
			$image = get_the_post_thumbnail( $post->ID, $image_size );

			if( !$image ){
				global $_wp_additional_image_sizes;
				$size = $_wp_additional_image_sizes[ $image_size ];

				// Place holder defaults attr
				$placeholder_attr = apply_filters( 'king_news_image_grid_widget_placeholder_default_args',
					array(
						'width'			=> $size['width'],
						'height'		=> $size['height'],
						'background'	=> '000',
						'foreground'	=> 'fff',
						'title'			=> $size['width'] . 'x' . $size['height'],
					)
				);

				$placeholder_link = 'http://fakeimg.pl/' . $placeholder_attr['width'] . 'x' . $placeholder_attr['height'] . '/'. $placeholder_attr['background'] .'/'. $placeholder_attr['foreground'] . '/?text=' . $placeholder_attr['title'] . '';
				$image = '<img class="wp-post-image" src="' . $placeholder_link . '" alt="" title="' . $post->post_title . '">';
			}

			return $image;
		}

		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 *
		 * @since  1.0.0
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			global $post;

			$args = apply_filters( 'king_news_image_grid_widget_args', $args );

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			ob_start();

			extract( $instance, EXTR_OVERWRITE );

			$this->setup_widget_data( $args, $instance );
			$this->widget_start( $args, $instance );


			if ( array_key_exists( $terms_type, $instance ) ) {
				$post_taxonomy = $instance[ $terms_type ];

				if( $post_taxonomy ){
					$post_args = array(
						'post_type'		=> 'post',
						'offset'		=> $post_offset,
						'orderby'		=> $post_sort,
						'order'			=> apply_filters( '_tm_order_image_grid_widget', 'DESC' ),//ASC
						'numberposts'	=> ( int ) $post_number,
					);
					$post_args[ $terms_type ] = implode( ',', $post_taxonomy );

					$posts = get_posts( $post_args );
				}
			}

			if ( isset( $posts ) && $posts ) {
				$columns_class = 4 < $columns_number ? 3 : ( int ) ( 12 / $columns_number ) ;
				$row_inline_style = '';
				$inline_style = '';

				if( '0' !== $items_padding ){
					$row_inline_style = 'style="margin-left:-' . $items_padding . 'px"';
					$inline_style = 'style="margin: 0 0 ' . $items_padding . 'px ' . $items_padding . 'px;"';
				}

				echo apply_filters( 'king_news_image_grid_widget_before', '<div class="row image_grid_widget-main columns-number-' . $columns_number . '" ' . $row_inline_style . '>' );

				$image_size = apply_filters( 'king_news_image_grid_widget_size', '_tm-thumb-536-411' );

				foreach ( $posts as $post ) {
					setup_postdata( $post );

					$image = $this->get_post_image( $post, $image_size );
					$permalink = $this->get_post_permalink();
					$title = $this->get_post_title( $post, $instance );
					$date = $this->get_post_date();
					//$date = human_time_diff($date, current_time( 'timestamp' ));
					//$date = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ));
					$date = sprintf( _x( '%s ago', '%s = human-readable time difference', 'king_news' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );


					$view_dir = locate_template( 'inc/widgets/tm-image-grid-widget/views/tm-image-grid-view.php' );
					if ( $view_dir ){
						require( $view_dir );
					}

				}

				echo apply_filters( 'king_news_image_grid_widget_after', '</div>' );
			}

			$this->widget_end( $args );
			$this->reset_widget_data();
			wp_reset_postdata();

			echo $this->cache_widget( $args, ob_get_clean() );
		}
	}

	add_action( 'widgets_init', 'king_news_register_image_grid_widget' );
	function king_news_register_image_grid_widget() {
		register_widget( 'King_News_Image_Grid_Widget' );
	}

}