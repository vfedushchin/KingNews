<?php
/**
 * @package    __tm
 * @subpackage Widget Class
 * @author     Cherry Team <cherryframework@gmail.com>
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( '__Tm_Featured_Posts_Block_Widget' ) ) {

	/**
	 * Featured Posts Block Widget
	 */
	class __Tm_Featured_Posts_Block_Widget extends Cherry_Abstract_Widget {

		/**
		 * Images sizes configuration
		 *
		 * @var array
		 */
		public $image_sizes = array(
			'large'             => '_tm-thumb-860-662',
			'large_2x'          => 'large',
			'small'             => 'large',
			'small_2x'          => 'large',
			'small_2x_vertical' => 'large',
		);

		/**
		 * Default layout
		 *
		 * @var string
		 */
		private $_default_layout = 'layout-1';

		/**
		 * Excerpt length
		 *
		 * @var int
		 */
		private $_excerpt_length = 55;

		/**
		 * Get excerpt length
		 *
		 * @return int
		 */
		public function get_excerpt_length() {
			return $this->_excerpt_length;
		}

		/**
		 * Featured Posts Block widget constructor.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->widget_name        = esc_html__( 'Featured Posts Block', '__tm' );
			$this->widget_description = esc_html__( 'This widget displays latest posts' );
			$this->widget_id          = 'widget-featured-posts-block';
			$this->widget_cssclass    = 'widget-featured-posts-block';

			$this->settings = array(
				'layout'         => array(
					'type'             => 'select',
					'multiple'         => false,
					'value'            => $this->_default_layout,
					'options'          => false,
					'options_callback' => array(
						$this,
						'get_layouts',
					),
					'label'            => esc_html__( 'Layout', '__tm' ),
				),
				'checkboxes'     => array(
					'type'    => 'checkbox',
					'value'   => array(
						'title'          => 'false',
						'excerpt'        => 'false',
						'categories'     => 'false',
						'tags'           => 'false',
						'author'         => 'false',
						'date'           => 'false',
						'comments_count' => 'false',
					),
					'options' => array(
						'title'          => esc_html__( 'Show post title', '__tm' ),
						'excerpt'        => esc_html__( 'Show post excerpt', '__tm' ),
						'categories'     => esc_html__( 'Show post categories', '__tm' ),
						'tags'           => esc_html__( 'Show post tags', '__tm' ),
						'author'         => esc_html__( 'Show post author', '__tm' ),
						'date'           => esc_html__( 'Show post date', '__tm' ),
						'comments_count' => esc_html__( 'Show post comments count', '__tm' ),
					),
				),
				'excerpt_length' => array(
					'type'      => 'stepper',
					'value'     => 55,
					'min_value' => 1,
					'label'     => esc_html__( 'Excerpt length', '__tm' ),
				),
			);

			parent::__construct();
		}

		/**
		 * widget function.
		 *
		 * @see   WP_Widget
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Arguments.
		 * @param array $instance Instance.
		 */
		public function widget( $args, $instance ) {
			if ( true === $this->get_cached_widget( $args ) ) {
				return;
			}

			ob_start();

			$this->setup_widget_data( $args, $instance );
			$this->widget_start( $args, $instance );

			$this->_excerpt_length = $instance['excerpt_length'];
			add_filter( 'excerpt_length', array( &$this, 'get_excerpt_length' ) );

			$template = locate_template( 'inc/widgets/tm-featured-posts-block-widget/views/main-view.php' );

			if ( ! empty( $template ) ) {
				include $template;
			}

			$this->widget_end( $args );
			$this->reset_widget_data();
			wp_reset_postdata();

			echo $this->cache_widget( $args, ob_get_clean() );
		}

		/**
		 * Render layout
		 * @return string
		 */
		public function render_layout() {
			$layout = $this->_default_layout;
			if ( $this->_validate_layout( $this->instance['layout'] ) ) {
				$layout = $this->instance['layout'];
			}

			ob_start();

			$template = locate_template( "inc/widgets/tm-featured-posts-block-widget/views/layouts/{$layout}.php" );

			if ( ! empty( $template ) ) {
				include $template;
			}

			$content = ob_get_clean();

			return $content;
		}

		/**
		 * Check if given layout exists and is valid
		 *
		 * @param string $layout Layout option value.
		 *
		 * @return bool
		 */
		private function _validate_layout( $layout ) {
			if ( ! empty( $layout ) ) {
				$layouts = $this->get_layouts();
				$keys    = array_keys( $layouts );

				return in_array( $layout, $keys );
			}

			return false;
		}

		/**
		 * Get available layouts
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function get_layouts() {
			return array(
				'layout-1' => esc_html__( 'Layout #1', '__tm' ),
				'layout-2' => esc_html__( 'Layout #2', '__tm' ),
				'layout-3' => esc_html__( 'Layout #3', '__tm' ),
				'layout-4' => esc_html__( 'Layout #4', '__tm' ),
				'layout-5' => esc_html__( 'Layout #5', '__tm' ),
			);
		}


		/**
		 * Get post categories
		 *
		 * @since 1.0.0
		 *
		 * @param array $args           Array, containing before, after, format & separator strings.
		 *                              Example:
		 *                              `array(
		 *                              'before' => '<div>',
		 *                              'after' => '</div>',
		 *                              'format' => '<a href="%1$s">%2$s</a>',
		 *                              'separator' => ','
		 *                              )`.
		 *
		 * @return string
		 */
		public function post_categories( array $args = array() ) {
			global $post;
			$result = array();

			$before    = '<div>';
			$after     = '</div>';
			$format    = '<a href="%1$s">%2$s</a>';
			$separator = ' ';

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['format'] ) &&
				false === empty( $args['format'] )
			) {
				$format = $args['format'];
			}

			if ( true === isset( $args['separator'] ) &&
				false === empty( $args['separator'] )
			) {
				$separator = $args['separator'];
			}

			$post_categories = get_the_category( $post->ID );
			if ( 0 < sizeof( $post_categories ) ) {
				array_push( $result, $before );

				foreach ( $post_categories as $category ) {
					array_push( $result, sprintf( $format, esc_attr( get_category_link( $category ) ), esc_html( $category->name ) ) );
				}

				array_push( $result, $after );
			}

			return trim( join( $separator, $result ) );
		}

		/**
		 * Get post comments count
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Array, containing before, after, has_comments and no_comments strings.
		 *
		 * @return string
		 */
		public function post_comments_count( array $args ) {
			global $post;

			$before       = '<div>';
			$after        = '</div>';
			$has_comments = '<a href="%1$s">%2$s</a>';
			$no_comments  = '<span>%2$s</span>';

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['has_comments'] ) &&
				false === empty( $args['has_comments'] )
			) {
				$has_comments = $args['has_comments'];
			}

			if ( true === isset( $args['no_comments'] ) &&
				false === empty( $args['no_comments'] )
			) {
				$no_comments = $args['no_comments'];
			}

			if ( false === comments_open( $post->ID ) ) {
				return '';
			}

			$comments_count = get_comments_number( $post->ID );

			if ( 0 < $comments_count ) {
				$format = $has_comments;
			} else {
				$format = $no_comments;
			}

			return sprintf(
				'%s%s%s',
				$before,
				sprintf( $format, get_comments_link( $post->ID ), esc_html( $comments_count ) ),
				$after
			);
		}

		/**
		 * Get post author
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Array, containing before, after, has_url & no_url strings.
		 *
		 * @return string
		 */
		public function post_author( array $args = array() ) {
			global $post;

			$before  = '<div>';
			$after   = '</div>';
			$has_url = '<a href="%1$s">%2$s</a>';
			$no_url  = '%2$s';

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['has_url'] ) &&
				false === empty( $args['has_url'] )
			) {
				$has_url = $args['has_url'];
			}

			if ( true === isset( $args['no_url'] ) &&
				false === empty( $args['no_url'] )
			) {
				$no_url = $args['no_url'];
			}

			$author_url  = get_the_author_meta( 'user_url', $post->post_author );
			$author_name = get_the_author_meta( 'display_name', $post->post_author );

			if ( false === empty( $author_url ) ) {
				$format = $has_url;
			} else {
				$format = $no_url;
			}

			return sprintf(
				'%s%s%s',
				$before,
				sprintf( $format, $author_url, $author_name ),
				$after
			);
		}

		/**
		 * Get post date
		 *
		 * @since 1.0.0
		 *
		 * @param array $args                 Array, containing before, after and format or for_human option enabled.
		 *                                    Example:
		 *                                    array(
		 *                                    'for_human' => true, // Will overwrite `format` if it's `true`
		 *                                    'format' => 'H:i:s',
		 *                                    'before' => '<a class="tm_fpblock__item__date">',
		 *                                    'after' => '</a>'
		 *                                    ).
		 *
		 * @return string
		 */
		public function post_date( array $args = array() ) {
			global $post;

			$before    = '<a>';
			$after     = '</a>';
			$format    = get_option( 'date_format' );
			$for_human = false;

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['format'] ) &&
				false === empty( $args['format'] )
			) {
				$format = $args['format'];
			}

			if ( true === isset( $args['for_human'] ) &&
				false === empty( $args['for_human'] )
			) {
				$for_human = (boolean) $args['for_human'];
			}

			if ( true === $for_human ) {
				$date = sprintf(
					_x( '%s ago', '%s ago - date when post was written', 'wi-injector' ),
					human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) )
				);
			} else {
				$date = get_the_date( $format );
				if ( empty( $date ) ) {
					$date = get_the_modified_date( $format );
				}
			}

			return sprintf( '%s%s%s', $before, $date, $after );
		}

		/**
		 * Get post tags
		 *
		 * @since 1.0.0
		 *
		 * @param array $args           Array, containing before, after, format & separator strings.
		 *                              Example:
		 *                              `array(
		 *                              'before' => '<div>',
		 *                              'after' => '</div>',
		 *                              'format' => '<a href="%1$s">%2$s</a>',
		 *                              'separator' => ','
		 *                              )`.
		 *
		 * @return string
		 */
		public function post_tags( array $args = array() ) {
			global $post;

			$result = array();

			$before    = '<div>';
			$after     = '</div>';
			$format    = '<a href="%1$s">%2$s</a>';
			$separator = ',';

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['format'] ) &&
				false === empty( $args['format'] )
			) {
				$format = $args['format'];
			}

			if ( true === isset( $args['separator'] ) &&
				false === empty( $args['separator'] )
			) {
				$separator = $args['separator'];
			}

			$post_tags = wp_get_post_tags( $post->ID );
			if ( 0 < sizeof( $post_tags ) ) {
				array_push( $result, $before );

				foreach ( $post_tags as $tag ) {
					$tag = get_tag( $tag );
					array_push( $result, sprintf( $format, esc_attr( get_tag_link( $tag ) ), esc_html( $tag->name ) ) );
				}

				array_push( $result, $after );
			}

			return join( $separator, $result );
		}
	}

	add_action( 'widgets_init', '__tm_register_featured_posts_block_widget' );

	if ( false === function_exists( '__tm_register_featured_posts_block_widget' ) ) {
		function __tm_register_featured_posts_block_widget() {
			register_widget( '__Tm_Featured_Posts_Block_Widget' );
		}
	}
}
