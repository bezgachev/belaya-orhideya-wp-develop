<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

register_nav_menu( 'header-main-menu', 'Главное меню');
register_nav_menu( 'footer', 'Навигация, подвал сайта');
// register_nav_menu( 'sibebar-menu', 'Боковое меню мобилка, планшет');
// register_nav_menu( 'header-catalog', 'Каталог шапка, подвал сайта');
// register_nav_menu( 'catalog-main', 'Каталог');
// register_nav_menu( 'footer-clients', 'Покупателям, подвал сайта');
// register_nav_menu( 'footer-help', 'Помощь, подвал сайта');

// Подключение классов Walker_Nav_Menu
get_template_part('includes/nav-menu/class-nav-menu');

// Подключение функций меню
get_template_part('includes/nav-menu/functions-nav-menu');


