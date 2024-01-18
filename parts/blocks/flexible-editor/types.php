<?
if(!defined('ABSPATH')){exit;}
$types_repeater = get_sub_field('types_repeater');
if(!empty($types_repeater)) {
    $title = get_sub_field('title');
    $types_filter_on = get_sub_field('types_filter_on');
    if ($types_filter_on) {
        $object = get_queried_object();
        $term_id = $object->term_id;
        $taxonomy = $object->taxonomy;
        $index_row = get_row_index();
        ?>
        <section class="view" data-index-row="<?=$index_row;?>">
            <div class="view__container">
                <h2><?=($title) ? $title : 'Заголовок';?></h2>

                <?
                $filter_array = array();
                foreach ($types_repeater as $key => $item) {
                    $filter_array[] = [
                        'slug' => $key,
                        'label' => $item['title_filter']
                    ];
                }
                
                // print_r($types_repeater);
                // print_r($filter_array);
                $params_filter = [
                    'type_filter' => 'services',
                    'items' => $filter_array,
                    'sorting_class' => ' grid',
                    'term_id' => $term_id,
                    'taxonomy' => $taxonomy,
                    'index_row' => ($index_row-1)
                ];
                echo '<nav class="nav-block filter">';
                    get_template_part('parts/components/standart/select', null, $params_filter);
                echo '</nav>';

                ?>
                
                <?
                foreach ($types_repeater as $key => $item) {
                    if ($key === 0) {
                        $title = $item['title'];
                        $title_filter = $item['title_filter'];
                        $editor = $item['editor'];
                        $img = $item['img'];
                        $term_id = $item['link'];
                        $link = get_category_link($term_id);
                        if ($title && $title_filter && $editor && $img  ) {
                            echo '
                            <div class="block-two js-services">
                                <div class="block__img"> <img src="'.$img.'" alt="'.$title.'"> </div>
                                <div class="block__descr">
                                    <h3>'.$title.'</h3>
                                    '.$editor.'
                                    '.(($term_id) ? '<a href="'.$link.'" class="btn-line">Подробнее</a>' : null).'
                                </div>
                            </div>';
                        }
                    }
                }
                ?>
            </div>
        </section>
    <?
    }else {
        ?>
        <section class="types-prosthetics">
            <div class="types-prosthetics__container">
                <h2><?=($title) ? $title : 'Заголовок';?></h2>
                    <?
                    if(is_countable($types_repeater[0]['types_list'])) {
                        $count_item = count($types_repeater[0]['types_list']);
                    }
                                        
                    echo '<div class="types-prosthetics__items'.((isset($count_item) && $count_item > 5) ? ' first-big' : null).'">';
                        foreach ($types_repeater as $item) {
                            $types_list = $item['types_list'];
                            ?>
                            <div class="types-prosthetics__item">
                                <div class="types-prosthetics__item_img">
                                    <img class="" src="<?=$item['img'];?>" alt="">
                                </div>
                                <div>
                                    <h3><?=$item['title'];?></h3>
                                    <p><?=$item['subtitle'];?></p>
                                </div>
                                <?
                                    if(!empty($types_list)) {
                                        echo '<ul class="types-prosthetics__item_lists">';
                                            foreach ($types_list as $li) {
                                                $taxonomy_on = $li['taxonomy_on'];
                                                if($taxonomy_on) {
                                                    $term_id = $li['taxonomy'];
                                                    $link = get_category_link($term_id);
                                                    if(!empty($li['title'])) {
                                                        $title = $li['title'];
                                                    }else {
                                                        $title = single_term_title('',false, $term_id);
                                                    }
                                                }else {
                                                    $link = $li['wp_link']['url'];
                                                    $title = $li['wp_link']['title'];
                                                }
                                                echo '<li>';
                                                echo ($link) ? '<a href="'.$link.'">' : '<span>';
                                                echo $title;
                                                echo ($link) ? '</a>' : '</span>';
                                                echo '</li>';                                             
                                            }
                                        echo '</ul>';
                                    }
                                ?>
                            </div>
                        <?
                        }
                    echo '</div>';
                    ?> 
            </div>
        </section>        
    <?
    }
}