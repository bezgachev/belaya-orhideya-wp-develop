<?if(!defined('ABSPATH')){exit;} ?>

<?
if(function_exists('acf_add_options_page') ) {
    
    $post = 'options';
    $logo = wp_get_attachment_image_src(get_theme_mod('custom_logo'));
    $time_works = get_field('time_work', $post);
    $phones = get_field('phones', $post);
    $city = get_field('city', $post);
    $address = get_field('address', $post);
    $email = get_field('e_mail', $post);
    
    $socials = get_field('enable_display_social', $post);

    $geo = get_field('geo', $post);
    $gis = get_field('2gis', $post);
    $maps_title = get_field('maps_title', $post);
    $maps_subtitle = get_field('maps_subtitle', $post);

    if ($socials) {
        $social_array = array();
        foreach($socials as $social) {
            $variable = get_field_object($social, $post);
            if($socials && in_array($social, $socials) && !empty($variable['value'])) {
                $special_variable = array('whatsapp', 'viber');
                if(in_array($social, $special_variable)) {
                    $variable_edit = preg_replace('/[^0-9\+]/', '', $variable['value']);
                    $value = $variable_edit;
                }
                if ($social == 'whatsapp') {
                    $before = '://send?phone=';
                    $value = $social.''.$before.''.$variable['value'];
                }
                elseif ($social == 'viber') {
                    $before = '://chat?number=';
                    $value = $social.''.$before.''.$variable['value'];
                }
                elseif ($social == 'telegram') {
                    $before = 'https://t.me/';
                    $value = $before.''.$variable['value'];
                }
                elseif ($social == 'instagram') {
                    $before = 'https://www.instagram.com/';
                    $value = $before.''.$variable['value'];
                }
                else {
                    $value = $variable['value'];
                }
                $social_array[$social] = array('value' => $value, 'name' => $social, 'title' => $variable['label']);
            }

        }
    }

    if((isset($phones)) && (!empty($phones))) {
        $phones_array = array();
        foreach($phones as $val) {
            $tel = $val['tel'];
            $type_service_label = $val['type_service']['label'];
            $type_service_value = $val['type_service']['value'];
            if (array_key_exists($type_service_value, $phones_array)) {
                $get_phones = $phones_array[$type_service_value]['phones'];
                $array_phones = [$get_phones, $tel];
                $phones_array[$type_service_value]['phones'] = $array_phones;
                $phones_array[$type_service_value]['quantity'] = 2;
            }else {
                $phones_array[$type_service_value] = [
                    'phones' => $tel,
                    'label' => $type_service_label,
                    'quantity' => 1,
                ];
            }
        }
    }

    if((isset($time_works)) && (!empty($time_works)) && (isset($phones_array)) && (!empty($phones_array))) {
       // $time_works_array = array();
       $weekday_time = array();
        $time_works_main = get_field('time_work_main', $post);
        foreach($time_works as $work) {
            // $type_service_label = $work['type_service']['label'];
            $type_service_value = $work['type_service']['value'];
            $weekday = $work['weekday'];
            $time = $work['time'];
            $weekday_time = ''.$weekday.': '.$time.'';
            if (array_key_exists($type_service_value, $phones_array)) {
                $phones_array[$type_service_value]['days_work'][] = $weekday_time;
            }
        }
    }


    $post_tags = get_terms([
        'taxonomy' => 'stocks',
        'hide_empty' => 0,
        'parent' => 0
    ]);
    $stoks_count = 0;
    foreach($post_tags as $tag ){
        $stocks_on = get_field('stocks-on', 'stocks_'.$tag->term_id);
        if ($stocks_on) {
            $stoks_count++;
        }
    }

    $post_tags_vacancy = get_terms([
        'taxonomy' => 'vacancy',
        'hide_empty' => 0,
        'parent' => 0,
    ]);
    $vacancy_count = 0;
    foreach($post_tags_vacancy as $tag ){
        $vacancy_on = get_field('vacancy_on', 'vacancy_'.$tag->term_id);
        if($vacancy_on) {
            $vacancy_count++;
        }
    }

    $global_params_acf = [
        'logo_url' => ($logo) ? $logo[0] : null,
        'email' => ($email) ? $email : null,
        'city' => ($city) ? $city: null,
        'address' => ($address) ? $address : null,
        'contacts' => (isset($phones_array)) ? $phones_array : null,
        'time_works_main' => $time_works_main,
        'geo' => ($geo) ? $geo: null,
        'gis' => ($gis) ? $gis: null,
        'maps_title' => ($maps_title) ? $maps_title: null,
        'maps_subtitle' => ($maps_subtitle) ? $maps_subtitle: null,
        'socials' => ($socials) ? $social_array : null,
        'stoks_count' => $stoks_count,
        'vacancy_count' => ($vacancy_count) ? $vacancy_count : null,
    ];

    set_query_global_params_wp($global_params_acf);
    // echo '<br><br><br><br><br><br>';echo '<br><br><br><br><br><br>';
    // $args = get_query_var('global_params');
    // echo '<pre>';
    // print_r($args);
    // echo '</pre>';

}