<?if(!defined('ABSPATH')){exit;}
$display_type = get_sub_field('display_type');
$count_items = get_sub_field('count');
$post_tags = get_terms([
    'taxonomy' => 'portfolio',
    'hide_empty' => 0,
    'parent' => 0,
    'post_status' => 'publish', 
    'orderby' => 'meta_value',
    'order' => 'ASC',
]);
if ($post_tags) {
    $index_row = get_row_index();
    function item_portfolio($taxonomy_slug = false, $post_tags, $display_type, $count_items, $filter = false){
        $check_doctor_count = 0;
        foreach($post_tags as $key => $item) {
            $check_doctor = false;
            $id = $item->term_id;
            $group = get_field('group', 'portfolio_'.$id.'');
            $category = $group['category'];
            if($display_type == 'list') {
                if(($filter !== 'terms-all')) {
                    if($category !== $filter) continue;
                }
            }
            $doctors_obj = $group['doctors'];
            if($taxonomy_slug) {
                foreach($doctors_obj as $val) {
                    $doctor_slug = $val->slug;
                    if($doctor_slug == $taxonomy_slug) {
                        $check_doctor = true;
                    }
                }
                if($check_doctor) {
                    if ($check_doctor_count >= $count_items) break;
                    $check_doctor_count++;
                }else {
                    continue;
                }
            }else {
                if ($key >= $count_items) break;
            }
            $imgs = get_field('imgs', 'portfolio_'.$id.'');
            if((!empty($imgs)) && (count($imgs) == 2)) {
            echo '
                <div class="example">
                    <div class="example__descr">';
                    if(!empty($group['services'])) {
                        echo '<a class="example__descr_link" href="'.get_category_link($group['services']->term_id).'">'.$group['services']->name.'</a>';
                    }
                    echo '<h3>'.$item->name.'</h3>';
                    $editor = get_field('editor', 'portfolio_'.$id.'');
                    if($editor) {
                        echo '<div class="example__descr_text">'.$editor.'</div>';
                    }
                    echo '<div class="example__descr_icon icon">';
                        if($group['count_visits']) {
                            $value = (int)$group['count_visits'];
                            $inclination = ($value == 1) ? 'визит' : (($value >= 2 && $value < 5) ? 'визита' : 'визитов');
                            echo '<span class="icon__clock">'.$value.' '.$inclination.'</span>';
                        }
                        if($group['cost']) {
                            $cost = number_format((int)$group['cost'], 0, '', ' ');
                            echo '<span class="icon__price">'.$cost.' ₽</span>';
                        }

                    echo '</div>';
                    echo '<div class="example__descr_items">';
                        if($doctors_obj) {
                            foreach($doctors_obj as $val) {
                                $doctor_id = $val->term_id;
                                $doctor_name = $val->name;
                                $doctor_surname = get_field('specialist-name', 'doctors_'.$doctor_id);
                                $doctor_img = get_field('specialist-img-mini', 'doctors_'.$doctor_id);
                                $full_name = $doctor_name.' '.$doctor_surname;
                                $doctor_slug = $val->slug;
                                $doctor_professions = get_field('specialist-profession', 'doctors_'.$doctor_id);
                                $check_term = false;
                                $alternatives = array('21', '24');
                                foreach ($alternatives as $alternative) {
                                    if(strpos(serialize($doctor_professions),$alternative)!==false) {
                                        $check_term = true;
                                    }
                                }
                                echo '
                                    <a href="'.get_term_link($doctor_id, 'doctors' ).'" class="example__descr_item"> <img src="'.$doctor_img.'" alt="'.$full_name.'">
                                        <div>
                                            <h5>'.$full_name.'</h5>';
                                            echo '<p>';
                                            echo ($check_term) ? null : 'Врач ';
                                                foreach($doctor_professions as $value) {
                                                    $value = $value->name;
                                                    echo ($check_term) ? $value : mb_strtolower($value);
                                                    echo (next($doctor_professions)) ? ', ' : null;
                                                }
                                            echo '</p>';
                                        echo '</div>
                                    </a>';
                            }
                        }
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="example__img slider-before-after">
                        <div class="slider-before-after__slider">';
                        echo '
                            <div class="slider-before-after__before"><span></span><img src="'.$imgs[0]['url'].'" alt="'.$item->name.' до"> </div>
                            <div class="slider-before-after__after"><img src="'.$imgs[1]['url'].'" alt="'.$item->name.' после"> </div>

                            <div class="slider-before-after__change change">
                                <span class="change__before">до</span>
                                <span class="change__after">после</span>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    }

    $taxonomy_slug = false;
    $check_page_doctor = false;
    if(is_tax()) {
        $check_doctor = false;
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $taxonomy_name = $term->taxonomy;
        if($taxonomy_name == 'doctors') {
            $taxonomy_slug = $term->slug;
            foreach($post_tags as $item) {
                $id = $item->term_id;
                $group = get_field('group', 'portfolio_'.$id.'');
                $doctors_obj = $group['doctors'];
                foreach($doctors_obj as $val) {
                    $doctor_slug = $val->slug;
                    if($doctor_slug == $taxonomy_slug) {
                        $check_doctor = true;
                    }
                }
            }
            if($check_doctor == false) {
                return;
            }
        }
    }
    if($display_type == 'slider') {
        ?>
            <section class="examples" data-index-row="<?=$index_row;?>">
                <div class="examples__container">
                    <h2><?=get_sub_field('title');?></h2>
                    <nav>
                        <div class="examples-prev slider-prev"></div>
                        <div class="examples-next slider-next"></div>
                    </nav>
                </div>
                <div class="examples__slider swiper">
                    <div class="examples__wrapper swiper-wrapper">
                        <?=item_portfolio($taxonomy_slug, $post_tags, $display_type, $count_items);?>
                    </div>
                </div>
                <?$page_id = get_queried_object_id();
                if(url_to_postid(get_field('page_portfolio', 'options')) !== $page_id) {?>
                    <div class="container">
                        <a href="<?=get_field('page_portfolio', 'options');?>" class="btn-see"><span class="circle" aria-hidden="true">
                        <span class="icon arrow"></span></span><span class="button-text">Все работы</span></a>
                    </div>
                <?}?>
            </section>
        <?
    }else if($display_type == 'list') {
        $filter_on = get_sub_field('filter_on');
        if($filter_on) {
            $services_filter = get_sub_field('services_filter');
            if($services_filter == 'terms-all') {
                $filter_array = [
                    array(
                        'slug' => 'terms-all',
                        'label' => 'Все работы'
                    ),
                    array(
                        'slug' => 'dental',
                        'label' => 'Стоматология'
                    ),
                    array(
                        'slug' => 'cosmetic',
                        'label' => 'Косметология'
                    ),
                    array(
                        'slug' => 'spa',
                        'label' => 'SPA-процедуры'
                    ),
                    array(
                        'slug' => 'medic',
                        'label' => 'Медицина'
                    )
                ];
                $params_filter = [
                    'type_filter' => 'services',
                    'items' => $filter_array,
                    'sorting_class' => ' grid',
                    // 'term_id' => $term_id,
                    'taxonomy' => 'portfolio',
                    'index_row' => ($index_row-1),
                    'count' => (($count_items) ? $count_items : 8),
                    'upload' => (($count_items) ? $count_items : 8),
                    'clear' => 'true',
                    'terms-uploaded' => 'terms-all'
                ];
                
                echo '<div class="container">';
                    echo '<nav class="nav-block filter">';
                        get_template_part('parts/components/standart/select', null, $params_filter);
                    echo '</nav>';
                echo '</div>';
            }
        }
        ?>
            <section class="examples-grid" data-index-row="<?=$index_row;?>">
                <div class="examples-grid__container js-portfolio">
                    <?=item_portfolio($taxonomy_slug, $post_tags, $display_type, $count_items, $services_filter);?>
                </div>
                <?
                    $count_post_tags = count($post_tags);
                    if($count_post_tags >= $count_items) {
                        echo '
                            <nav class="pagination">
                                <button class="btn js-load-portfolio">Показать больше</button>
                            </nav>
                        ';
                    }
                ?>
            </section>
        <?
    }
}