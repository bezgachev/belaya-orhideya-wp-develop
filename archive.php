<?
get_header();
if(is_tag()) {
    $object = get_queried_object();
    $slug = $object->taxonomy;
    if ($slug == 'post_tag') {
        get_template_part('page/single-page/specialization', null, $object);
    }else {
        $url = get_site_url();
        wp_redirect($url, '301');
        exit();
    }
}
else if (is_category()) {
    $object = get_queried_object();
    get_template_part('page/single-page/services', null, $object);
}
get_footer();