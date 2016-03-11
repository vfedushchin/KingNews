<?php

class KING_NEWS_Carousel_Widget extends Cherry_Abstract_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass = 'king_news widget_carousel';
		$this->widget_description = esc_html__( 'Display a list of your posts on your site.', 'king_news' );
		$this->widget_id = 'widget_carousel';
		$this->widget_name = esc_html__( 'Carousel Widget', 'king_news' );
		$this->settings = array(
			'title' => array(
				'type'  => 'text',
				'value' => esc_html__( 'Carousel', 'king_news' ),
				'label' => esc_html__( 'Title', 'king_news' ),
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
			'categories' => array(
				'type' => 'select',
				'size' => 1,
				'value' => '',
				'options_callback' => array( $this, 'get_terms_list', array( 'category', 'slug' ) ),
				'options' => false,
				'label' => esc_html__( 'Select category', 'king_news' ),
				'multiple' => true,
				'placeholder' => esc_html__( 'Select category', 'king_news' ),
			),
			'tags' => array(
				'type' => 'select',
				'size' => 1,
				'value' => '',
				'options_callback' => array( $this, 'get_terms_list', array( 'post_tag', 'slug' ) ),
				'options' => false,
				'label' => esc_html__( 'Select tags', 'king_news' ),
				'multiple' => true,
				'placeholder' => esc_html__( 'Select tags', 'king_news' ),
			),
			'posts_per_page' => array(
				'type' => 'stepper',
				'value' => 10,
				'max_value' => 20,
				'min_value' => 1,
				'label'  => esc_html__( 'Posts count', 'king_news' ),
			),
			'post_title' => array(
				'type' => 'switcher',
				'value' => 'true',
				'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
				'label' => esc_html__( 'Display title', 'king_news' ),
			),
			/*'content' => array(
				'type' => 'switcher',
				'value' => 'false',
				'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
				'label' => esc_html__( 'Display content', 'king_news' ),
			),
			'more_button' => array(
				'type' => 'switcher',
				'value' => 'false',
				'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
				'label' => esc_html__( 'Display more button', 'king_news' ),
			),
			'more_button_text' => array(
				'type'  => 'text',
				'value' => esc_html__( 'Read more', 'king_news' ),
				'label' => esc_html__( 'More button text', 'king_news' ),
			),
			'trim_words' => array(
				'type' => 'slider',
				'value' => 12,
				'max_value' => 12,
				'min_value' => 1,
				'step_value' => 1,
				'label'  => esc_html__( 'Content words trimmed count', 'king_news' ),
			),*/
			'slides_per_view' => array(
				'type'		=> 'slider',
				'max_value'	=> 4,
				'min_value'	=> 1,
				'value'		=> 4,
				'label' 	=> esc_html__( 'Number of slides per view', 'king_news' ),
			),
			'slides_per_group' => array(
				'type'		=> 'slider',
				'max_value'	=> 25,
				'min_value'	=> 1,
				'value'		=> 1,
				'label' 	=> esc_html__( 'Number slides per group', 'king_news' ),
			),
			'slides_per_column' => array(
				'type'		=> 'slider',
				'max_value'	=> 5,
				'min_value'	=> 1,
				'value'		=> 1,
				'label' 	=> esc_html__( 'Multi Row Slides Layout', 'king_news' ),
			),
			'space_between_slides' => array(
				'type'		=> 'slider',
				'max_value'	=> 100,
				'min_value'	=> 0,
				'value'		=> 30,
				'label' 	=> esc_html__( 'Width of the space between slides(px)', 'king_news' ),
			),
			'duration_speed' => array(
				'type'		=> 'slider',
				'max_value'	=> 5000,
				'min_value'	=> 100,
				'value'		=> 500,
				'label' 	=> esc_html__( 'Duration of transition between slides (ms)', 'king_news' ),
			),
			'navigation' => array(
				'type'		=> 'switcher',
				'value'		=> 'true',
				'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
				'label' 	=> esc_html__( 'Slider navigation', 'king_news' ),
			),
			'pagination' => array(
				'type'		=> 'switcher',
				'value'		=> 'true',
				'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
				'label' 	=> esc_html__( 'Slider pagination', 'king_news' ),
			),
		);

		parent::__construct();

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ), 9 );
	}


	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @since 1.0.0
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		$this->setup_widget_data( $args, $instance );
		$this->widget_start( $args, $instance );

		/**
		 * Filter the array of default settings.
		 *
		 * @since 1.0.0
		 * @param array options.
		 * @param array The 'the_slider_items' function argument.
		 */
		$default_settings = apply_filters( 'king_news_carousel_default_settings', array() );

		// Widgets area check
		if ( 'sidebar-primary' == $args['id'] || 'sidebar-secondary' == $args['id'] ) {
			$this->instance['slides_per_view'] = 1;
			$this->instance['slides_per_group'] = 1;
			$this->instance['slides_per_column'] = 1;
		}

		$footer_widget_columns = get_theme_mod( 'footer_widget_columns', king_news_theme()->customizer->get_default( 'footer_widget_columns' ) );
		if ( 'footer-area' == $args['id'] && ( '2' == $footer_widget_columns || '3' == $footer_widget_columns || '4' == $footer_widget_columns ) ) {
			$this->instance['slides_per_view'] = 1;
			$this->instance['slides_per_group'] = 1;
			$this->instance['slides_per_column'] = 1;
		}

		$instance = uniqid();

		$data_attr_line = 'class="king_news-carousel swiper-container"';
		$data_attr_line .= ' data-uniq-id="swiper-carousel-' . $instance . '"';
		$data_attr_line .= ' data-slides-per-view="' . $this->instance['slides_per_view'] . '"';
		$data_attr_line .= ' data-slides-per-group="' . $this->instance['slides_per_group'] . '"';
		$data_attr_line .= ' data-slides-per-column="' . $this->instance['slides_per_column'] . '"';
		$data_attr_line .= ' data-space-between-slides="' . $this->instance['space_between_slides'] . '"';
		$data_attr_line .= ' data-duration-speed="' . $this->instance['duration_speed']  . '"';
		$data_attr_line .= ' data-swiper-loop="false"';
		$data_attr_line .= ' data-free-mode="false"';
		$data_attr_line .= ' data-grab-cursor="true"';
		$data_attr_line .= ' data-mouse-wheel="false"';

		$swiper_pagination_html = ( 'true' == $this->instance['pagination'] ) ? '<div id="swiper-carousel-'. $instance . '-pagination" class="swiper-pagination"></div>' : '';
		$swiper_navigation_html = ( 'true' == $this->instance['navigation'] ) ? '<div id="swiper-carousel-'. $instance . '-next" class="swiper-button-next button-next"><i class="material-icons">navigate_next</i></div><div id="swiper-carousel-'. $instance . '-prev" class="swiper-button-prev button-prev"><i class="material-icons">navigate_before</i></div>' : '';

		$categories_array = ( isset( $this->instance['categories'] ) ) ? $this->instance['categories'] : array();
		$tags_array = ( isset( $this->instance['tags'] ) ) ? $this->instance['tags'] : array();

		$tax_query = array();


		if ( 'category' == $this->instance['terms_type'] ) {
			if ( ( is_array( $categories_array ) && ! empty( $categories_array ) ) ) {
				array_push( $tax_query, array(
					'taxonomy'	=> 'category',
					'field'		=> 'slug',
					'terms'		=> $categories_array,
				));
			}
		} else {
			if ( ( is_array( $tags_array ) && ! empty( $tags_array ) ) ) {
				array_push( $tax_query, array(
					'taxonomy'	=> 'post_tag',
					'field'		=> 'slug',
					'terms'		=> $tags_array,
				));
			}
		}

		// The Query.
		$posts_query = $this->get_query_slider_items( array(
			'posts_per_page'	=> $this->instance['posts_per_page'],
			'tax_query'			=> $tax_query,
		) );

		$html = '';

		if ( $posts_query ) {
			echo '<div class="swiper-carousel-container">';
				echo '<div id="swiper-carousel-' . $instance . '" ' . $data_attr_line . '>';
					echo '<div class="swiper-wrapper">';
						echo $this->get_carousel_slider_loop( $posts_query );
					echo '</div>';
					echo $swiper_pagination_html;
				echo '</div>';
				echo $swiper_navigation_html;
			echo '</div>';
		}

		$this->widget_end( $args );
		$this->reset_widget_data();
		wp_reset_postdata();

		echo $this->cache_widget( $args, ob_get_clean() );
	}

	/**
	 * Render Carousel html
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function render_carousel() {


	}

	/**
	 * Get carousel slider items.
	 *
	 * @since  1.0.0
	 * @param  array|string $args Arguments to be passed to the query.
	 * @return array|bool         Array if true, boolean if false.
	 */
	public function get_query_slider_items( $query_args = array() ) {

		$defaults_query_args = apply_filters( 'king_news_carousel_default_query_args', array(
			'post_type'      => 'post',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => -1,
			'tax_query'      => array(),
		) );

		$query_args = wp_parse_args( $query_args, $defaults_query_args );
		$query_args = array_intersect_key( $query_args, $defaults_query_args );

		// The Query.
		$posts_query = new WP_Query( $query_args );
		$this->posts_query = $posts_query;

		if ( !is_wp_error( $posts_query ) ) {
			return $posts_query;
		} else {
			return false;
		}
	}

	/**
	 * Get slider items.
	 *
	 * @since  1.0.0
	 * @param  array         $posts_query      List of WP_Post objects.
	 * @return string
	 */
	public function get_carousel_slider_loop( $posts_query ) {
		$html = '';
			if ( $posts_query->have_posts() ) {
				while ( $posts_query->have_posts() ) : $posts_query->the_post();
					$post_id = $posts_query->post->ID;
					$date = get_the_date();
					$title = get_the_title( $post_id );
					$permalink = get_permalink();

					$thumb_id = get_post_thumbnail_id();

					$placeholder_args = apply_filters( 'king_news_carousel_placeholder_args',
						array(
							'width'			=> 560,
							'height'		=> 350,
							'background'	=> '000',
							'foreground'	=> 'fff',
							'title'			=> $title,
						)
					);

					$view_dir = locate_template( 'inc/widgets/tm-carousel-widget/views/tm-carousel-view.php' );

					$image_size = apply_filters( 'king_news_carousel_image_size', '_tm-thumb-426-327' );
					$image = '<a class="post-thumbnail__link" href="' . $permalink . '">' . $this->get_image( $post_id, $image_size, $placeholder_args ) .'</a>';

					$title = ( 'true' == $this->instance['post_title'] ) ? '<h4><a href="' . $permalink . '">' . $title . '</a></h4>' : '';

					if (isset($this->instance['content'])) {
						$content = ( 'true' == $this->instance['content'] ) ? '<p class="post__excerpt">' . $this->get_trimed_content( get_the_content(), (int) $this->instance['trim_words'] ) . '</p>' : '';
					} else {
						$content = '';
					}


					if (isset($this->instance['more_button'])) {
						$more_button = ( 'true' == $this->instance['more_button'] ) ? '<a class="btn" href="' . $permalink . '">' . esc_html( $this->instance['more_button_text'] ) . '</a>' : '';
					} else {
						$more_button = '';
					}

					$date = '<a href="' . $permalink . '">' . $this->get_post_date( $post_id ) . '</a>';
					$comments = $this->get_post_comments( $post_id );
					$author = $this->get_post_author( $post_id );
					$terms_line = $this->get_terms_line( $post_id, $this->instance['terms_type'] );

					echo '<article class="swiper-slide post hentry">';
						if ( $view_dir ) {
							require( $view_dir );
						} else {
							echo '<h4>' . esc_html__( 'View file not found', 'king_news' ) . '</h4>';
						}
					echo '</article>';

				endwhile;
			} else {
				echo '<h4>' . esc_html__( 'Posts not found', 'king_news' ) . '</h4>';
			}
		// Reset the query.
		wp_reset_postdata();

		return $html;
	}

	/**
	 * Get post attached image.
	 *
	 * @since  1.0.0
	 * @param  int $id post id.
	 * @param  array, string
	 * @return string(HTML-formatted).
	 */
	public function get_image( $id, $size, $placeholder_attr, $only_url = false ) {

		// Place holder defaults attr
		$default_placeholder_attr = apply_filters( '__tm_carousel_placeholder_default_args',
			array(
				'width'      => 900,
				'height'     => 500,
				'background' => '000',
				'foreground' => 'fff',
				'title'      => '',
				'class'      => '',
			)
		);
		$placeholder_attr = wp_parse_args( $placeholder_attr, $default_placeholder_attr );
		$image = '';

		// Check the attached image, if not attached - function replaces on the placeholder
		if ( has_post_thumbnail( $id ) ) {
			$thumbnail_id = get_post_thumbnail_id( intval( $id ) );
			$attachment_image = wp_get_attachment_image_src( $thumbnail_id, $size );

			if ( $only_url ) {
				return $attachment_image[0];
			}

			$html_attrs = array(
				'class'  => 'swiper-image',
				'src'    => $attachment_image[0],
				'width'  => $attachment_image[1],
				'height' => $attachment_image[2],
				'alt'    => get_the_title(),
			);

			$image_html_attrs = $this->prepare_atts( $html_attrs );
			$image = sprintf( '<img %s>', $image_html_attrs );
		} else {
			$placeholder_link = 'http://fakeimg.pl/' . $placeholder_attr['width'] . 'x' . $placeholder_attr['height'] . '/'. $placeholder_attr['background'] .'/'. $placeholder_attr['foreground'] . '/?text=' . $placeholder_attr['title'] . '';
			$image = '<img class="sp-image ' . $placeholder_attr['class'] . '" src="' . $placeholder_link . '" alt="' . $placeholder_attr['title'] . '">';
		}
		return $image;
	}

	/**
	 * Get trimmed content
	 *
	 * @since 1.0.0
	 * @param  string  $content        Post content
	 * @param  integer $excerpt_length Post content excerptlength
	 * @return string
	 */
	public function get_trimed_content( $content = '', $excerpt_length = 55 ) {
		$trimed_content = strip_shortcodes( $content );
		$trimed_content = apply_filters( 'the_content', $trimed_content );
		$trimed_content = str_replace(']]>', ']]&gt;', $trimed_content );
		$trimed_content = wp_trim_words( $trimed_content, $excerpt_length );

		return $trimed_content;
	}

	/**
	 * Prepare HTML attributes.
	 *
	 * @since  1.0.0
	 * @param  array $atts Attributes array.
	 * @return string
	 */
	public function prepare_atts( $atts ) {

		$result = '';

		foreach ( $atts as $name => $value ) {
			$result .= $name . '="' . $value . '" ';
		}

		return $result;
	}

	/**
	 * Get post comments count and link
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_post_comments( $post_id ) {
		$post_type = get_post_type( $post_id );

		if ( post_type_supports( $post_type, 'comments' ) ) {
			$comments = ( comments_open() || get_comments_number() ) ? get_comments_number() : '';
		}

		$title_comments =  sprintf( _n( '1', '%s', $comments, 'king_news' ), $comments );
		$comments = ( ! empty( $comments ) ) ? sprintf( '<span class="post-comments-link"><a href="%1$s">%2$s</a></span>', esc_url( get_comments_link() ), $title_comments ) : esc_html__( '0', 'king_news' );

		return $comments;
	}

	/**
	 * Get post author
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_post_author( $post_id ) {

		return sprintf( '<a href="%1$s" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
	}

	/**
	 * Get post date
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_post_date( $post_id ) {
		/**
		 * Filter for post date format string
		 *
		 * @var string
		 */
		$date_format = apply_filters( 'king_news_carousel_post_dateformat', 'M d, Y' );

		return sprintf( '<time class="post-date" datetime="%1$s">%2$s</time>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date( $date_format ) ) );
	}

	/**
	 * Get blog user list array
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function get_terms_list( $tax = 'category', $key = 'slug' ) {
		if ( 'id' === $key ) {
			$all_terms = (array) get_terms( $tax, array( 'hide_empty' => false ) );

			foreach ( $all_terms as $term ) {
				$terms[ $term->term_id ] = $term->name;
			}
		} elseif ( 'slug' === $key ) {
			$all_terms = (array) get_terms( $tax, array( 'hide_empty' => false ) );
			foreach ( $all_terms as $term ) {
				$terms[ $term->slug ] = $term->name;
			}
		}

		return $terms;
	}

	/**
	 * Get terms line
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function get_terms_line( $post_id, $tax = 'category' ) {
		$terms_line = '';
		$post_taxonomy = ! is_wp_error( get_the_terms( $post_id, $tax ) ) ? get_the_terms( $post_id, $tax ) : array();

		if ( $post_taxonomy ) {
				foreach ( $post_taxonomy as $taxonomy => $taxonomy_value ) {
					$terms_line .= '<a href="' . get_term_link( $taxonomy_value->term_id, $tax ) . '">' . $taxonomy_value->name . '</a>';
				}
			return $terms_line;
		}else{
			return false;
		}
	}

	/**
	 * Enqueue javascript and stylesheet
	 *
	 * @since  1.0.0
	 */
	public function enqueue_assets() {
		wp_enqueue_style( 'jquery-swiper' );
		wp_enqueue_script( 'jquery-swiper' );
	}
}

add_action( 'widgets_init', 'tm_register_carosel_widgets' );
function tm_register_carosel_widgets() {
	register_widget( 'KING_NEWS_Carousel_Widget' );
}