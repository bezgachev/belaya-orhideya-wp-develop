<?
// Скрытие меню панели управления
// get_template_part('includes/admin-panel');

// Подключение настроек темы
get_template_part('includes/theme-settings');

// Подключение скриптов и стилей
get_template_part('includes/enqueue-script-style');

// Кастомное меню
get_template_part('includes/nav-menu/register-nav-menu');

// Ajax WP
get_template_part('includes/wp-ajax');

// Удаление регистрационных размеров изображений WP
get_template_part('includes/wp-remove-image-sizes');

// Оптимизация WP
get_template_part('includes/wp-optimization');

// Регистрация и изменение таксономий, категорий
get_template_part('includes/change_taxonomy');

// Комментарии WP
get_template_part('includes/change_form_comment');

// Кастомные свои функции
get_template_part('includes/custom_functions');

// Настройки плагина ACF
get_template_part('includes/acf-options');

// Настройки SMTP сервера
get_template_part('includes/global/mail-server');


function set_query_global_params_wp($args) {
    set_query_var('global_params', $args);
}

add_action('init', 'my_redirect_url');
function my_redirect_url($url) {
    ob_clean();
    ob_start();
    $args = array(
        'public'   => true,
        '_builtin' => false,
     );
     $output = 'names';
     $operator = 'and';
     $post_types = get_post_types( $args, $output, $operator ); 
        if(is_singular($post_types)){
            wp_redirect($url, '301');
            exit();
    }
}