<?if(!defined('ABSPATH')){exit;}
$taxonomy = 'vacancy';
$page_id = get_queried_object_id();
$post_tags = get_terms([
	'taxonomy' => $taxonomy,
	'hide_empty' => 0,
	'parent' => 0,
    'post_status' => 'publish', 
    'meta_key' => 'tax_position',
    'orderby' => 'tax_position',
    'order' => 'ASC',
]);

$vacancy = array();
foreach($post_tags as $tag ){
    $term_id = $tag->term_id;
    $taxonomy_acf = $taxonomy.'_'.$term_id;
    $vacancy_on = get_field('vacancy_on', $taxonomy_acf);
    if($vacancy_on) {
        $name = $tag->name;
        $slug = $tag->slug;
        $experience = get_field('experience', $taxonomy_acf);
        $vacancy[] = [
            'title' => $name,
            'experience' => $experience,
            'url' => get_term_link($term_id, $taxonomy)
        ];
    }
}
if ($vacancy) {
    $count_vacancy = count($vacancy);
    echo '<section class="vacancy">';
	    echo '<div class="vacancy__container">';
            echo '<h2>'.(($count_vacancy > 1) ? 'В команду требуются' : 'В команду требуется').'</h2>';
            echo '<div class="vacancy__items">';
                $group = get_sub_field('group');
                $size_form = $group['size_form'];
                $type_form = $group['type_form'];
                $title_open = 'Откликнуться';
                foreach($vacancy as $item){
                    echo '
                    <div class="vacancy__item">
                        <h3>'.$item['title'].'</h3>
                        <p>Опыт работы '.$item['experience'].'</p>
                        <div class="vacancy__item_wrapper">';
                            btn_generation_modal('vacancy', get_queried_object_id());                          
                            echo '<a href="'.$item['url'].'" class="btn-line">О вакансии</a>
                        </div>
                    </div>';
                }
        echo '</div>';
    echo '</div>';
echo '</section>';
}