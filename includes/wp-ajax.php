<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Проверка SMTP SERVER
if (is_admin()) {
	add_action( 'wp_ajax_test_smtp_action', 'test_smtp' );
	add_action( 'wp_ajax_nopriv_test_smtp_action', 'test_smtp' );
	function test_smtp() {
		if ( !wp_verify_nonce( $_POST['nonce'], 'backend-admin-nonce' ) ) {
			wp_send_json(array('test_smtp_message'=>__('ERROR-NONCE')));
			wp_die();
		}
		$email_to = get_field('mail_custom_SMTP_USER', 'options');
		$body = 'С вашего сайта <a href="'.get_site_url().'">' . get_bloginfo('name') .'</a> была отправлена проверка соединения сервера SMTP почты с вашим сайтом. Если вы получили это сообщение, то настройки сервера SMTP правильно настроены.';
		$theme = 'Test Server SMTP';
		$headers = 'From: WordPress <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;
		$sent_message = wp_mail($email_to, $theme, $body, $headers);
		if ($sent_message) {
			wp_send_json(array('test_smtp_message'=>__('OK')));
		}else {
			wp_send_json(array('test_smtp_message'=>__('ERROR')));
		}
		wp_die();
	}
}
// Фильтр
add_action( 'wp_ajax_filter_action', 'frontend_filter' );
add_action( 'wp_ajax_nopriv_filter_action', 'frontend_filter' );
function frontend_filter() {
	if ( empty($_POST) || !wp_verify_nonce( $_POST['check_nonce'], 'backend-nonce' ) ) {
		echo json_encode(array('frontend_filter_message'=>__('ERROR-NONCE')));
		wp_die();
	}
	$type_filter = $_POST['type_filter'];
	$terms = $_POST['terms'];
	$search = array();
	$list = array();
	if($type_filter === 'doctors') {
		
		$post_tags = get_terms([
			'taxonomy' => 'doctors',
			'hide_empty' => 0,
			'parent' => 0,
			'post_status' => 'publish', 
			'meta_key' => 'tax_position',
			'orderby' => 'tax_position',
			'order' => 'ASC',
		]);
		
		$default_img = get_template_directory_uri().'/assets/img/wp/doctor/default.png';
		
		foreach($post_tags as $tag ){
			$term_id = $tag->term_id;
			$professions = get_field('specialist-profession', 'doctors_'.$term_id);
			$professions_array = array();
            foreach($professions as $value) {
				$professions_array[] = [
					'slug' => $value->slug,
					'title' => mb_strtolower($value->name)
				];
			}
			$slug = $tag->slug;
			$name = $tag->name;
			$surname = get_field('specialist-name', 'doctors_'.$term_id);
			$img = get_field('specialist-img', 'doctors_'.$term_id);
			$experience = get_field('experience', 'doctors_'.$term_id);
			$current_year = date("Y");
			$experience_year = $current_year - $experience;
			$experience = 'Стаж '.$experience_year .' '.inclination_years(substr($experience_year, -1), $experience_year);
			if($terms !== 'terms-all') {
				foreach($professions as $item) {
					if(($item->slug) == $terms) {
						$params_doctor = [
							'name' => $name,
							'surname' => $surname,
							'slug' => $slug,
							'img' => ($img) ? $img : $default_img,
							'experience' => $experience,
							'professions' => $professions_array,
							'selected-terms' => $terms
						];
						$search[] = $params_doctor;
					}
				}
			}
			else {
				$params_doctor = [
					'name' => $name,
					'surname' => $surname,
					'slug' => $slug,
					'img' => ($img) ? $img : $default_img,
					'experience' => $experience,
					'professions' => $professions_array,
					'selected-terms' => $terms
				];
				$search[] = $params_doctor;
			}
		}
		// echo json_encode( array('frontend_filter_message' => $search));
	}

	else if($type_filter === 'services') {
		$taxonomy = $_POST['taxonomy'];
		if($taxonomy == 'category') {
			$term_id = $_POST['term_id'];
			$index_row = $_POST['index_row'];
			$get_content = get_field_object('blocks', $taxonomy.'_'.$term_id)['value'][$index_row]['types_repeater'][$terms];

			$link_id = $get_content['link'];
			$params_category = [
				'title_filter' => $get_content['title_filter'],
				'title' => $get_content['title'],
				'link' => ($link_id) ? get_term_link($link_id) : null,
				'img' => $get_content['img'],
				'editor' => $get_content['editor'],
				'selected-terms' => (int)$terms
			];
			$search[] = $params_category;
		}
		else if($taxonomy == 'portfolio') {
			$clear = $_POST['clear'];
			$count = $_POST['count'];
			$upload = $_POST['upload'];
			$tag_portfolio = get_terms([
				'taxonomy' => $taxonomy,
				'hide_empty' => 0,
				'parent' => 0,
				'post_status' => 'publish', 
				'orderby' => 'meta_value',
				'order' => 'ASC',
			]);

			$post_portfolio = array();
			foreach($tag_portfolio as $value) {
				$id_value = $value->term_id;
				$title = $value->name;
				$group = get_field('group', $taxonomy.'_'.$id_value.'');
				$category = $group['category'];
				$params = [
					'id' => $id_value,
					'title' => $title
				];
				if($terms == 'terms-all') {
					$post_portfolio[] = $params;
				}else {
					if((!empty($category)) && ($category == $terms)) {
						$post_portfolio[] = $params;
					}
				}
			}

			$count_check = 0;
			foreach($post_portfolio as $key => $item) {
				// $id = $item->term_id;
				$id = $item['id'];
				$group = get_field('group', $taxonomy.'_'.$id.'');
				$category = $group['category'];
				$doctors_obj = $group['doctors'];
				// $title = $item->name;
				$title = $item['title'];
				$editor = get_field('editor', $taxonomy.'_'.$id.'');
				$imgs_array = get_field('imgs', $taxonomy.'_'.$id.'');
				if($group['count_visits']) {
					$value_count = (int)$group['count_visits'];
					$count_visits = ($value_count == 1) ? $value_count.' визит' : (($value_count >= 2 && $value_count < 5) ? $value_count.' визита' : $value_count.' визитов');
				}
				if($group['cost']) {
					$cost = number_format((int)$group['cost'], 0, '', ' ');
				}
				if($doctors_obj) {
					$doctors_array = array();
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
						$terms_doctor = (($check_term) ? '' : 'Врач ');
						foreach($doctor_professions as $value) {
							$value = $value->name;
							$terms_doctor .= ($check_term) ? $value : mb_strtolower($value);
							$terms_doctor .= (next($doctor_professions)) ? ', ' : null;
						}
						$doctors = [
							'url' => get_term_link($doctor_id, 'doctors'),
							'img' => $doctor_img,
							'name' => $full_name,
							'term' => $terms_doctor
						];
						$doctors_array[] = $doctors;
					}
				}
				if(!empty($group['services'])) {
					$category_link = get_category_link($group['services']->term_id);
					$category_title = $group['services']->name;
				}

				$params_portfolio = [
					'doctors' => $doctors_array,
					'visits' => (($value_count) ? $count_visits : null),
					'cost' => (($cost) ? $cost.' ₽' : null),
					'title' => $title,
					'editor' => $editor,
					'img_before' => $imgs_array[0]['url'],
					'img_after' => $imgs_array[1]['url'],
					'category_link' => (($category_link) ? $category_link : null),
					'category_title' => (($category_title) ? $category_title : null),
					'key' => $key
				];

				if($clear == 'true') {
					if($count_check >= $upload) {
						break;
					}
					$list[] = $params_portfolio;
					$count_check++;
				}else {
					if($key >= $count) {
						if($count_check >= $upload) {
							break;
						}
						$list[] = $params_portfolio;
						$count_check++;
					}

				}
			}
			$search = [
				'list' => $list,
				'clear' => (($clear == 'true') ? 'true' : 'false'),
				'terms-uploaded' => $terms,
			];
		}
	}

	echo json_encode( array('frontend_filter_message' => $search));
	wp_die();
}

add_action( 'wp_ajax_load_content_action', 'frontend_load_content' );
add_action( 'wp_ajax_nopriv_load_content_action', 'frontend_load_content' );
function frontend_load_content() {
	if ( empty($_POST) || !wp_verify_nonce( $_POST['check_nonce'], 'backend-nonce' ) ) {
		echo json_encode(array('frontend_load_content'=>__('ERROR-NONCE')));
		wp_die();
	}
	$terms = $_POST['terms'];
	$count = $_POST['count'];
	$upload = $_POST['upload'];
	$search = array();
	$feedback_posts = get_posts( array(
		'posts_per_page' => -1,
		'category'    => 0,
		'orderby'     => 'date',
		'order'       => 'DESC',
		'post_type'   => 'post',
		'post_status' => 'publish',
		'suppress_filters' => true,
	));
	global $post;
	// $first_item = true;
	// $last_item = false;
	$count_check = 0;
	foreach($feedback_posts as $key => $post ){
		setup_postdata( $post );
		if($key >= $count) {
			if($count_check >= $upload) {
				break;
			}
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
				$source = get_field('source', $id);
				$star_count = get_field('star-count', $id);
				$format = 'j F Y';
				$data = get_the_date($format);
				$name = strval(get_the_title());
				$params_feedback = [
					'name' => $name,
					'name_first_symbol' => strtoupper(mb_substr($name, 0, 1)),
					'comment' => get_the_content(),
					'doctor' => ($doctor_term) ? $doctor_full_name : null,
					'source'=> $source,
					'count' => $star_count,
					'data' => $data
				];
				$search[] = $params_feedback;
			}
			$count_check++;
		}
	}
	wp_reset_postdata();
	echo json_encode( array('frontend_load_content' => $search));
	wp_die();
}

// Формы комментарий wp
// add_action( 'wp_ajax_user_forms_comment_action', 'frontend_form_comment' );
// add_action( 'wp_ajax_nopriv_user_forms_comment_action', 'frontend_form_comment' );
// function frontend_form_comment() {
// 	$check_bot = get_field('check_bot', 'options');
// 	if ( empty($_POST) || !wp_verify_nonce( $_POST['check_nonce'], 'backend-nonce') || ($_POST['check'] !== $check_bot) ){
// 		wp_send_json(array('frontend_form_message'=>__('ERROR-NONCE')));
// 		wp_die();
// 	}
// 	else {
// 		wp_send_json(array('frontend_form_message'=>__('OK')));
// 	}

// }

// Формы обратной связи
add_action( 'wp_ajax_user_forms_action', 'frontend_form' );
add_action( 'wp_ajax_nopriv_user_forms_action', 'frontend_form' );
function frontend_form() {
	$check_bot = get_field('check_bot', 'options');
	// $check_bot = 'sss';
	if ( empty($_POST) || !wp_verify_nonce( $_POST['check_nonce'], 'backend-nonce') || ($_POST['check'] !== $check_bot) ){
		wp_send_json(array('frontend_form_message'=>__('ERROR-NONCE')));
		wp_die();
	}
	else {
		$err_message = array();
		$valid_array = array();

		// $valid = $_POST['requires'];

		$form_name = $_POST['form_name'];
		$settings_forms = get_field('settings_forms', 'options');

		foreach($settings_forms as $field_forms) {
			if($field_forms['type_form_label'] == $form_name) {
				$editor_form =  $field_forms['editor_form'];
				if(!empty($editor_form)) {
					$count_editor_form = count($editor_form);
					for($i = 0; $i < $count_editor_form; $i++) {
						$field = $editor_form[$i]['acf_fc_layout'];
						$required_check = $editor_form[$i]['required'];
						if($required_check) {
							$valid_array[] = $field;
						}
					}
				}
			}
		}
		
		// $valid_array = explode(',', $valid);
		$name = $_POST['name'];
		$tel = $_POST['tel'];
		$email = $_POST['email'];
		$comments = $_POST['message'];

		function check_phone($tel) {
			$clean_str_tel = mb_eregi_replace('[^0-9]', '', $tel);
			if (empty($tel) || !isset($tel)) {
			} elseif (mb_strlen($clean_str_tel) !== 11) {
			} else {
				return true;
			}
			return false;
		}

		function check_email($email) {
			if (empty($email) || ! isset($email)) {
			} elseif (!preg_match( '/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i', $email)) {
			} else {
				return true;
			}
			return false;
		}

		if (in_array('tel', $valid_array)) {
			if (check_phone($tel)) {
				$tel = sanitize_text_field($tel);
			} else {
				$err_message['tel'] = '';
			}
		}

		if (in_array('email', $valid_array)) {
			if (check_email($email)) {
				$email = sanitize_text_field($email);
			} else {
				$err_message['email'] = '';
			}
		}

		if (in_array('message', $valid_array)) {
			if(!empty($comments)) {
				$comments = sanitize_text_field($comments);
			}
			else {
				$err_message['message'] = '';
			}
		}

		if (in_array('name', $valid_array)) {
			if(!empty($name)) {
				$name = sanitize_text_field($name);
			}
			else {
				$err_message['name'] = '';
			}
		}

		if ( $err_message ) {
			wp_send_json_error( $err_message );
			wp_die();
		} else {

			$messages = '';
			foreach ($_POST as $key => $value) {
				if ($value != ""
					&& $key != 'action'
					&& $key != 'metrica_key'
					&& $key != 'metrica_value'
					&& $key != 'page_title'
					&& $key != 'page_url'
					&& $key != 'check_nonce'
					&& $key != '_wp_http_referer'
					&& $key != 'option_select'
					&& $key != 'form_comment'
					&& $key != 'comment_post_ID'
					&& $key != '_wp_unfiltered_html_comment'
					&& $key != 'file_name'
					&& $key != 'file') {
					if ($key == "form_name") $key = "Тип формы";
					if ($key == "form_title") $key = "Заголовок формы";
					if ($key == "name") $key = "Имя";
					if ($key == "tel") $key = "Телефон";
					if ($key == "email") $key = "E-mail";
					if ($key == "message") $key = "Сообщение";
					if ($key == "simple-rating") $key = "Рейтинг";
					
					if ($key == "check") continue;

					$messages .= "
					<tr>
						<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
						<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
					</tr>
					";
				}
			}

			if ($messages) {
				$message = '';
				$website_addr = get_site_url();
				$company_name = get_bloginfo('name');

				$form_title = sanitize_text_field($_POST['form_title']);
				$page_title = sanitize_text_field($_POST['page_title']);
				$page_url = sanitize_text_field($_POST['page_url']);
				$metrica_key = sanitize_text_field($_POST['metrica_key']);
				$metrica_value = sanitize_text_field($_POST['metrica_value']);
				$file_html = sanitize_text_field($_POST['file_name']);

				
				if($_POST['form_comment'] == 'true') {
					$message .= 'Поступил новый комментарий "Вопрос - ответ" с сайта <a href="'.$website_addr.'">'.$company_name.'</a><br><br>';
					$theme = 'Поступил комментарий – '.$company_name;
				}else {
					$message .= 'Поступила новая заявка с сайта <a href="'.$website_addr.'">'.$company_name.'</a><br><br>';
					$theme = 'Поступила заявка – '.$company_name;
				}
				
				$message .= '<table>'.$messages.'';
				$message .= "<tr><td style='padding: 10px; border: #e9e9e9 1px solid;'><b>URL</b></td><td style='padding: 10px; border: #e9e9e9 1px solid;'><a href='".$page_url."'>".$page_title."</a></td></tr>";
				$message .= '</table>';
			
				$enabled_mail_smtp = get_field('enabled_mail_smtp', 'options');
				if ($enabled_mail_smtp == true) {
					$email_to = get_field('mail_custom_SMTP_USER', 'options');
				}else {
					$email_to = get_option('admin_email');
				}

				$body = $message;
				
				$headers = 'From: WordPress <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;


				if ($file_html) {
					$file_array = array();
					$file_array = (array) explode('||', $file_html );
					$url = WP_CONTENT_DIR.'/uploads/storage-file-mail/';
					$attachments = array();
					foreach($file_array as $index_file => $file) {
						$name_file = $file;
						$url_file = $url . $name_file;
						$attachments[] .= $url_file;
					}
					// Отправляем письмо
					$sent_message = wp_mail($email_to, $theme, $body, $headers, $attachments);
				}else {
					$sent_message = wp_mail($email_to, $theme, $body, $headers);
				}

				if ($sent_message) {
					if($_POST['form_comment'] == 'true') {
						wp_send_json(array('frontend_form_message'=>__('OK-COMMENT'), 'metrica_key' =>__($metrica_key), 'metrica_value' =>__($metrica_value)));
					}else {
						wp_send_json(array('frontend_form_message'=>__('OK'), 'metrica_key' =>__($metrica_key), 'metrica_value' =>__($metrica_value)));
					}
					

				}else {
					wp_send_json(array('frontend_form_message'=>__('ERROR')));
				}
			}else {
				wp_send_json(array('frontend_form_message'=>__('ERROR')));
			}
		}
	}
	wp_die();
}

add_action( 'wp_ajax_load_file_action', 'ajax_load_file_action' );
add_action( 'wp_ajax_nopriv_load_file_action', 'ajax_load_file_action' );
function ajax_load_file_action() {
	$check_bot = get_field('check_bot', 'options');
	// $check_bot = 'sss';
	if ( empty($_POST) || !wp_verify_nonce( $_POST['check_nonce'], 'backend-nonce') || ($_POST['check'] !== $check_bot) ){
		wp_send_json(array('frontend_form_message'=>__('ERROR-NONCE')));
		wp_die();
	}
	else {
		$uploaddir = ''.WP_CONTENT_DIR.'/uploads/storage-file-mail/';
		$max_size = 20 * 1024 * 1024;
		$valid_types 	=  array('jpg', 'jpeg', 'png', 'webp');
		if(!is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );
		$files      = $_FILES; // полученные файлы
		$done_files = array();
		foreach( $files as $file ){
			$file_name = $file['name'];
			$ext = substr($file_name, 1 + strrpos($file_name, "."));
	
			if ($file['size'] > $max_size) {
				//echo json_encode(array('message'=>__('Error: File size > 20Mb')));
				//die(json_encode('Error: File size > 20Mb.'));
			} elseif (!in_array($ext, $valid_types)) {

				die(json_encode(array('message'=>__('Error: Invalid file type '.$file_name.''))));
				//die(json_encode('Error: Invalid file type.'));
			} elseif( move_uploaded_file( $file['tmp_name'], "$uploaddir/$file_name" ) ) {
				$done_files[] = $file_name;
		  		// $done_files[] = 'https://' . $_SERVER['HTTP_HOST'] . '/wp-content/uploads/loading-file-mail/' . $file_name;
			}	
			$data = $done_files ? array('files' => $done_files ) : array('error' => 'Ошибка загрузки файлов.');
			//echo json_encode(array('message'=>__($data)));
			die(json_encode($data));
		}
	}
}

add_action( 'wp_ajax_sendcomment', 'send_weblitex_comment' );
add_action( 'wp_ajax_nopriv_sendcomment', 'send_weblitex_comment' );
function send_weblitex_comment() {
	$comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
	if ( is_wp_error( $comment ) ) {
		$data = (int) $comment->get_error_data();
		wp_send_json(array('frontend_form_message'=>__('ERROR')));
	}
	else {
		wp_send_json(array('frontend_form_message'=>__('OK')));
	}
	wp_die();
}