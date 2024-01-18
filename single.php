<?get_header();
$url = get_field('page_reviews', 'options');
echo '<div class="my_redirect_url d-hide" data-url="'.$url.'"></div>';
get_footer();