<?if(!defined('ABSPATH')){exit;}
$args = get_query_var('global_params');


$display_type = get_sub_field('display_type');
$subtitle_on = get_sub_field('subtitle_on');
$subtitle = get_sub_field('subtitle');

// $subtitle_on = get_sub_field('subtitle_on');
// $subtitle = get_sub_field('subtitle');

// $title = get_sub_field('title');
// $description = get_sub_field('description');
// $btn_title = get_sub_field('btn_title');

$phones_on = get_sub_field('phones_on');



$type_form = get_sub_field('type_form');
$settings_forms = get_field('settings_forms', 'options');

foreach($settings_forms as $field_forms) {
	if($field_forms['type_form_label'] == $type_form) {
		$title = $field_forms['title'];
		$description = $field_forms['subtitle'];
		$title_send = $field_forms['title_send'];
		$editor_form = $field_forms['editor_form'];
		$metrica_value = $field_forms['type_form_value'];
		// echo '<pre>';
		// print_r($field_forms);
		// echo '</pre>';
	}
}

echo '<section class="form-block';
echo ($display_type == 'consultant') ? ' form-block-consultation' : null;
echo ($phones_on) ? ' form-block-consultation-phones' : null;
echo '">';
	echo '<div class="container">';
		echo '<div class="form-block__container">';
			if($display_type == 'consultant') {
			echo '<div class="consultation">';
				echo '<div class="consultation__svg">';
					echo '<svg width="513" height="383" viewBox="0 0 513 383" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M444.604 38.4384C534.247 93.5784 520.748 194.643 485.256 279.866C470.123 316.203 449.696 352.96 422 383L78.0004 383C48.646 357.057 26.1607 325.295 12.6451 291.067C-22.4688 202.14 19.1769 106.785 113.853 51.4142C211.921 -5.94036 348.243 -20.8337 444.604 38.4384Z" fill="white" /> </svg>';
						if($phones_on) {
						if(isset($args['contacts'])) {
							$phones = $args['contacts'];
							echo '<div class="phones">';
								foreach ($phones as $key => $phone) {
									$label = $phone['label'];
									$phone = $phone['phones'];
									$phones_array = (is_array($phone)) ? true : false;
									echo '<div class="phones_item">';
										echo '<img src="'.get_stylesheet_directory_uri().'/assets/img/wp/form/'.$key .'.svg" alt="'.$label.'">';
										echo '<span>'.$label.'</span>';
										if($phones_array) {
											foreach ($phone as $val) {
												echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $val).'">'.$val.'</a>';
											}
										}else {
											echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $phone).'">'.$phone.'</a>';
										}
									echo '</div>';
								}
							echo '</div>';
						}
					}
				echo '</div><span class="consultation__img"></span></div>';
			}
			echo '<div class="form-wrapper">';
				echo '<div class="form-content">';
					
					echo '<h2 class="form-content_title">';
						echo ($title) ? $title : 'Мы подскажем!';
					echo '</h2>';
					if(is_front_page()) {
						echo ($subtitle_on && $subtitle) ? '<div class="form-content_subtitle">'.$subtitle.'</div>' : null;
					}
					if($description) {
						echo '<div class="form-content_descr">'.$description.'</div>';
					}

					

				echo '</div>';

				$page_id = get_queried_object_id();
				$metric_key = get_field('metric_key', 'options');
				$check_bot = get_field('check_bot', 'options');
				$layout = get_row_layout();
				$row_count = get_sub_field('row_count');
				echo ($layout == 'fqu') ? '<form method="POST" class="form form-main form-comment" action="user_forms_action">' : '<form method="POST" class="form form-main" action="user_forms_action">';
				?>
				

					<?

					$bottom_register = mb_strtolower($type_form);
					$check_type_form_blank = false;
					if (strpos($bottom_register, 'справка') !== false)
					{
						$check_type_form_blank = true;
					}
					
					// echo '<pre>';
					// print_r($editor_form);
					// echo '</pre>';

			
					$field_rating = false;
					if(!empty($editor_form)) {
						$count_editor_form = count($editor_form);
						for($i = 0; $i < $count_editor_form; $i++) {
							$field = $editor_form[$i]['acf_fc_layout'];
							if ($field == "name") $type = "text";
							if ($field == "tel") $type = "tel";
							if ($field == "email") $type = "email";
							if ($field == "message") $type = "text";
							if ($field == "file") $type = "file";
							if ($field == "select") continue;

							$required_check = $editor_form[$i]['required'];
							$placeholder = $editor_form[$i]['placeholder'];

							if($field == 'rating') {
								$field_rating = true;
							}
						
							if($row_count !== 1) {
								if($field_rating) {
									echo ($i == 1) ? '<div class="form__no-wrap">' : '';
								}else {
									echo ($i == 0) ? '<div class="form__no-wrap">' : '';
								}

							}
							echo ($required_check) ? '<div class="form__field tooltiper"><span class="tooltip">Обязательное поле</span>' : '<div class="form__field">';
								if($field == 'message') {
									echo '<textarea name="'.$field.'" placeholder="'.(($required_check) ? $placeholder.'*' : $placeholder).'"></textarea>';
								}

								else if($field == 'file') {
									echo '
										<div class="input-file-row">
											<label class="input-file">
												<div class="input-file__descr"> <span class="input-file__descr_title">'.$placeholder.'</span> <span class="input-file__descr_subtitle">Одно фото в формате jpeg, jpg, png или webp</span> </div>
												<input type="file" style="background:#E9F2FF" name="file" accept=".jpg,.jpeg,.png,.webp"> </label>
											<div class="input-file-list"></div>
										</div>';
								}
								else if ($field == 'rating') {
									echo '
									<div class="score">
										<div class="score__descr"> <span class="score__descr_title">Оценка:</span>
											<div class="simple-rating">
												<div class="simple-rating__items">';
													$count_rating = 5;
													for($rat = 0; $rat < 5; $rat++) {
														echo '
														<input id="simple-rating__'.$count_rating.'" type="radio" class="simple-rating__item" name="simple-rating" value="'.$count_rating.'">
														<label for="simple-rating__'.$count_rating.'" class="simple-rating__label"></label>';
														$count_rating--;
													}
												echo '	
												</div>
											</div>
										</div>
									</div>
								';
								}
								else {
									echo '<input type="'.$type.'" name="'.$field.'" placeholder="'.(($required_check) ? $placeholder.'*' : $placeholder).'">';
								}

							echo '</div>';

							if($row_count !== 1) {

								if($field_rating) {
									echo ($i == ($row_count)) ? '</div>' : '';
								}else {
									echo ($i == ($row_count-1)) ? '</div>' : '';
								}
							}
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

					?>


					<div class="form__hidden">
						<input type="hidden" name="form_name" value="<?=$type_form;?>" readonly>
						<input type="hidden" name="form_title" value="<?=$title;?>" readonly>
						<input type="hidden" name="page_title" value="<?=$page_title;?>" readonly>
						<input type="hidden" name="page_url" value="<?=$page_url;?>" readonly>
						<input type="hidden" name="metrica_key" value="<?=$metric_key;?>" readonly>
						<input type="hidden" name="metrica_value" value="<?=$metrica_value;?>" readonly>
						<!-- <input type="hidden" name="option_select" value="false"> -->
						<!-- <input type="hidden" name="requires" value="tel,name"> -->
						
						<input type="hidden" name="check" value="<?=$check_bot;?>">
					</div>
					<div class="form__hidden_wp">
						<?
						wp_nonce_field('backend-nonce', 'check_nonce');
						
						if($layout == 'fqu') {
							echo '<input type="hidden" name="comment_post_ID" value="'.$page_id.'" id="comment_post_ID">';
							wp_comment_form_unfiltered_html_nonce();
						}
						
						
						?>

					</div>
					
					<?
					$title_send_echo = ($title_send) ? $title_send : 'Отправить заявку';
					echo '
						<div class="form__submit">
							<button class="btn" type="submit" data-return-text="'.$title_send_echo.'">'.$title_send_echo.'</button>
							<span class="form__submit_checkbox">Нажимая на кнопку “'.$title_send_echo.'”, вы даете согласие на обработку <a href="'.get_privacy_policy_url().'" target="_blank">персональных данных</a></span>
						</div>
					';
				echo '</form>';
				
				if (strpos($bottom_register, 'отзыв') !== false){
					echo '<img class="form-wrapper__img" src="'.get_stylesheet_directory_uri().'/assets/img/bg/reviews.png" alt="">';
				}

			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</section>';