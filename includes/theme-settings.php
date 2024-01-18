<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'wp_weblitex_setup' );
function wp_weblitex_setup() {
	add_theme_support(
	'custom-logo',
	array(
		'width'       => 203,
		'height'      => 43,
		'flex-width'  => true,
		'flex-height' => true,
	));

	add_theme_support( 'title-tag' );
	// add_theme_support( 'post-thumbnails', array( 'page') );
}