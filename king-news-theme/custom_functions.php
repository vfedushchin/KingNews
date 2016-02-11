<?php

function __tm_val_enqueue_styles_scripts() { 
	//wp_enqueue_style('gfonts', '//fonts.googleapis.com/css?family=Roboto:400,300,500,700,100|Tinos:400,700');

	// for development shows screenshort of original site
  wp_enqueue_script( 'screen-preview', get_template_directory_uri() . '/assets/js/screen-preview.js', array('jquery') );
	
  wp_enqueue_script( 'js-different-scripts', get_template_directory_uri() . '/assets/js/js-different-scripts.js', array('jquery') );
}

add_action('wp_enqueue_scripts', '__tm_val_enqueue_styles_scripts');

?>