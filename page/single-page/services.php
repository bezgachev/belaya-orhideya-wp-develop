<?if(!defined('ABSPATH')){exit;}
$object = $args;
$term_id = $object->term_id;
$flexible_content = get_sub_field('blocks', 'post_tag_'.$term_id); 
if( have_rows('blocks', 'post_tag_'.$term_id) ) {
    while( have_rows('blocks', 'post_tag_'.$term_id) ) : the_row();
        $layout = get_row_layout();
        get_template_part('parts/blocks/'.$layout.'', null, $term_id);
    endwhile;
}