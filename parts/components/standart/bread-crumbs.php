<?if(!defined('ABSPATH')){exit;}
function link_wrapper_breadcrumb($url = false, $title) {
    echo ($url) ? '<a href="'.$url.'"' : '<span'; echo ' class="bread-crumb__item">';
    echo $title;
    echo ($url) ? '</a>' : '</span>';
}
$object = get_queried_object();
?>
<section class="bread-crumb__container">
    <?

    // echo '<pre>';
    // print_r($object);
    // echo '</pre>';


    ?>
    <div class="bread-crumb">
        <?
        link_wrapper_breadcrumb(get_site_url(), 'Главная');
        if(is_tag()) {
            link_wrapper_breadcrumb(get_field('page_doctors', 'options'), get_the_title(url_to_postid(get_field('page_doctors', 'options'))));
            link_wrapper_breadcrumb(false, single_term_title('',false));
        }
        
        else if(is_tax('doctors')) {
            link_wrapper_breadcrumb(get_field('page_doctors', 'options'), get_the_title(url_to_postid(get_field('page_doctors', 'options'))));
            $term_id = $object->term_id;
            $name = $object->name;
            $surname = get_field('specialist-name', 'doctors_'.$term_id);
            $full_name = $name .' '.$surname;
            link_wrapper_breadcrumb(false, $full_name);
        }
        else if(is_tax('vacancy')) {
            // echo 'test';
            link_wrapper_breadcrumb(get_field('page_vacancy', 'options'), get_the_title(url_to_postid(get_field('page_vacancy', 'options'))));
            link_wrapper_breadcrumb(false, single_term_title('',false));
        }
        else if (is_category()) {
            $current_id = $object->term_id;
            $current_title = $object->name;
            $children = get_ancestors($current_id, 'category');
            $reverse_children = array_reverse($children);
            $reverse_children[] = $current_id;
            if ($children) {
                foreach ($reverse_children as $child) {
                    $term_child = get_term($child);
                    $title_child = $term_child->name;
                    $url_child = get_term_link( $child , 'category');
                    if (!next($reverse_children)) {
                        link_wrapper_breadcrumb(false, $title_child);
                    }else {
                        link_wrapper_breadcrumb($url_child, $title_child);
                    }
                }
            }else {
                link_wrapper_breadcrumb(false, $current_title);
            }
        }
        if(is_page()) {
            link_wrapper_breadcrumb(false, single_post_title('',false));
        }
        ?>
    </div>
</section>