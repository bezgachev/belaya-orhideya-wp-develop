<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'init', 'true_remove_woo_image_sizes', 999 ); // отключение ненужных размеров img WP (это все нужно в конце func.php!)
function true_remove_woo_image_sizes() {
	// remove_image_size( 'woocommerce_single' );
	// remove_image_size( 'shop_single' );
	remove_image_size( '1536x1536' );
	remove_image_size( '2048x2048' );
	// remove_image_size( 'woocommerce_thumbnail' );
	// remove_image_size( 'shop_catalog' );
 	// remove_image_size( 'woocommerce_gallery_thumbnail' );
	// remove_image_size( 'shop_thumbnail' );
	remove_image_size( 'large' );
	// remove_image_size( 'thumbnail' );
	// remove_image_size( 'medium' );
	remove_image_size( 'medium_large' );
	// remove_image_size( 'woo-thumbnail-product-mini' );
	
}

add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' ); // удаляем все неиспользуемые размеры img WP (это все нужно в конце func.php!)
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}