<?if(!defined('ABSPATH')){exit;}

$page_id = get_queried_object_id();
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$links_reviews_on = get_sub_field('links_reviews_on');
$btn_on = get_sub_field('btn_on');
if($links_reviews_on && $btn_on==false) {?>
    <section class="feedback">
        <div class="feedback__container">
            <div class="feedback__descr">
                <h1><?=$title;?></h1>
                <p><?=$subtitle;?></p>
            </div>
            <?
                $params = [
                    'full_block' => false
                ];
                get_template_part('parts/blocks/links-reviews', null, $params);
            ?>
        </div>
    </section>
<?
}
else {

    $background = get_sub_field('background');
    $img = get_sub_field('img');
    

    function wrapper_bg($url) {
        echo '<img class="page-screen__img-bg" src="'.$url.'" alt="Фон страницы">';
    }
    function wrapper_img($url) {
        echo '<img class="page-screen__img" src="'.$url.'" alt="Изображение">';
    }
    ?>
    <section class="page-screen">
        <?
        echo ($background) ?  wrapper_bg($background) : null;
        ?>
        <div class="page-screen__container">
            <div class="page-screen__wrapper">
                
                <?
                if(is_page('vacancy')) {
                    $args = get_query_var('global_params');
                    $vacancy_count = $args['vacancy_count'];
                    echo ($vacancy_count) ? '' : '<div class="page-screen__alert"><span>Открытых вакансий нет</span></div>';
                }
                ?>
                <h1 class="page-screen__title">
                    <?=str_replace('-', '&#8209;', $title);?>
                </h1>
                <div class="page-screen__descr">
                    <?
                    echo '<p>'.$subtitle.'</p>';
                    if (is_archive()) {
                        $object = get_queried_object();
                        $slug_tax = $object->taxonomy;
                        if($slug_tax == 'category') {
                            $dir_theme = get_stylesheet_directory_uri().'/assets/img/wp/icons-prosthetic';
                            echo '<ul>
                                    <li>
                                        <img src="'.$dir_theme.'/1.svg" alt="Гарантия на все работы">
                                        <span>Гарантия на все работы</span>
                                    </li>
                                    <li>
                                        <img src="'.$dir_theme.'/2.svg" alt="Единый центр – все услуги в одном месте">
                                        <span>Единый центр – все услуги в одном месте</span>
                                    </li>
                                    <li>
                                        <img src="'.$dir_theme.'/3.svg" alt="Квалифицированные врачи">
                                        <span>Квалифицированные врачи</span>
                                    </li>
                                    <li>
                                        <img src="'.$dir_theme.'/4.svg" alt="Устанавливаем честные цены">
                                        <span>Устанавливаем честные цены</span>
                                    </li>
                                </ul>';
                        }
                    }
                ?>
                </div>
                <?
                    if (is_archive()) {
                        $object = get_queried_object();
                        $slug_tax = $object->taxonomy;
                        if($slug_tax == 'category') {
                            echo '<div class="page-screen__btn">';
                                btn_generation_modal('category', get_queried_object_id());
                                $array_link = [
                                    get_field('page_price', 'options') => 'Цены',
                                    get_field('page_doctors', 'options') => 'Врачи',
                                    get_field('page_reviews', 'options') => 'Отзывы',
                                ];
                                echo '<div class="page-screen__btn_items">';
                                    foreach($array_link as $key => $item) {
                                        echo '<a href="'.$key.'" class="btn-line">'.$item.'</a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                        else if($slug_tax == 'post_tag') {
                            echo '<div class="page-screen__btn">';
                                btn_generation_modal('specialization', get_queried_object_id());
                            echo '</div>';
                        }

                        
                    }else {
                        if($btn_on == true) {
                            $group = get_sub_field('group');
                            $size_form = $group['size_form'];
                            $navigation = $group['navigation'];
                            $title_open = $group['title_open'];
                            if ($navigation == 'popup') {
                                $metric_key = get_field('metric_key', 'options');
                                $check_bot = get_field('check_bot', 'options');
                                $type_form = $group['type_form'];
                                
                                if (is_tax('doctors')) {
                                    $size_form = 'popup-reviews';
                                    $doctor_term = get_term( $page_id, 'doctors');
                                    $doctor_surname = $doctor_term->name;
                                    $doctor_name = get_field('specialist-name', 'doctors_'.$page_id);
                                    $doctor_full_name = $doctor_surname.' '.$doctor_name;
                                }

                                $settings_forms = get_field('settings_forms', 'options');
                                foreach($settings_forms as $field_forms) {
                                    if($field_forms['type_form_label'] == $type_form) {
                                        
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

                                                $full_name = array('Не выбирать');
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
                                            'section_class' => $size_form,
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
                                echo '<div class="page-screen__btn">';
                                echo '<button class="btn js-popup" data-settings="'.$settings.'">'.(($title_open) ? $title_open : 'Заказать звонок').'</button>';
                                echo '</div>';

                            }
                        

                        }
                        
                        
                        if($btn_on == false) {
                            $advantages_on = get_sub_field('advantages_on');
                            if($advantages_on) {
                                $advantages = get_sub_field('advantages_list');
                                if(!empty($advantages)) {
                                    echo '<div class="info-about">';
                                        foreach($advantages as $key => $val) {
                                            $params_advantages = [
                                                'title' => $val['title'],
                                                'subtitle' => $val['subtitle'],
                                                'key' => $key
                                            ];
                                            get_template_part('parts/components/project/info-about', null, $params_advantages);
                                        }
                                    echo '</div>';
                                }

                            }
                        }
                    }

                ?>
            </div>
            <?
            echo ($img) ? wrapper_img($img) : null;
            ?>
        </div>
    </section>
    <?
}