<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
function remove_cssjs_ver( $src ) {
    if( strpos($src,'?ver='))
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

add_action( 'wp_enqueue_scripts', 'style_theme' );
function style_theme() {	
	$main = get_stylesheet_directory() . '/assets/css/style.min.css';
	wp_enqueue_style( 'style.min', get_stylesheet_directory_uri().'/assets/css/style.min.css?leave=1', null, filemtime($main));
}

add_action( 'wp_enqueue_scripts', 'scripts_theme' );
function scripts_theme() {	
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.6.1.min.js', false, null, true );
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'jquery.maskedinput.min', get_template_directory_uri() .'/assets/js/jquery.maskedinput.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'touchSwipe', get_template_directory_uri() .'/assets/js/jquery.touchSwipe.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'swiper-bundle.min', get_template_directory_uri() .'/assets/js/swiper-bundle.min.js', array('jquery'), null, true );

	$slider = get_stylesheet_directory() . '/assets/js/slider.js';
	wp_enqueue_script( 'slider', get_template_directory_uri().'/assets/js/slider.js?leave=1', array('jquery'), filemtime($slider), true);

	$dropzone = get_stylesheet_directory() . '/assets/js/dropzone.js';
	wp_enqueue_script( 'dropzone', get_template_directory_uri().'/assets/js/dropzone.js?leave=1', array('jquery'), filemtime($dropzone), true);

	$main = get_stylesheet_directory() . '/assets/js/scripts.js';
	wp_enqueue_script( 'scripts-main', get_template_directory_uri().'/assets/js/scripts.js?leave=1', array('jquery'), filemtime($main), true);

	$popup = get_stylesheet_directory() . '/assets/js/popup.js';
	wp_enqueue_script( 'popup', get_template_directory_uri().'/assets/js/popup.js?leave=1', array('jquery'), filemtime($popup), true);

	$backend = get_stylesheet_directory() . '/assets/js/backend.js';
	wp_enqueue_script( 'backend', get_template_directory_uri().'/assets/js/backend.js?leave=1', array('jquery'), filemtime($backend), true);
	wp_localize_script(
		'backend',
		'backend_object',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'check_nonce' => wp_create_nonce( 'backend-nonce' ),
		)
	);
}

function weblitex_add_defer_attribute( $tag, $handle ) {
	$handles = array(
		'jquery.maskedinput.min',
		'touchSwipe',
		'swiper-bundle.min',
		'slider',
		'dropzone',
		'scripts-main',
		'popup',
		'backend',
		'map-api',
		'ymaps',
		'backend-admin',
		// 'wp-yandex-metrika_YmEc',
		// 'wp-yandex-metrika_frontend',
		// 'hoverintent-js'
	);
	 foreach( $handles as $defer_script) {
		if ( $defer_script === $handle ) {
		   return str_replace( ' src', ' defer="defer" src', $tag );
		}
	}
   
	 return $tag;
  }
  add_filter( 'script_loader_tag', 'weblitex_add_defer_attribute', 10, 2 );

add_action( 'wp_enqueue_scripts', 'enabled_scripts_yandex_maps');
function enabled_scripts_yandex_maps($ymaps) {
	if ($ymaps == true) {
		wp_enqueue_script('map-api', get_template_directory_uri() . '/assets/js/ymaps-api.js', array('jquery'), null, true);
		$ymaps = get_stylesheet_directory() . '/assets/js/ymaps.js';
		wp_enqueue_script( 'ymaps', get_template_directory_uri().'/assets/js/ymaps.js?leave=1', array('map-api'), filemtime($ymaps), true);
	}
}

add_action('admin_enqueue_scripts', function(){
	wp_enqueue_script( 'jquery.maskedinput.min-admin', get_template_directory_uri() .'/assets/js/jquery.maskedinput.min-admin.js', array('jquery'), null, true );
	$backend_admin = get_stylesheet_directory() . '/assets/js/backend-admin.js';
	wp_enqueue_script( 'backend-admin', get_template_directory_uri().'/assets/js/backend-admin.js?leave=1', array(), filemtime($backend_admin), true);
	wp_localize_script(
		'backend-admin',
		'backend_admin_object',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'backend-admin-nonce' ),
		)
	);
}, 99);