<?if(!defined('ABSPATH')){exit;}
$display_type = get_sub_field('display_type');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$subtitle_on = get_sub_field('subtitle_on');
$reviews_count = get_sub_field('count');

$feedback_posts = get_posts( array(
    // 'posts_per_page' => -1,
    'numberposts' => ($reviews_count) ? $reviews_count : 6,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'post_type'   => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
));
global $post;
if($display_type == 'slider') {
?>
<section class="reviews" id="reviews">
	<div class="container">
		<h2><?=($title)? $title : 'Вот как отзываются клиенты о нас';?></h2>
        <?if($subtitle_on) {?>
		    <h3><?=($subtitle)? $subtitle : 'Из них 200+ положительно и 13 не очень';?></h3>
        <?}?>
	</div>
	<div class="container">
		<div class="reviews__nav">
			<div class="reviews-prev slider-prev"></div>
			<div class="reviews-next slider-next"></div>
		</div>
	</div>
	<div class="reviews__wrapper">
		<div class="reviews__content">
			<div class="reviews__container">
				<div class="reviews__body">
                    <?
                        $page_id = get_queried_object_id();
                        $metric_key = get_field('metric_key', 'options');
                        $type_form = 'Отзыв';
                        $title_open = get_sub_field('title_open');
                        $check_bot = get_field('check_bot', 'options');
                        
                        if (is_tax('doctors')) {
                            $doctor_term = get_term( $page_id, 'doctors');
                            $doctor_surname = $doctor_term->name;
                            $doctor_name = get_field('specialist-name', 'doctors_'.$page_id);
                            $doctor_full_name = $doctor_surname.' '.$doctor_name;
                        }


                        $settings_forms = get_field('settings_forms', 'options');
                        foreach($settings_forms as $field_forms) {
                            if($field_forms['type_form_label'] == $type_form) {
                                // $title_open = $field_forms['title_open'];
                                $title = $field_forms['title'];
                                $subtitle = $field_forms['subtitle'];
                                $title_send = $field_forms['title_send'];
                                $editor_form = $field_forms['editor_form'];
                                $count_editor_form = count($editor_form);
                                for($i = 0; $i < $count_editor_form; $i++) {
                                    $field = $editor_form[$i]['acf_fc_layout'];
                                    if ($field == "name") $type = "text";
                                    if ($field == "tel") $type = "tel";
                                    if ($field == "email") $type = "email";
                                    if ($field == "message") $type = "text";
                                    if ($field == "file") $type = $field;
                                    // if ($field == "select") $type = $field;
                                    // if ($field == "rating") $type = "radio";
                                
                                    $required_check = $editor_form[$i]['required'];
                                    $placeholder = $editor_form[$i]['placeholder'];
                                    if((is_tax('doctors')) && ($field == 'select')) {
                                        // $set_field['select'] = false;
                                    }
                                    else if ((!is_tax('doctors')) && ($field == 'select')) {

                                        $post_tags_doctors = get_terms([
                                            'taxonomy' => 'doctors',
                                            'hide_empty' => 0,
                                            'parent' => 0,
                                            'post_status' => 'publish', 
                                            'meta_key' => 'tax_position',
                                            'orderby' => 'tax_position',
                                            'order' => 'ASC',
                                        ]);

                                        $full_name = array();
                                        foreach($post_tags_doctors as $tag ){
                                            $term_id = $tag->term_id;
                                            $name = $tag->name;
                                            $slug = $tag->slug;
                                            $surname = get_field('specialist-name', 'doctors_'.$term_id);
                                            $full_name[] = $name.' '.$surname;

                                        }
                                        $set_field['select'] = [
                                            'options' => $full_name,
                                            'placeholder' => $placeholder,
                                        ];
                                    }
                                    else if ($field == 'rating') {
                                        $set_field['rating'] = true;
                                    }
                                    else {
                                        $set_field[$field] = [
                                            'type' => $type,
                                            'required' => ($required_check) ? true : false,
                                            'placeholder' => ($required_check) ? $placeholder.'*' : $placeholder,
                                        ];
                                    }
                                }
                                $data = [
                                    'section_class' => 'popup-reviews',
                                    'title' => $title, //заголовок
                                    'subtitle' => $subtitle, //описание
                                    'fields' => $set_field,
                                    'btn_title' => $title_send, //название кнопки в попапе
                                    'hidden' => [
                                        'form_name' => $type_form,
                                        'form_title' => $title,
                                        'page_title' => ((is_tax('doctors')) ? $doctor_full_name : get_the_title($page_id)),
                                        'page_url' => ((is_tax('doctors')) ? get_term_link($page_id, 'doctors') : get_the_permalink($page_id)),
                                        'metrica_key' => $metric_key,
                                        'metrica_value' => $field_forms['type_form_value'],
                                        'option_select' => ((is_tax('doctors')) ? $doctor_full_name : false),
                                        'check' => $check_bot
                                    ],
                                ];
                            }
                        }
                        $settings = base64_encode(json_encode($data));
                        echo '<button class="btn js-popup" data-settings="'.$settings.'">'.$title_open.'</button>';
                        
                        echo '<a href="'.get_field('page_reviews', 'options').'" class="btn-see-line"><span class="circle" aria-hidden="true"><span class="icon arrow"></span></span><span class="button-text">
                            Все отзывы
                        </span></a>';
                    ?>
                
				</div>
			</div>
		</div>
		<div class="reviews__slider swiper" data-count="<?=($reviews_count) ? $reviews_count : 6;?>" data-upload="<?=($reviews_count) ? $reviews_count : 6;?>">
            <div class="js-load-reviews d-hide"></div>
			<div class="swiper-wrapper js-wrapper-load-reviews">
                <?
                    global $post;
                    $first_item = true;
                    $loading_item = false;
                    foreach( $feedback_posts as $key => $post ){
                        setup_postdata( $post );
                        $id = get_the_id();
                        $comment = get_the_content();
                        if(!empty($comment)) {
                            $doctor_term = get_field('doctor', $id);
                            if(!empty($doctor_term)) {
                                $doctor_id = $doctor_term->term_id;
                                $doctor_surname = $doctor_term->name;
                                $doctor_name = get_field('specialist-name', 'doctors_'.$doctor_id);
                                $doctor_full_name = $doctor_surname.' '.$doctor_name;
                            }
                            if($key > 0) {
                                $first_item = false;
                            }
                            if (!next($feedback_posts)) {
                                $loading_item = true;
                            }
                            $source = get_field('source', $id);
                            $star_count = get_field('star-count', $id);
                            $data = get_field('data', $id);
                            $name = strval(get_the_title());
                            $params_feedback = [
                                'name' => $name,
                                'comment' => get_the_content(),
                                'doctor' => ($doctor_term) ? $doctor_full_name : null,
                                'source'=> $source,
                                'count' => $star_count,
                                'data' => $data,
                                'first_item' => $first_item,
                                'loading_item' => $loading_item
                            ];
                            get_template_part('parts/components/project/card-feedback', null, $params_feedback);
                        }
                    }
                    wp_reset_postdata();
                ?>
			</div>
		</div>
	</div>
</section>
<?
}
else if($display_type == 'list') {
    echo '<section class="feedback-cards" data-count="'.(($reviews_count) ? $reviews_count : 6).'" data-upload="'.(($reviews_count) ? $reviews_count : 6).'">';
        echo '<div class="feedback-cards__container js-wrapper-load-reviews">';
            
            $first_item = true;
            $loading_item = false;
            foreach($feedback_posts as $key => $post ){
                setup_postdata( $post );
                $id = get_the_id();
                $comment = get_the_content();
                if(!empty($comment)) {
                    $doctor_term = get_field('doctor', $id);
                    if(!empty($doctor_term)) {
                        $doctor_id = $doctor_term->term_id;
                        $doctor_surname = $doctor_term->name;
                        $doctor_name = get_field('specialist-name', 'doctors_'.$doctor_id);
                        $doctor_full_name = $doctor_surname.' '.$doctor_name;
                    }
                    if($key > 0) {
                        $first_item = false;
                    }
                    if (!next($feedback_posts)) {
                        $loading_item = true;
                    }
                    $source = get_field('source', $id);
                    $star_count = get_field('star-count', $id);
                    $format = 'j F Y';
                    $data = get_the_date($format);
                    $name = strval(get_the_title());
                    $params_feedback = [
                        'name' => $name,
                        'comment' => get_the_content(),
                        'doctor' => ($doctor_term) ? $doctor_full_name : null,
                        'source'=> $source,
                        'count' => $star_count,
                        'data' => $data,
                        'first_item' => $first_item,
                        'loading_item' => $loading_item
                    ];
                    get_template_part('parts/components/project/card-feedback', null, $params_feedback);
                }
            }
            wp_reset_postdata();
        echo '</div>';
        echo (count($feedback_posts) > 5) ? '<button class="btn js-load-reviews">Показать больше</button>' : null;
    echo '</section>';
}
?>

<section class="full-feedback">
	<!-- добавить класс для загрузки loder -->
	<div class="full-feedback__container">
		<div class="full-feedback-swiper">
			<div class="full-feedback-prev js-feedback"></div>
                    
            <div class="feedback-card js-feedback swiper-slide">
                <div class="feedback-card__title title">
                    <div class="title__img"></div>
                    <h3 class="title__name"></h3>
                    <div class="title__star">
                        <span class="title__star_content" data-count="4"></span>
                        <span class=" title__star_data"></span>
                    </div>
                    <div class="title__source"></div>
                </div>
                <div class="feedback-card__descr">
                    <div class="feedback-card__descr_title line">
                        <span>Лечащий врач:</span>
                    </div>
                    <p class="line">
                    </p>
                </div>
                <button class="feedback-card__btn">Показать полностью</button>
                <button class="feedback-card__popup">Показать полностью</button>
            </div>

			<div class="full-feedback-next js-feedback"></div>
			<div class='full-feedback-close'></div>
		</div>
		<div class='full-feedback-overlay'></div>
	</div>
</section>