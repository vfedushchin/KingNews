<?php
/**
 * __Tm Theme Customizer.
 *
 * @package __tm
 */

/**
 * Retrieve a holder for Customizer options.
 *
 * @since  1.0.0
 * @return array
 */
function __tm_get_customizer_options() {
	/**
	 * Filter a holder for Customizer options (for theme/plugin developer customization).
	 *
	 * @since 1.0.0
	 */
	return apply_filters( '__tm_get_customizer_options' , array(
		'prefix'     => '__tm',
		'capability' => 'edit_theme_options',
		'type'       => 'theme_mod',
		'options'    => array(

			/** 'Site Indentity' section */
			'show_tagline' => array(
				'title'    => esc_html__( 'Show tagline after logo', '__tm' ),
				'section'  => 'title_tagline',
				'priority' => 60,
				'default'  => false,
				'field'    => 'checkbox',
				'type'     => 'control',
			),

			/** `Logo & Favicon` section */
			'logo_favicon' => array(
				'title'       => esc_html__( 'Logo &amp; Favicon', '__tm' ),
				'description' => esc_html__( 'Description', '__tm' ),
				'priority'    => 25,
				'type'        => 'section',
			),
			'header_logo_type' => array(
				'title'   => esc_html__( 'Logo Type', '__tm' ),
				'section' => 'logo_favicon',
				'default' => 'image',
				'field'   => 'radio',
				'choices' => array(
					'image' => esc_html__( 'Image', '__tm' ),
					'text'  => esc_html__( 'Text', '__tm' ),
				),
				'type' => 'control',

			),
			'header_logo_url' => array(
				'title'           => esc_html__( 'Logo Upload', '__tm' ),
				'description'     => esc_html__( 'Logo upload description', '__tm' ),
				'section'         => 'logo_favicon',
				'default'         => get_stylesheet_directory_uri() . '/assets/images/logo.png',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => '__tm_is_header_logo_image',
			),
			'retina_header_logo_url' => array(
				'title'           => esc_html__( 'Retina Logo Upload', '__tm' ),
				'description'     => esc_html__( 'Upload logo for retina-ready devices', '__tm' ),
				'section'         => 'logo_favicon',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => '__tm_is_header_logo_image',
			),
			'header_logo_font_family' => array(
				'title'           => esc_html__( 'Font Family', '__tm' ),
				'section'         => 'logo_favicon',
				'default'         => 'Noto Sans',
				'field'           => 'fonts',
				'type'            => 'control',
				'active_callback' => '__tm_is_header_logo_text',
			),
			'header_logo_font_style' => array(
				'title'           => esc_html__( 'Font Style', '__tm' ),
				'section'         => 'logo_favicon',
				'default'         => 'normal',
				'field'           => 'select',
				'choices'         => __tm_get_font_styles(),
				'type'            => 'control',
				'active_callback' => '__tm_is_header_logo_text',
			),
			'header_logo_font_weight' => array(
				'title'           => esc_html__( 'Font Weight', '__tm' ),
				'section'         => 'logo_favicon',
				'default'         => '700',
				'field'           => 'select',
				'choices'         => __tm_get_font_weight(),
				'type'            => 'control',
				'active_callback' => '__tm_is_header_logo_text',
			),
			'header_logo_font_size' => array(
				'title'           => esc_html__( 'Font Size, px', '__tm' ),
				'section'         => 'logo_favicon',
				'default'         => '26',
				'field'           => 'number',
				'input_attrs'     => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'            => 'control',
				'active_callback' => '__tm_is_header_logo_text',
			),
			'header_logo_character_set' => array(
				'title'           => esc_html__( 'Character Set', '__tm' ),
				'section'         => 'logo_favicon',
				'default'         => 'latin',
				'field'           => 'select',
				'choices'         => __tm_get_character_sets(),
				'type'            => 'control',
				'active_callback' => '__tm_is_header_logo_text',
			),
			'page_preloader' => array(
				'title'    => esc_html__( 'Show preloader when open a page', '__tm' ),
				'section'  => 'logo_favicon',
				'priority' => 75,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),

			/** `Breadcrumbs` section */
			'breadcrumbs' => array(
				'title'    => esc_html__( 'Breadcrumbs', '__tm' ),
				'priority' => 30,
				'type'     => 'section',
			),
			'breadcrumbs_path_type' => array(
				'title'   => esc_html__( 'Show full/minified breadcrumbs path', '__tm' ),
				'section' => 'breadcrumbs',
				'default' => 'full',
				'field'   => 'select',
				'choices' => array(
					'full'     => esc_html__( 'Full', '__tm' ),
					'minified' => esc_html__( 'Minified', '__tm' ),
				),
				'type'    => 'control',
			),
			'breadcrumbs_page_title' => array(
				'title'   => esc_html__( 'Enable page title in breadcrumbs area', '__tm' ),
				'section' => 'breadcrumbs',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs', '__tm' ),
				'section' => 'breadcrumbs',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Color Scheme` panel */
			'color_scheme' => array(
				'title'       => esc_html__( 'Color Scheme', '__tm' ),
				'description' => esc_html__( 'Configure Color Scheme', '__tm' ),
				'priority'    => 40,
				'type'        => 'panel',
			),

			/** `Regular scheme` section */
			'regular_scheme' => array(
				'title'       => esc_html__( 'Regular scheme', '__tm' ),
				'description' => esc_html__( 'Some description for the options in the Regular scheme', '__tm' ),
				'priority'    => 1,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'regular_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#02afff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#fff602',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_3' => array(
				'title'   => esc_html__( 'Accent color (3)', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#eef4fa',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_text_color' => array(
				'title'   => esc_html__( 'Text color', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_color' => array(
				'title'   => esc_html__( 'Link color', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h1_color' => array(
				'title'   => esc_html__( 'H1 color', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h2_color' => array(
				'title'   => esc_html__( 'H2 color', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h3_color' => array(
				'title'   => esc_html__( 'H3 color', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h4_color' => array(
				'title'   => esc_html__( 'H4 color', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h5_color' => array(
				'title'   => esc_html__( 'H5 color', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h6_color' => array(
				'title'   => esc_html__( 'H6 color', '__tm' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Invert scheme` section */
			'invert_scheme' => array(
				'title'       => esc_html__( 'Invert scheme', '__tm' ),
				'description' => esc_html__( 'Some description for the options in the Invert scheme', '__tm' ),
				'priority'    => 1,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'invert_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_accent_color_3' => array(
				'title'   => esc_html__( 'Accent color (3)', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_text_color' => array(
				'title'   => esc_html__( 'Text color', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_color' => array(
				'title'   => esc_html__( 'Link color', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h1_color' => array(
				'title'   => esc_html__( 'H1 color', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h2_color' => array(
				'title'   => esc_html__( 'H2 color', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h3_color' => array(
				'title'   => esc_html__( 'H3 color', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h4_color' => array(
				'title'   => esc_html__( 'H4 color', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h5_color' => array(
				'title'   => esc_html__( 'H5 color', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h6_color' => array(
				'title'   => esc_html__( 'H6 color', '__tm' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Typography Settings` panel */
			'typography' => array(
				'title'       => esc_html__( 'Typography', '__tm' ),
				'description' => esc_html__( 'Configure typography settings', '__tm' ),
				'priority'    => 45,
				'type'        => 'panel',
			),

			/** `Body text` section */
			'body_typography' => array(
				'title'       => esc_html__( 'Body text', '__tm' ),
				'description' => esc_html__( 'Some description for the options in the Body text', '__tm' ),
				'priority'    => 5,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'body_font_family' => array(
				'title'   => esc_html__( 'Font Family', '__tm' ),
				'section' => 'body_typography',
				'default' => 'Noto Sans',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'body_font_style' => array(
				'title'   => esc_html__( 'Font Style', '__tm' ),
				'section' => 'body_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => __tm_get_font_styles(),
				'type'    => 'control',
			),
			'body_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', '__tm' ),
				'section' => 'body_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => __tm_get_font_weight(),
				'type'    => 'control',
			),
			'body_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', '__tm' ),
				'section'     => 'body_typography',
				'default'     => '14',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_line_height' => array(
				'title'       => esc_html__( 'Line Height', '__tm' ),
				'description' => esc_html__( 'Relative to the font-size of the element', '__tm' ),
				'section'     => 'body_typography',
				'default'     => '1.5',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'body_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', '__tm' ),
				'section'     => 'body_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_character_set' => array(
				'title'   => esc_html__( 'Character Set', '__tm' ),
				'section' => 'body_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => __tm_get_character_sets(),
				'type'    => 'control',
			),
			'body_text_align' => array(
				'title'   => esc_html__( 'Text Align', '__tm' ),
				'section' => 'body_typography',
				'default' => 'left',
				'field'   => 'select',
				'choices' => __tm_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H1 Heading` section */
			'h1_typography' => array(
				'title'       => esc_html__( 'H1 Heading', '__tm' ),
				'description' => esc_html__( 'Some description for the options in the H1 Heading', '__tm' ),
				'priority'    => 10,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h1_font_family' => array(
				'title'   => esc_html__( 'Font Family', '__tm' ),
				'section' => 'h1_typography',
				'default' => 'Noto Sans',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h1_font_style' => array(
				'title'   => esc_html__( 'Font Style', '__tm' ),
				'section' => 'h1_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => __tm_get_font_styles(),
				'type'    => 'control',
			),
			'h1_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', '__tm' ),
				'section' => 'h1_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => __tm_get_font_weight(),
				'type'    => 'control',
			),
			'h1_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', '__tm' ),
				'section'     => 'h1_typography',
				'default'     => '50',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_line_height' => array(
				'title'       => esc_html__( 'Line Height', '__tm' ),
				'description' => esc_html__( 'Relative to the font-size of the element', '__tm' ),
				'section'     => 'h1_typography',
				'default'     => '1.1',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h1_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', '__tm' ),
				'section'     => 'h1_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_character_set' => array(
				'title'   => esc_html__( 'Character Set', '__tm' ),
				'section' => 'h1_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => __tm_get_character_sets(),
				'type'    => 'control',
			),
			'h1_text_align' => array(
				'title'   => esc_html__( 'Text Align', '__tm' ),
				'section' => 'h1_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => __tm_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H2 Heading` section */
			'h2_typography' => array(
				'title'       => esc_html__( 'H2 Heading', '__tm' ),
				'description' => esc_html__( 'Some description for the options in the H2 Heading', '__tm' ),
				'priority'    => 15,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h2_font_family' => array(
				'title'   => esc_html__( 'Font Family', '__tm' ),
				'section' => 'h2_typography',
				'default' => 'Noto Serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h2_font_style' => array(
				'title'   => esc_html__( 'Font Style', '__tm' ),
				'section' => 'h2_typography',
				'default' => 'italic',
				'field'   => 'select',
				'choices' => __tm_get_font_styles(),
				'type'    => 'control',
			),
			'h2_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', '__tm' ),
				'section' => 'h2_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => __tm_get_font_weight(),
				'type'    => 'control',
			),
			'h2_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', '__tm' ),
				'section'     => 'h2_typography',
				'default'     => '40',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_line_height' => array(
				'title'       => esc_html__( 'Line Height', '__tm' ),
				'description' => esc_html__( 'Relative to the font-size of the element', '__tm' ),
				'section'     => 'h2_typography',
				'default'     => '1.1',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h2_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', '__tm' ),
				'section'     => 'h2_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_character_set' => array(
				'title'   => esc_html__( 'Character Set', '__tm' ),
				'section' => 'h2_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => __tm_get_character_sets(),
				'type'    => 'control',
			),
			'h2_text_align' => array(
				'title'   => esc_html__( 'Text Align', '__tm' ),
				'section' => 'h2_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => __tm_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H3 Heading` section */
			'h3_typography' => array(
				'title'       => esc_html__( 'H3 Heading', '__tm' ),
				'description' => esc_html__( 'Some description for the options in the H3 Heading', '__tm' ),
				'priority'    => 20,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h3_font_family' => array(
				'title'   => esc_html__( 'Font Family', '__tm' ),
				'section' => 'h3_typography',
				'default' => 'Noto Sans',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h3_font_style' => array(
				'title'   => esc_html__( 'Font Style', '__tm' ),
				'section' => 'h3_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => __tm_get_font_styles(),
				'type'    => 'control',
			),
			'h3_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', '__tm' ),
				'section' => 'h3_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => __tm_get_font_weight(),
				'type'    => 'control',
			),
			'h3_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', '__tm' ),
				'section'     => 'h3_typography',
				'default'     => '30',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_line_height' => array(
				'title'       => esc_html__( 'Line Height', '__tm' ),
				'description' => esc_html__( 'Relative to the font-size of the element', '__tm' ),
				'section'     => 'h3_typography',
				'default'     => '1.2',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h3_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', '__tm' ),
				'section'     => 'h3_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_character_set' => array(
				'title'   => esc_html__( 'Character Set', '__tm' ),
				'section' => 'h3_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => __tm_get_character_sets(),
				'type'    => 'control',
			),
			'h3_text_align' => array(
				'title'   => esc_html__( 'Text Align', '__tm' ),
				'section' => 'h3_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => __tm_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H4 Heading` section */
			'h4_typography' => array(
				'title'       => esc_html__( 'H4 Heading', '__tm' ),
				'description' => esc_html__( 'Some description for the options in the H4 Heading', '__tm' ),
				'priority'    => 25,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h4_font_family' => array(
				'title'   => esc_html__( 'Font Family', '__tm' ),
				'section' => 'h4_typography',
				'default' => 'Noto Serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h4_font_style' => array(
				'title'   => esc_html__( 'Font Style', '__tm' ),
				'section' => 'h4_typography',
				'default' => 'italic',
				'field'   => 'select',
				'choices' => __tm_get_font_styles(),
				'type'    => 'control',
			),
			'h4_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', '__tm' ),
				'section' => 'h4_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => __tm_get_font_weight(),
				'type'    => 'control',
			),
			'h4_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', '__tm' ),
				'section'     => 'h4_typography',
				'default'     => '30',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_line_height' => array(
				'title'       => esc_html__( 'Line Height', '__tm' ),
				'description' => esc_html__( 'Relative to the font-size of the element', '__tm' ),
				'section'     => 'h4_typography',
				'default'     => '1.3',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h4_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', '__tm' ),
				'section'     => 'h4_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_character_set' => array(
				'title'   => esc_html__( 'Character Set', '__tm' ),
				'section' => 'h4_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => __tm_get_character_sets(),
				'type'    => 'control',
			),
			'h4_text_align' => array(
				'title'   => esc_html__( 'Text Align', '__tm' ),
				'section' => 'h4_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => __tm_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H5 Heading` section */
			'h5_typography' => array(
				'title'       => esc_html__( 'H5 Heading', '__tm' ),
				'description' => esc_html__( 'Some description for the options in the H5 Heading', '__tm' ),
				'priority'    => 30,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h5_font_family' => array(
				'title'   => esc_html__( 'Font Family', '__tm' ),
				'section' => 'h5_typography',
				'default' => 'Noto Sans',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h5_font_style' => array(
				'title'   => esc_html__( 'Font Style', '__tm' ),
				'section' => 'h5_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => __tm_get_font_styles(),
				'type'    => 'control',
			),
			'h5_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', '__tm' ),
				'section' => 'h5_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => __tm_get_font_weight(),
				'type'    => 'control',
			),
			'h5_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', '__tm' ),
				'section'     => 'h5_typography',
				'default'     => '20',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_line_height' => array(
				'title'       => esc_html__( 'Line Height', '__tm' ),
				'description' => esc_html__( 'Relative to the font-size of the element', '__tm' ),
				'section'     => 'h5_typography',
				'default'     => '1.4',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h5_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', '__tm' ),
				'section'     => 'h5_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_character_set' => array(
				'title'   => esc_html__( 'Character Set', '__tm' ),
				'section' => 'h5_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => __tm_get_character_sets(),
				'type'    => 'control',
			),
			'h5_text_align' => array(
				'title'   => esc_html__( 'Text Align', '__tm' ),
				'section' => 'h5_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => __tm_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H6 Heading` section */
			'h6_typography' => array(
				'title'       => esc_html__( 'H6 Heading', '__tm' ),
				'description' => esc_html__( 'Some description for the options in the H6 Heading', '__tm' ),
				'priority'    => 35,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h6_font_family' => array(
				'title'   => esc_html__( 'Font Family', '__tm' ),
				'section' => 'h6_typography',
				'default' => 'Noto Sans',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h6_font_style' => array(
				'title'   => esc_html__( 'Font Style', '__tm' ),
				'section' => 'h6_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => __tm_get_font_styles(),
				'type'    => 'control',
			),
			'h6_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', '__tm' ),
				'section' => 'h6_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => __tm_get_font_weight(),
				'type'    => 'control',
			),
			'h6_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', '__tm' ),
				'section'     => 'h6_typography',
				'default'     => '16',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_line_height' => array(
				'title'       => esc_html__( 'Line Height', '__tm' ),
				'description' => esc_html__( 'Relative to the font-size of the element', '__tm' ),
				'section'     => 'h6_typography',
				'default'     => '1.4',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h6_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', '__tm' ),
				'section'     => 'h6_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_character_set' => array(
				'title'   => esc_html__( 'Character Set', '__tm' ),
				'section' => 'h6_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => __tm_get_character_sets(),
				'type'    => 'control',
			),
			'h6_text_align' => array(
				'title'   => esc_html__( 'Text Align', '__tm' ),
				'section' => 'h6_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => __tm_get_text_aligns(),
				'type'    => 'control',
			),

			/** `Social links` section */
			'social_links' => array(
				'title'       => esc_html__( 'Social links', '__tm' ),
				'description' => esc_html__( 'Some description', '__tm' ),
				'priority'    => 50,
				'type'        => 'section',
			),
			'header_social_links' => array(
				'title'   => esc_html__( 'Show social links in header', '__tm' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_social_links' => array(
				'title'   => esc_html__( 'Show social links in footer', '__tm' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'post_share_buttons' => array(
				'title'   => esc_html__( 'Add social sharing to blog posts', '__tm' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Page Layout` section */
			'page_layout' => array(
				'title'       => esc_html__( 'Page Layout', '__tm' ),
				'description' => esc_html__( 'Some description', '__tm' ),
				'priority'    => 55,
				'type'        => 'section',
			),
			'page_layout_type' => array(
				'title'   => esc_html__( 'Type', '__tm' ),
				'section' => 'page_layout',
				'default' => '',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', '__tm' ),
					'fullwidth' => esc_html__( 'Fullwidth', '__tm' ),
				),
				'type' => 'control',
			),
			'container_width' => array(
				'title'       => esc_html__( 'Container width (px)', '__tm' ),
				'section'     => 'page_layout',
				'default'     => 1758,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 960,
					'max'  => 1920,
					'step' => 1,
				),
				'type' => 'control',
			),
			'sidebar_width' => array(
				'title'   => esc_html__( 'Sidebar width', '__tm' ),
				'section' => 'page_layout',
				'default' => '1/3',
				'field'   => 'select',
				'choices' => array(
					'1/3' => '1/3',
					'1/4' => '1/4',
				),
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'control',
			),

			/** `Header` panel */
			'header_options' => array(
				'title'       => esc_html__( 'Header', '__tm' ),
				'description' => esc_html__( 'Some description', '__tm' ),
				'priority'    => 60,
				'type'        => 'panel',
			),

			/** `Header styles` section */
			'header_styles' => array(
				'title'       => esc_html__( 'Header Styles', '__tm' ),
				'description' => esc_html__( 'Some description', '__tm' ),
				'priority'    => 5,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_bg_color' => array(
				'title'   => esc_html__( 'Background Color', '__tm' ),
				'section' => 'header_styles',
				'field'   => 'hex_color',
				'default' => '#ffffff',
				'type'    => 'control',
			),
			'header_bg_image' => array(
				'title'   => esc_html__( 'Background Image', '__tm' ),
				'section' => 'header_styles',
				'field'   => 'image',
				'type'    => 'control',
			),
			'header_bg_repeat' => array(
				'title'   => esc_html__( 'Background Repeat', '__tm' ),
				'section' => 'header_styles',
				'default' => 'repeat',
				'field'   => 'select',
				'choices' => array(
					'no-repeat'  => esc_html__( 'No Repeat', '__tm' ),
					'repeat'     => esc_html__( 'Tile', '__tm' ),
					'repeat-x'   => esc_html__( 'Tile Horizontally', '__tm' ),
					'repeat-y'   => esc_html__( 'Tile Vertically', '__tm' ),
				),
				'type' => 'control',
			),
			'header_bg_position_x' => array(
				'title'   => esc_html__( 'Background Position', '__tm' ),
				'section' => 'header_styles',
				'default' => 'center',
				'field'   => 'select',
				'choices' => array(
					'left'   => esc_html__( 'Left', '__tm' ),
					'center' => esc_html__( 'Center', '__tm' ),
					'right'  => esc_html__( 'Right', '__tm' ),
				),
				'type' => 'control',
			),
			'header_bg_attachment' => array(
				'title'   => esc_html__( 'Background Attachment', '__tm' ),
				'section' => 'header_styles',
				'default' => 'scroll',
				'field'   => 'select',
				'choices' => array(
					'scroll' => esc_html__( 'Scroll', '__tm' ),
					'fixed'  => esc_html__( 'Fixed', '__tm' ),
				),
				'type' => 'control',
			),
			'header_layout_type' => array(
				'title'   => esc_html__( 'Layout', '__tm' ),
				'section' => 'header_styles',
				'default' => 'minimal',
				'field'   => 'select',
				'choices' => array(
					'minimal'  => esc_html__( 'Minimal', '__tm' ),
					'centered' => esc_html__( 'Centered', '__tm' ),
					'default'  => esc_html__( 'Default', '__tm' ),
				),
				'type' => 'control',
			),

			/** `Top Panel` section */
			'header_top_panel' => array(
				'title'       => esc_html__( 'Top Panel', '__tm' ),
				'description' => esc_html__( 'Some description', '__tm' ),
				'priority'    => 10,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'top_panel_text' => array(
				'title'       => esc_html__( 'Disclaimer Text', '__tm' ),
				'description' => esc_html__( 'HTML formatting support', '__tm' ),
				'section'     => 'header_top_panel',
				'default'     => __tm_get_default_top_panel_text(),
				'field'       => 'textarea',
				'type'        => 'control',
			),
			'top_panel_search' => array(
				'title'   => esc_html__( 'Enable search', '__tm' ),
				'section' => 'header_top_panel',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'top_panel_bg' => array(
				'title'   => esc_html__( 'Background color', '__tm' ),
				'section' => 'header_top_panel',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Main Menu` section */
			'header_main_menu' => array(
				'title'       => esc_html__( 'Main Menu', '__tm' ),
				'description' => esc_html__( 'Some description', '__tm' ),
				'priority'    => 15,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_menu_sticky' => array(
				'title'   => esc_html__( 'Enable sticky menu', '__tm' ),
				'section' => 'header_main_menu',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_menu_attributes' => array(
				'title'   => esc_html__( 'Enable title attributes', '__tm' ),
				'section' => 'header_main_menu',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Sidebar` section */
			'sidebar_settings' => array(
				'title'    => esc_html__( 'Sidebar', '__tm' ),
				'priority' => 105,
				'type'     => 'section',
			),
			'sidebar_position' => array(
				'title'   => esc_html__( 'Sidebar Position', '__tm' ),
				'section' => 'sidebar_settings',
				'default' => 'one-right-sidebar',
				'field'   => 'select',
				'choices' => array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', '__tm' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', '__tm' ),
					'two-sidebars'      => esc_html__( '2 sidebars', '__tm' ),
					'fullwidth'         => esc_html__( 'No sidebars', '__tm' ),
				),
				'type' => 'control',
			),

			/** `Footer` panel */
			'footer_options' => array(
				'title'       => esc_html__( 'Footer', '__tm' ),
				'description' => esc_html__( 'Some description', '__tm' ),
				'priority'    => 110,
				'type'        => 'section',
			),
			'footer_logo_url' => array(
				'title'   => esc_html__( 'Logo upload', '__tm' ),
				'section' => 'footer_options',
				'field'   => 'image',
				'default' => get_stylesheet_directory_uri() . '/assets/images/footer-logo.png',
				'type'    => 'control',
			),
			'footer_copyright' => array(
				'title'   => esc_html__( 'Copyright text', '__tm' ),
				'section' => 'footer_options',
				'default' => __tm_get_default_footer_copyright(),
				'field'   => 'textarea',
				'type'    => 'control',
			),
			'footer_widget_columns' => array(
				'title'   => esc_html__( 'Widget Area Columns', '__tm' ),
				'section' => 'footer_options',
				'default' => '3',
				'field'   => 'select',
				'choices' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'type' => 'control'
			),
			'footer_layout_type' => array(
				'title'   => esc_html__( 'Layout', '__tm' ),
				'section' => 'footer_options',
				'default' => 'default',
				'field'   => 'select',
				'choices' => array(
					'default'  => esc_html__( 'Default', '__tm' ),
					'centered' => esc_html__( 'Centered', '__tm' ),
					'minimal'  => esc_html__( 'Minimal', '__tm' ),
				),
				'type' => 'control'
			),
			'footer_widgets_bg' => array(
				'title'   => esc_html__( 'Footer Widgets Area color', '__tm' ),
				'section' => 'footer_options',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'footer_bg' => array(
				'title'   => esc_html__( 'Footer Background color', '__tm' ),
				'section' => 'footer_options',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Blog Settings` panel */
			'blog_settings' => array(
				'title'       => esc_html__( 'Blog Settings', '__tm' ),
				'description' => esc_html__( 'Some description', '__tm' ),
				'priority'    => 115,
				'type'        => 'panel',
			),

			/** `Blog` section */
			'blog' => array(
				'title'           => esc_html__( 'Blog', '__tm' ),
				'description'     => esc_html__( 'Some description', '__tm' ),
				'panel'           => 'blog_settings',
				'priority'        => 10,
				'type'            => 'section',
				'active_callback' => 'is_home',
			),
			'blog_title' => array(
				'title'   => __( 'Title', '__tm' ),
				'section' => 'blog',
				'field'   => 'text',
				'type'    => 'control',
			),
			'blog_layout_type' => array(
				'title'   => esc_html__( 'Layout', '__tm' ),
				'section' => 'blog',
				'default' => 'default',
				'field'   => 'select',
				'choices' => array(
					'default'        => esc_html__( 'Default', '__tm' ),
					'grid-2-cols'    => esc_html__( 'Grid (2 Columns)', '__tm' ),
					'grid-3-cols'    => esc_html__( 'Grid (3 Columns)', '__tm' ),
					'masonry-2-cols' => esc_html__( 'Masonry (2 Columns)', '__tm' ),
					'masonry-3-cols' => esc_html__( 'Masonry (3 Columns)', '__tm' ),
				),
				'type' => 'control'
			),
			'blog_sticky_label' => array(
				'title'       => __( 'Featured Post Label', '__tm' ),
				'description' => __( 'Label for sticky post.', '__tm' ),
				'section'     => 'blog',
				'default'     => 'icon:material:star_border',
				'field'       => 'text',
				'type'        => 'control',
			),
			'blog_posts_content' => array(
				'title'   => esc_html__( 'Post content', '__tm' ),
				'section' => 'blog',
				'default' => 'excerpt',
				'field'   => 'select',
				'choices' => array(
					'excerpt' => esc_html__( 'Only excerpt', '__tm' ),
					'full'    => esc_html__( 'Full content', '__tm' ),
				),
				'type' => 'control'
			),
			'blog_featured_image' => array(
				'title'   => esc_html__( 'Featured image', '__tm' ),
				'section' => 'blog',
				'default' => 'ultra-small',
				'field'   => 'select',
				'choices' => array(
					'ultra-small'     => esc_html__( 'ultra-small', '__tm' ),
					'small'     => esc_html__( 'Small', '__tm' ),
					'fullwidth' => esc_html__( 'Fullwidth', '__tm' ),
				),
				'type' => 'control'
			),
			'blog_read_more_text' => array(
				'title'   => __( 'Read More button text', '__tm' ),
				'section' => 'blog',
				'default' => __( 'Read more', '__tm' ),
				'field'   => 'text',
				'type'    => 'control',
			),
			'blog_post_author' => array(
				'title'   => __( 'Show post author', '__tm' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_publish_date' => array(
				'title'   => __( 'Show publish date', '__tm' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_categories' => array(
				'title'   => __( 'Show categories', '__tm' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_tags' => array(
				'title'   => __( 'Show tags', '__tm' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_comments' => array(
				'title'   => __( 'Show comments', '__tm' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Post` section */
			'blog_post' => array(
				'title'           => esc_html__( 'Post', '__tm' ),
				'description'     => esc_html__( 'Some description', '__tm' ),
				'panel'           => 'blog_settings',
				'priority'        => 20,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'single_post_author' => array(
				'title'   => __( 'Show post author', '__tm' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_publish_date' => array(
				'title'   => __( 'Show publish date', '__tm' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_categories' => array(
				'title'   => __( 'Show categories', '__tm' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_tags' => array(
				'title'   => __( 'Show tags', '__tm' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_comments' => array(
				'title'   => __( 'Show comments', '__tm' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_author_block' => array(
				'title'   => __( 'Enable the author block after each post', '__tm' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'mailchimp' => array(
				'title'       => esc_html__( 'MailChimp', '__tm' ),
				'description' => esc_html__( 'Setup MailChimp settings for subscribe widget', '__tm' ),
				'priority'    => 109,
				'type'        => 'section',
			),
			'mailchimp_api_key' => array(
				'title'   => __( 'MailChimp API key', '__tm' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
			),
			'mailchimp_list_id' => array(
				'title'   => __( 'MailChimp list ID', '__tm' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
			),
	) ) );
}

/**
 * Return true if logo in header has image type. Otherwise - return false.
 *
 * @param  object $control
 * @return bool
 */
function __tm_is_header_logo_image( $control ) {

	if ( $control->manager->get_setting( 'header_logo_type' )->value() == 'image' ) {
		return true;
	}

	return false;
}

/**
 * Return true if logo in header has text type. Otherwise - return false.
 *
 * @param  object $control
 * @return bool
 */
function __tm_is_header_logo_text( $control ) {

	if ( $control->manager->get_setting( 'header_logo_type' )->value() == 'text' ) {
		return true;
	}

	return false;
}

// Move native `site_icon` control (based on WordPress core) in custom section.
add_action( 'customize_register', '__tm_customizer_change_core_controls', 20 );
function __tm_customizer_change_core_controls( $wp_customize ) {
	$wp_customize->get_control( 'site_icon' )->section = '__tm_logo_favicon';
}

////////////////////////////////////
// Typography utility function    //
////////////////////////////////////
function __tm_get_font_styles() {
	return apply_filters( '__tm_get_font_styles', array(
		'normal'  => esc_html__( 'Normal', '__tm' ),
		'italic'  => esc_html__( 'Italic', '__tm' ),
		'oblique' => esc_html__( 'Oblique', '__tm' ),
		'inherit' => esc_html__( 'Inherit', '__tm' ),
	) );
}

function __tm_get_character_sets() {
	return apply_filters( '__tm_get_character_sets', array(
		'latin'        => esc_html__( 'Latin', '__tm' ),
		'greek'        => esc_html__( 'Greek', '__tm' ),
		'greek-ext'    => esc_html__( 'Greek Extended', '__tm' ),
		'vietnamese'   => esc_html__( 'Vietnamese', '__tm' ),
		'cyrillic-ext' => esc_html__( 'Cyrillic Extended', '__tm' ),
		'latin-ext'    => esc_html__( 'Latin Extended', '__tm' ),
		'cyrillic'     => esc_html__( 'Cyrillic', '__tm' ),
	) );
}

function __tm_get_text_aligns() {
	return apply_filters( '__tm_get_text_aligns', array(
		'inherit' => esc_html__( 'Inherit', '__tm' ),
		'center'  => esc_html__( 'Center', '__tm' ),
		'justify' => esc_html__( 'Justify', '__tm' ),
		'left'    => esc_html__( 'Left', '__tm' ),
		'right'   => esc_html__( 'Right', '__tm' ),
	) );
}

function __tm_get_font_weight() {
	return apply_filters( '__tm_get_font_weight', array(
		'normal' => esc_html__( 'Normal', '__tm' ),
		'bold'   => esc_html__( 'Bold', '__tm' ),
		'100'    => '100',
		'200'    => '200',
		'300'    => '300',
		'400'    => '400',
		'500'    => '500',
		'600'    => '600',
		'700'    => '700',
		'800'    => '800',
		'900'    => '900',
	) );
}

/**
 * Return array of arguments for dynamic CSS module
 *
 * @return array
 */
function __tm_get_dynamic_css_options() {
	return apply_filters( '__tm_get_dynamic_css_options', array(
		'prefix'    => '__tm',
		'type'      => 'theme_mod',
		'single'    => true,
		'css_files' => array(
			__TM_THEME_DIR . '/assets/css/dynamic.css',
			__TM_THEME_DIR . '/assets/css/dynamic/widgets/taxonomy-tiles.css',
			__TM_THEME_DIR . '/assets/css/dynamic/widgets/image-grid.css',
			__TM_THEME_DIR . '/assets/css/dynamic/widgets/carousel.css',
			__TM_THEME_DIR . '/assets/css/dynamic/widgets/smart-slider.css',
			__TM_THEME_DIR . '/assets/css/dynamic/widgets/instagram.css',
			__TM_THEME_DIR . '/assets/css/dynamic/widgets/track-kickstarter.css',
			__TM_THEME_DIR . '/assets/css/dynamic/site/top-panel.css',
			__TM_THEME_DIR . '/assets/css/dynamic/site/search-form.css',
			__TM_THEME_DIR . '/assets/css/dynamic/site/social.css',
			__TM_THEME_DIR . '/assets/css/dynamic/site/main-navigation.css',
			__TM_THEME_DIR . '/assets/css/dynamic/site/footer.css',
			__TM_THEME_DIR . '/assets/css/dynamic/site/elements.css',
			__TM_THEME_DIR . '/assets/css/dynamic/site/post.css',
			__TM_THEME_DIR . '/assets/css/dynamic/site/pagination.css',
		),
		'options'   => array(
			'header_logo_font_style',
			'header_logo_font_weight',
			'header_logo_font_size',
			'header_logo_font_family',

			'body_font_style',
			'body_font_weight',
			'body_font_size',
			'body_line_height',
			'body_font_family',
			'body_letter_spacing',
			'body_text_align',

			'h1_font_style',
			'h1_font_weight',
			'h1_font_size',
			'h1_line_height',
			'h1_font_family',
			'h1_letter_spacing',
			'h1_text_align',

			'h2_font_style',
			'h2_font_weight',
			'h2_font_size',
			'h2_line_height',
			'h2_font_family',
			'h2_letter_spacing',
			'h2_text_align',

			'h3_font_style',
			'h3_font_weight',
			'h3_font_size',
			'h3_line_height',
			'h3_font_family',
			'h3_letter_spacing',
			'h3_text_align',

			'h4_font_style',
			'h4_font_weight',
			'h4_font_size',
			'h4_line_height',
			'h4_font_family',
			'h4_letter_spacing',
			'h4_text_align',

			'h5_font_style',
			'h5_font_weight',
			'h5_font_size',
			'h5_line_height',
			'h5_font_family',
			'h5_letter_spacing',
			'h5_text_align',

			'h6_font_style',
			'h6_font_weight',
			'h6_font_size',
			'h6_line_height',
			'h6_font_family',
			'h6_letter_spacing',
			'h6_text_align',

			'regular_accent_color_1',
			'regular_accent_color_2',
			'regular_accent_color_3',
			'regular_text_color',
			'regular_link_color',
			'regular_link_hover_color',
			'regular_h1_color',
			'regular_h2_color',
			'regular_h3_color',
			'regular_h4_color',
			'regular_h5_color',
			'regular_h6_color',

			'invert_accent_color_1',
			'invert_accent_color_2',
			'invert_accent_color_3',
			'invert_text_color',
			'invert_link_color',
			'invert_link_hover_color',
			'invert_h1_color',
			'invert_h2_color',
			'invert_h3_color',
			'invert_h4_color',
			'invert_h5_color',
			'invert_h6_color',

			'header_bg_color',
			'header_bg_image',
			'header_bg_repeat',
			'header_bg_position_x',
			'header_bg_attachment',

			'top_panel_bg',

			'container_width',

			'footer_widgets_bg',
			'footer_bg',
		)
	) );
}

/**
 * Return array of arguments for Google Fonta loader module
 *
 * @return array
 */
function __tm_get_fonts_options() {
	return apply_filters( '__tm_get_fonts_options', array(
		'prefix'  => '__tm',
		'type'    => 'theme_mod',
		'single'  => true,
		'options' => array(
			'body' => array(
				'family'  => 'body_font_family',
				'style'   => 'body_font_style',
				'weight'  => 'body_font_weight',
				'charset' => 'body_character_set',
			),
			'h1' => array(
				'family'  => 'h1_font_family',
				'style'   => 'h1_font_style',
				'weight'  => 'h1_font_weight',
				'charset' => 'h1_character_set',
			),
			'h2' => array(
				'family'  => 'h2_font_family',
				'style'   => 'h2_font_style',
				'weight'  => 'h2_font_weight',
				'charset' => 'h2_character_set',
			),
			'h3' => array(
				'family'  => 'h3_font_family',
				'style'   => 'h3_font_style',
				'weight'  => 'h3_font_weight',
				'charset' => 'h3_character_set',
			),
			'h4' => array(
				'family'  => 'h4_font_family',
				'style'   => 'h4_font_style',
				'weight'  => 'h4_font_weight',
				'charset' => 'h4_character_set',
			),
			'h5' => array(
				'family'  => 'h5_font_family',
				'style'   => 'h5_font_style',
				'weight'  => 'h5_font_weight',
				'charset' => 'h5_character_set',
			),
			'h6' => array(
				'family'  => 'h6_font_family',
				'style'   => 'h6_font_style',
				'weight'  => 'h6_font_weight',
				'charset' => 'h6_character_set',
			),
			'header_logo' => array(
				'family'  => 'header_logo_font_family',
				'style'   => 'header_logo_font_style',
				'weight'  => 'header_logo_font_weight',
				'charset' => 'header_logo_character_set',
			),
		)
	) );
}

/**
 * Get default top panel text
 *
 * @since  1.0.0
 * @return string
 */
function __tm_get_default_top_panel_text() {
	return 'Wednesday Jan.20, 2016 %%date%%';
}

/**
 * Get default footer copyright.
 *
 * @since  1.0.0
 * @return string
 */
function __tm_get_default_footer_copyright() {
	return '%%year%% News King, Inc. All Rights Reserved.';
}
