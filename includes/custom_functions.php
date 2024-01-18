<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'user_can_richedit', 'receiving_editor_post' );
function receiving_editor_post( $default ) {
	global $post;
		if ( get_post_type( $post ) == 'post' ) {
			add_action('admin_footer', 'my_style_editor_post');
		}
	return $default;
}

function my_style_editor_post() {
	?>
	<style>
		#postdivrich #wp-content-editor-tools {
			display: none;
		}
		#postdivrich .mce-top-part {
			display: none;
		}
		#postdivrich .mce-edit-area {
			padding-top: 0;
		}
		#wp-content-wrap {
			padding-top: 30px !important;
			margin-top: 40px;
		}
		#wp-content-wrap:after{
			content: 'Текст отзыва';
			position: absolute;
			left: 0;
			top: 0px;
			width: 100%;
			font-weight: 500;
			color: #2c3338;
			font-size: 16px;
		}
		.admin-preview-img {
			width: 100px;
		}
	</style>	
	<?
}



function inclination_years($value, $year) {
	$year = (int)$year;
	$value = (int)$value;
	if($year == 11) {
		$inclination = 'лет';
	}else {
		$inclination = ($value == 1) ? 'год' : (($value >= 2 && $value < 4) ? 'года' : 'лет');
	}
	

	return $inclination;
}


// get_template_part('includes/global/WP_Term_Image');
// add_action( 'admin_init', 'kama_wp_term_image' );
// function kama_wp_term_image(){
// 	// Укажем для какой таксономии нужна возможность устанавливать картинки.
// 	// Можно не указывать, тогда возможность будет автоматом добавлена для всех публичных таксономий.
// 	\Kama\WP_Term_Image::init( [
// 		'taxonomies' => [ 'post_tag' ],
// 	] );
// }



function price_list_table($price_repeater){
	foreach($price_repeater as $item) {
		$price_settings = $item['price_settings'];
		$term_id = $item['url'];
		$url_term = get_category_link($term_id);
		$titles = $item['titles'];
		$title = $titles['title'];
		$price = $item['price'];
		if(in_array('price_at', $price_settings)) {$price_at = true;}else {$price_at = false;}
		$text = $item['text'];

		if(in_array('list', $price_settings)) {
			$checking_list = $price['price_list'];
			if(empty($checking_list)) {
				$checking_price = 0;
			}

		}else {
			$checking_price = $price['price_main'];
			// print_r($checking_price);
		}
		// print_r($checking_price);
		if(is_numeric($checking_price)) {
			?>
			<div class="table">
				<div class="table__title">
					<?
					if(in_array('list', $price_settings)) {
						$title_list = $titles['title_list'];
						if(is_array($title_list)) {
							echo '<ul>';
							echo (!empty($term_id)) ? '<a href="'.$url_term.'" style="white-space: nowrap">' : '<span style="white-space: nowrap">';
								echo $title;
							echo (!empty($term_id)) ? '</a>' : '</span>';

							// print_r($title_list);

							foreach($title_list as $list) {
								echo '<li>'.$list['title'].'</li>';
							}
							echo '</ul>';
						}
					}else {
						echo (!empty($term_id)) ? '<a href="'.$url_term.'">' : '<span>';
							echo $title;
						echo (!empty($term_id)) ? '</a>' : '</span>';
					}

					if(!empty($text)) {?>
					<div class="table__icon">
						<svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.13055 18C3.00554 18 2.88206 17.9717 2.76891 17.917C2.65576 17.8623 2.55572 17.7825 2.47593 17.6834C2.39613 17.5843 2.33855 17.4683 2.30728 17.3437C2.276 17.2191 2.27181 17.0889 2.295 16.9624L2.6537 14.9931C2.66532 14.918 2.65863 14.841 2.63422 14.7692C2.60981 14.6974 2.56846 14.633 2.51387 14.5817C1.71956 13.8011 1.08725 12.8626 0.655163 11.8232C0.223078 10.7838 0.000198878 9.66487 0 8.53421C0.0310263 6.24287 0.943287 4.05772 2.53672 2.45798C4.13015 0.858243 6.27468 -0.0255013 8.5 0.000560482C10.7253 -0.0255013 12.8698 0.858243 14.4633 2.45798C16.0567 4.05772 16.969 6.24287 17 8.53421C16.969 10.8256 16.0567 13.0107 14.4633 14.6104C12.8698 16.2102 10.7253 17.0939 8.5 17.0679C7.65393 17.0667 6.81264 16.9374 6.00312 16.6841C5.94806 16.6657 5.89001 16.6587 5.83232 16.6635C5.77463 16.6683 5.71843 16.6848 5.66695 16.7121L3.53472 17.8937C3.41067 17.9631 3.27176 17.9997 3.13055 18Z" fill="#8371C3" fill-opacity="0.6"></path>
							<path d="M7.10084 12.2703C7.10084 12.5383 7.19477 12.769 7.38263 12.9624C7.57049 13.1558 7.83699 13.2524 8.18213 13.2524C8.52727 13.2524 8.79158 13.1558 8.97507 12.9624C9.16293 12.769 9.25686 12.5383 9.25686 12.2703C9.25686 11.9978 9.16293 11.7671 8.97507 11.5781C8.79158 11.3848 8.52508 11.2881 8.17558 11.2881C7.83044 11.2881 7.56394 11.3848 7.37608 11.5781C7.19259 11.7671 7.10084 11.9978 7.10084 12.2703ZM5.44287 6.09375H7.16638V5.91577C7.16638 5.52466 7.26467 5.22803 7.46127 5.02588C7.66224 4.82373 7.95932 4.72266 8.35251 4.72266C8.75445 4.72266 9.04934 4.82812 9.2372 5.03906C9.42943 5.25 9.52554 5.56421 9.52554 5.98169C9.52554 6.3772 9.42288 6.698 9.21754 6.94409C9.01221 7.19019 8.72605 7.47803 8.35907 7.80762C7.92218 8.19434 7.62947 8.56348 7.48093 8.91504C7.33676 9.2666 7.26467 9.70825 7.26467 10.24V10.3257H9.01439V10.2466C9.01439 9.96533 9.05808 9.68408 9.14546 9.40283C9.2372 9.12158 9.4622 8.83813 9.82044 8.55249C10.1787 8.27124 10.5129 7.91748 10.8231 7.49121C11.1333 7.06055 11.2884 6.54639 11.2884 5.94873C11.2884 5.14893 11.0219 4.52051 10.4889 4.06348C9.96024 3.60645 9.25031 3.37793 8.35907 3.37793C7.48093 3.37793 6.77536 3.59985 6.24237 4.0437C5.70937 4.48315 5.44287 5.09839 5.44287 5.8894V6.09375Z" fill="white"></path>
						</svg>
						<div class="table__tooltiper">
							<div class="tooltiper">
								<div>В цену включено:</div>
								<ul>
								<?
									$text_array = explode(',', $text);
									foreach($text_array as $text) {
										echo '<li>';
											if (!next($text_array)) {
												echo $text;
											}else {
												echo $text.',';
											}
										echo '</li>';
									}
								?>
								</ul>
							</div>
						</div>
					</div>
					<?}?>
				</div>
				<div class="table__value">
					<?if(in_array('data', $price_settings)) {?>
						<span class="table__value_data">до <span class="js-ending-stocks"></span></span>
					<?}
					if(in_array('list', $price_settings)) {
						$price_list = $price['price_list'];
						if(is_array($price_list)) {
							echo '<ul>';
								foreach($price_list as $list) {
									echo '<li>';
									$price_higher = $list['price_higher'];
									$price_main = $list['price_main'];
									$price_main_space = number_format((int)$price_main, 0, '', ' ');
									if($price_higher) {
										echo '<span class="table__value_price">';
											echo ($price_main == 0) ? 'Бесплатно' : (($price_at) ? 'от ' : null).'' . $price_main_space.' ₽ и выше';
										echo '</span>';
									}
									else {
										$price_sale = $list['price_sale'];
										$price_sale_space = number_format((int)$price_sale, 0, '', ' ');
										if((is_numeric($price_main)) && (is_numeric($price_sale))) {
											echo '<span class="table__value_old-price">';
											echo ($price_main == 0) ? '' : (($price_at) ? 'от ' : null).'' . $price_main_space.' ₽';
											echo '</span>';
											echo '<span class="table__value_price">';
											
											echo ($price_sale == 0) ? 'Бесплатно' : (($price_at) ? 'от ' : null).'' . $price_sale_space.' ₽';
											echo '</span>';
										}
										if((is_numeric($price_main)) && (!is_numeric($price_sale))) {
											echo '<span class="table__value_price">';
											echo ($price_at) ? 'от ' : null;
											echo $price_main_space.' ₽';
											echo '</span>';
										}

									}
									echo '</li>';
								}
							echo '</ul>';
						}
					}else {
						$price_main = $price['price_main'];
						$price_sale = $price['price_sale'];
						$price_main_space = number_format((int)$price_main, 0, '', ' ');
						$price_sale_space = number_format((int)$price_sale, 0, '', ' ');
						if((is_numeric($price_main)) && (is_numeric($price_sale))) {
							echo '<span class="table__value_old-price">';
							
							echo ($price_main == 0) ? '' : (($price_at) ? 'от ' : null).'' . $price_main_space.' ₽';
							echo '</span>';
							echo '<span class="table__value_price">';
							
							echo ($price_sale == 0) ? 'Бесплатно' : (($price_at) ? 'от ' : null).'' . $price_sale_space.' ₽';
							echo '</span>';
						}
						if((is_numeric($price_main)) && (!is_numeric($price_sale))) {
							echo '<span class="table__value_price">';
							echo ($price_at) ? 'от ' : null;
							echo $price_main_space.' ₽';
							echo '</span>';
						}
					}

					?>
				</div>
			</div>
			<?
		}
	}
}

function btn_form_generation_modal($type_form, $size_form, $title_open, $page_id, $location = false) {
    $settings_forms = get_field('settings_forms', 'options');
    $metric_key = get_field('metric_key', 'options');
    $check_bot = get_field('check_bot', 'options');
    
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
			$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			$url = explode('?', $url);
			$page_url = $url[0];
			if (is_archive()) {
				$page_title = single_term_title('',false);
			}else {
				$page_title = single_post_title('',false);
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
					'page_title' => $page_title,
					'page_url' => $page_url,
                    'metrica_key' => $metric_key,
                    'metrica_value' => $field_forms['type_form_value'],
                    // 'option_select' => ((is_tax('doctors')) ? $doctor_full_name : false),
                    'check' => $check_bot
                ],
            ];
        }
    }
    $settings = base64_encode(json_encode($data));
    if($location == 'header') {
        echo '<div class="btn-border js-popup" data-settings="'.$settings.'">'.(($title_open) ? $title_open : 'Заказать звонок').'</div>';
    }	
	else if ($location == 'footer') {
        echo '<button class="footer__question js-popup" data-settings="'.$settings.'">'.(($title_open) ? $title_open : 'Заказать звонок').'</button>';
    }
	else if ($location == 'ymaps') {
		echo '<button class="btn-line js-popup" data-settings="'.$settings.'">'.(($title_open) ? $title_open : 'Заказать звонок').'</button>';
	}else if ($location == 'mini_banner' || $location == 'single_doctor') {
		echo '<button class="btn js-popup" data-settings="'.$settings.'">'.(($title_open) ? $title_open : 'Заказать звонок').'</button>';
	}
	else if ($location == 'main' || $location == 'category' || $location == 'doctor_slider' || $location == 'specialization' || $location == 'vacancy') {
		echo '<button class="btn js-popup" data-settings="'.$settings.'">'.(($title_open) ? $title_open : 'Заказать звонок').'</button>';
	}

}

function btn_generation_modal($field, $page_id, $settings_form = false){
	if($field == true) {
		$settings = get_field('modal_group', 'options');
		if(is_array($settings)) {
			foreach($settings as $key => $nav) {
				if($key == $field.'_group') {
					$group = $nav;
					if($group['navigation'] == 'popup'){
						$type_form = $nav['type_form'];
						$title_open = $nav['title_open'];
						$size_form = $nav['size_form'];
						$location = $field;
						btn_form_generation_modal($type_form, $size_form, $title_open, $page_id, $location);
					}else if ($group['navigation'] == 'link') {
						if(!empty($group['link'])) {
							echo '<a href="'.$group['link']['url'].'"';
								if($location == 'header') {
									echo ' class="btn-border"';
								}	
								else if ($location == 'footer') {
									echo ' class="footer__question"';
								}
								else if ($location == 'ymaps') {
									echo ' class="btn-line"';
								}else if ($location == 'mini_banner' || $location == 'single_doctor' || $location == 'category' || $location == 'doctor_slider' || $location == 'specialization' || $location == 'vacancy') {
									echo ' class="btn"';
								}
							echo '>'.$group['link']['title'].'</a>';
						}
					}
				}
				else {
					continue;
				}   
			}
		}
	}
	else if($settings_form == true) {
		$type_form = $settings_form['type_form'];
		$title_open = $settings_form['title_open'];
		$size_form = $settings_form['size_form'];
		$location = $settings_form['location'];
		btn_form_generation_modal($type_form, $size_form, $title_open, $page_id, $location);
	}
}