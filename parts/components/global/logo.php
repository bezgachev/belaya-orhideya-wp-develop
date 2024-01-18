<?if(!defined('ABSPATH')){exit;}
$args = get_query_var('global_params');
echo '<a href="'.get_site_url().'" class="header__logo">';
    if (!empty($args['logo_url'])) {
        echo '<img src="'.$args['logo_url'].'" alt="logo">';
    } else {
        echo get_bloginfo('name');
    }
echo '</a>';