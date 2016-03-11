<?php
/**
 * @package    king_news
 * @subpackage Widget Class
 * @author     Cherry Team <cherryframework@gmail.com>
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

if ( !class_exists( 'King_News_Taxonomy_Tiles_Widget' ) ) {

	/**
	 * Taxonomy Tiles Widget
	 */
	class King_News_Taxonomy_Tiles_Widget extends Cherry_Abstract_Widget {

		/**
		 * Taxonomy Tiles widget constructor
		 *
		 * @since  1.0.0
		 */
		public function __construct() {
			$this->widget_name			= esc_html__( 'Taxonomy Tiles Widget', 'king_news' );
			$this->widget_description	= esc_html__( 'This widget displays images from taxonomy.', 'king_news' );
			$this->widget_id			= 'widget-taxonomy-tiles';
			$this->widget_cssclass		= 'widget-taxonomy-tiles';

			$this->settings = array(
				'title'	=> array(
					'type'				=> 'text',
					'value'				=> '',
					'label'				=> esc_html__( 'Widget title', 'king_news' ),
				),
				'terms_type' => array(
					'type'				=> 'radio',
					'value'				=> 'category',
					'options'			=> array(
						'category' => array(
							'label'		=> esc_html__( 'Category', 'king_news' ),
						),
						'post_tag' => array(
							'label'		=> esc_html__( 'Tag', 'king_news' ),
						),
					),
					'label'				=> esc_html__( 'Choose taxonomy type', 'king_news' ),
				),
				'category'=> array(
					'type'				=> 'select',
					'multiple'			=> true,
					'value'				=> '',
					'options'			=> false,
					'options_callback'	=> array( $this, 'get_terms_list' ),
					'label'				=> esc_html__( 'Select category to show', 'king_news' ),
				),
				'post_tag' => array(
					'type'				=> 'select',
					'multiple'			=> true,
					'value'				=> '',
					'options'			=> false,
					'options_callback'	=> array( $this, 'get_terms_list', array('post_tag') ),
					'label'				=> esc_html__( 'Select tags to show', 'king_news' ),
				),
				'description_length' => array(
					'type'				=> 'stepper',
					'value'				=> '0',
					'max_value'			=> '500',
					'min_value'			=> '0',
					'step_value'		=> '1',
					'label'				=> esc_html__( 'Description words length ( Set 0 to hide description. )', 'king_news' ),
				),
				'show_post_count' => array(
					'type'				=> 'checkbox',
					'value'			=> array(
						'show_post_count_check' => 'true',
					),
					'options'		=> array(
						'show_post_count_check' => esc_html__( 'Show post count', 'king_news' ),
					),
				),
				'columns_number' => array(
					'type'				=> 'stepper',
					'value'				=> '2',
					'max_value'			=> '4',
					'min_value'			=> '1',
					'step_value'		=> '1',
					'label'				=> esc_html__( 'Columns number', 'king_news' ),
				),
				'first_item' => array(
					'type'				=> 'checkbox',
					'value'			=> array(
						'first_item_check' => 'false',
					),
					'options'		=> array(
						'first_item_check' => esc_html__( 'Tiles first item', 'king_news' ),
					),
				),
				'items_padding' => array(
					'type'				=> 'stepper',
					'value'				=> '5',
					'max_value'			=> '50',
					'min_value'			=> '2',
					'step_value'		=> '1',
					'label'				=> esc_html__( 'Items padding ( size in pixels )', 'king_news' ),
				),
			);

			parent::__construct();

		}

		/**
		 * Retur terms list
		 *
		 * @since  1.0.0
		 * @return terms array
		 */
		public function get_terms_list ( $tax = 'category', $args = array( 'hide_empty' => 0, 'hierarchical' => 0 ) ) {
			if( !array_key_exists( 'include', $args ) ){
				$args['include'] = array();
			}

			$terms = $this->get_terms( $tax, $args );
			$output_terms = array();

			if ( $terms ){
				foreach ( $terms as $term ) {
					$output_terms[ $term->term_id ] = $term->name . sprintf( _n( ' ( 1 post )', ' ( %s posts )', $term->count, 'king_news' ), $term->count );
				}
			}

			return $output_terms;
		}

		/**
		 * Retur terms
		 *
		 * @since  1.0.0
		 * @return terms array
		 */
		public function get_terms ( $tax, $args ) {
			return get_terms( $tax, $args );
		}

		/**
		 * Get term title
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_term_title( $term ) {
			return $term->name;
		}

		/**
		 * Get term link
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_term_link( $term ) {
			return get_category_link( $term->term_id );
		}

		/**
		 * Get term post count
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_term_post_count( $term, $visible ) {
			return ( 'false' === $visible ) ? '' : '<span class="post-count">' . sprintf( _n( '1 post', '%s posts', $term->count, 'king_news' ), $term->count ) . '</span>';
		}

		/**
		 * Get term description
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_term_description( $term, $lenght ) {
			$lenght = intval( $lenght );
			return ( 0 === $lenght || !$term->description ) ? '' : '<p class="post-desc">' . wp_trim_words( $term->description, $lenght, esc_html__( ' ...', 'king_news' ) ) . '</p>';
		}

		/**
		 * Get term image
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_term_image( $term, $image_size ) {
			$image = get_term_meta( $term->term_id, '_tm_thumb' , true );

			if( $image ){
				$image = wp_get_attachment_image( $image, $image_size );
			}else{
				global $_wp_additional_image_sizes;
				$size = $_wp_additional_image_sizes[ $image_size ];

				// Place holder defaults attr
				$placeholder_attr = apply_filters( 'king_news_taxonomy_tiles_widget_placeholder_default_args',
					array(
						'width'			=> $size['width'],
						'height'		=> $size['height'],
						'background'	=> '000',
						'foreground'	=> 'fff',
						'title'			=> $size['width'] . ' x ' . $size['height'],
					)
				);

				$placeholder_link = 'http://fakeimg.pl/' . $placeholder_attr['width'] . 'x' . $placeholder_attr['height'] . '/'. $placeholder_attr['background'] .'/'. $placeholder_attr['foreground'] . '/?text=' . $placeholder_attr['title'] . '';
				$image = '<img class="wp-post-image" src="' . $placeholder_link . '" alt="" title="' . $term->name . '">';
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
			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			ob_start();

			extract( $instance, EXTR_OVERWRITE );

			$this->setup_widget_data( $args, $instance );
			$this->widget_start( $args, $instance );

			if ( array_key_exists( $terms_type, $instance ) ) {
				$taxonomy = $instance[ $terms_type ];
				if ( $taxonomy ) {
					$terms = $this->get_terms( $terms_type, array('include' => $taxonomy, 'hide_empty' => false ) );
				}
			}

			if ( isset( $terms ) && $terms ) {
				$columns_class = 4 < $columns_number ? 3 : ( int ) ( 12 / $columns_number ) ;
				$first_columns_class = 2 < $columns_number ? 12 - $columns_class : 12 ;
				$tiles_item_number = apply_filters( 'king_news_taxonomy_tiles_item_number', 0 );
				$tiles_item_class = ' tile_item';
				$row_inline_style = '';
				$inline_style = '';

				if ( '0' !== $items_padding ) {
					$row_inline_style = 'style="margin-left:-' . $items_padding . 'px"';
					$inline_style = 'style="margin: 0 0 ' . $items_padding . 'px ' . $items_padding . 'px;"';
				}

				echo apply_filters( 'king_news_taxonomy_tiles_widget_before', '<div class="row grid-columns columns-number-' . $columns_number . '" ' . $row_inline_style . '>' );

				foreach ( $terms as $term_key => $term ) {

					$grid = ( $tiles_item_number === $term_key && 'true' === $first_item['first_item_check'] ) ? $first_columns_class . $tiles_item_class : $columns_class ;
					$title = $this->get_term_title( $term );
					$permalink = $this->get_term_link( $term );
					$count = $this->get_term_post_count( $term, $show_post_count['show_post_count_check'] );
					$description = $this->get_term_description( $term, $description_length );
					$image = $this->get_term_image( $term, apply_filters( 'king_news_taxonomy_tiles_widget_size', '_tm-thumb-426-327' ) );

					$view_dir = locate_template( 'inc/widgets/tm-taxonomy-tiles-widget/views/tm-taxonomy-tiles-view.php' );
					if ( $view_dir ){
						require( $view_dir );
					}
				}

				echo apply_filters( 'king_news_taxonomy_tiles_widget_after', '</div>' );
			}

			$this->widget_end( $args );
			$this->reset_widget_data();

			echo $this->cache_widget( $args, ob_get_clean() );
		}
	}

	add_action( 'widgets_init', 'king_news_register_taxonomy_tiles_widget' );
	function king_news_register_taxonomy_tiles_widget() {
		register_widget( 'King_News_Taxonomy_Tiles_Widget' );
	}

}
