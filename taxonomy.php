<?
get_header();
if(is_tax('stocks')) {
    $url = get_permalink(426);
    wp_redirect($url, '301');
    exit();
}
else {
    $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $taxonomy = $term->taxonomy;
    if($taxonomy == 'portfolio') {
        $url = get_field('page_portfolio', 'options');
        echo '<div class="my_redirect_url d-hide" data-url="'.$url.'"></div>';
    }else {
        get_template_part('page/single-page/'.$taxonomy.'', null, $term);
    }
}
get_footer();