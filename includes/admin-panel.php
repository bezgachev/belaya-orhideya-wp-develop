<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter('show_admin_bar', '__return_false');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}