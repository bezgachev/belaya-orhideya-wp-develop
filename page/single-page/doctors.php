<?
if(!defined('ABSPATH')){exit;}

$page_id = url_to_postid(get_field('page_doctors', 'options'));
$term = $args;

$flexible_content = get_field('doctor-details', $page_id); 
if( have_rows('doctor-details', $page_id) ):

    while( have_rows('doctor-details', $page_id) ) : the_row();
        $layout = get_row_layout();
        if($layout === 'blocks') {
            
            $flexible_content = get_sub_field('blocks', $page_id); 
            if( have_rows('blocks', $page_id) ):

                while( have_rows('blocks', $page_id) ) : the_row();
                    $layout = get_row_layout();

                    get_template_part('parts/blocks/'.$layout.'');
                endwhile;

            endif;

        }
        else {
            get_template_part('parts/blocks/'.$layout.'', null, $term);
        }

    endwhile;

endif;