<?php 
require_once( get_stylesheet_directory() . '/inc/bricks.php' );

/**
 * Register/enqueue custom scripts and styles
 */
add_action( 'wp_enqueue_scripts', function() {
	// Enqueue your files on the canvas & frontend, not the builder panel. Otherwise custom CSS might affect builder)
	if ( ! bricks_is_builder_main() ) {
		wp_enqueue_style( 'bricks-child', get_stylesheet_uri(), ['bricks-frontend'], filemtime( get_stylesheet_directory() . '/style.css' ) );
	}

  wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/assets/css/styles.css', array(), '1.0.0', 'all');

  
  wp_enqueue_script('readmore-script', 'https://cdnjs.cloudflare.com/ajax/libs/Readmore.js/2.0.2/readmore.min.js', array('jquery'), '', true);
  wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), '', true);
} );
