<?if(!defined('ABSPATH')){exit;}
$get_data = get_sub_field('get_data');

$object = get_queried_object();
$current_year = date("Y");

// print_r($object);
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$description = get_sub_field('description');

$params_sub_field = [
	'title' => $title,
	'subtitle' => $subtitle,
	'description' => $description
];

$display_type = get_sub_field('display_type');
$default_img = get_template_directory_uri().'/assets/img/wp/doctor/default.png';
$doctors = array();

$post_tags_specialization = get_terms([
	'taxonomy' => 'post_tag',
	'hide_empty' => 0,
	'parent' => 0,
	'post_status' => 'publish', 
	'orderby' => 'meta_value',
	'order' => 'ASC',
]);

$post_tags_doctors = get_terms([
	'taxonomy' => 'doctors',
	'hide_empty' => 0,
	'parent' => 0,
	'post_status' => 'publish', 
	'orderby' => 'meta_value',
	'order' => 'ASC',
]);

if($get_data == 'auto') {
	if((is_tag()) || ((is_page()) || (is_category()))) {
		$term = $object->slug;
		if(is_tag()) {
			$term_title = single_term_title('',false);
			$term_title = mb_strtolower($term_title);
			$last_symbol = mb_substr($term_title, -1);
			if (strpos($term_title, '-') !== false) {
				$term_title_s = str_replace('-', 'и-', $term_title);
				$term_title_s = implode(array($term_title_s, 'ы'));
			}
			else {
				if($last_symbol == 'т' || $last_symbol == 'д') {
					$term_title_s = implode(array($term_title, 'ы'));
				}
				else if($last_symbol == 'г') {
					$term_title_s = implode(array($term_title, 'и'));
				}
			}
		}else if ((is_page()) || (is_category())) {
			$term_title = 'Все врачи';
			$term_title_s = $term_title;
		}

		$professions_text = '';
		foreach($post_tags_doctors as $tag ){
			$term_id = $tag->term_id;
			$name = $tag->name;
			$slug = $tag->slug;
			$surname = get_field('specialist-name', 'doctors_'.$term_id);
			$img = get_field('specialist-img', 'doctors_'.$term_id);
			$experience = get_field('experience', 'doctors_'.$term_id);
			$professions = get_field('specialist-profession', 'doctors_'.$term_id);
			$experience_year = $current_year - $experience;

			foreach($professions as $key_value => $value) {
				if($key_value == 0) {
					if((count($professions)) == 1) {
						$professions_text .= $value->name;
					}else {
						$professions_text .= $value->name.', ';
					}
				}
				else if($value == end($professions)) {
					$professions_text .= mb_strtolower($value->name);
				}else {
					$professions_text .= mb_strtolower($value->name).', ';
				}
			}

			$params_doctor = [
				'name' => $name,
				'surname' => $surname,
				'slug' => $slug,
				'img' => ($img) ? $img : $default_img,
				'experience' => 'Стаж '.$experience_year.' '.inclination_years(substr($experience_year, -1), $experience_year),
				'professions_array' => $professions,
				'professions_text' => $professions_text,
				'term_title' => $term_title,
				'term_title_s' => ($term_title_s) ? $term_title_s : null
			];

			if(is_tag()) {
				foreach($professions as $item) {
					if(($item->slug) == $term) {
						$doctors[] = $params_doctor;
					}
				}
			}
			else if(is_page() || (is_category())) {
				$doctors[] = $params_doctor;
			}

			$professions_text = null;

		}
		if($display_type == 'list') {
			$filter_on = get_sub_field('filter_on');
			list_doctors_echo($doctors, $filter_on, $post_tags_specialization);
		}
		else if($display_type == 'slider') {
			$display_type_slider = get_sub_field('display_type_slider');
			$filter_on = get_sub_field('filter_on');
			$advantages_on = get_sub_field('advantages_on');
			if($advantages_on) {
				$advantages_list = get_sub_field('advantages_list');
			}
			slider_doctors_echo($doctors, $filter_on, $post_tags_specialization, $display_type_slider, $params_sub_field, (($advantages_on) ? $advantages_list : null));
		}
	}

}else if($get_data = 'custom') {
	$settings_params = get_sub_field('settings_params');

	if(!empty($settings_params)) {
		$term = $settings_params->slug;
		$term_title = $settings_params->name;
		$term_title = mb_strtolower($term_title);
		$last_symbol = mb_substr($term_title, -1);
		if (strpos($term_title, '-') !== false) {
			$term_title_s = str_replace('-', 'и-', $term_title);
			$term_title_s = implode(array($term_title_s, 'ы'));
		}
		else {
			if($last_symbol == 'т' || $last_symbol == 'д') {
				$term_title_s = implode(array($term_title, 'ы'));
			}
			else if($last_symbol == 'г') {
				$term_title_s = implode(array($term_title, 'и'));
			}
		}
	}else {
		$term_title = 'Все врачи';
		$term_title_s = $term_title;
	}
	$professions_text = '';
	foreach($post_tags_doctors as $tag ){
		$term_id = $tag->term_id;
		$name = $tag->name;
		$slug = $tag->slug;
		$surname = get_field('specialist-name', 'doctors_'.$term_id);
		$img = get_field('specialist-img', 'doctors_'.$term_id);
		$experience = get_field('experience', 'doctors_'.$term_id);
		$professions = get_field('specialist-profession', 'doctors_'.$term_id);
		$experience_year = $current_year - $experience;
		foreach($professions as $key_value => $value) {
			if($key_value == 0) {
				if((count($professions)) == 1) {
					$professions_text .= $value->name;
				}else {
					$professions_text .= $value->name.', ';
				}
			}
			else if($value == end($professions)) {
				$professions_text .= mb_strtolower($value->name);
			}else {
				$professions_text .= mb_strtolower($value->name).', ';
			}
		}
		$params_doctor = [
			'name' => $name,
			'surname' => $surname,
			'slug' => $slug,
			'img' => ($img) ? $img : $default_img,
			'experience' => 'Стаж '.$experience_year.' '.inclination_years(substr($experience_year, -1), $experience_year),
			'professions_array' => $professions,
			'professions_text' => $professions_text,
			'term_title' => $term_title,
			'term_title_s' => ($term_title_s) ? $term_title_s : null
		];
		if(!empty($settings_params)) {
			foreach($professions as $item) {
				if(($item->slug) == $term) {
					$doctors[] = $params_doctor;
				}
			}
		}else {
			$doctors[] = $params_doctor;
		}

		$professions_text = null;

	}

	if($display_type == 'list') {
		$filter_on = get_sub_field('filter_on');
		list_doctors_echo($doctors, $filter_on, $post_tags_specialization);
	}
	else if($display_type == 'slider') {
		$display_type_slider = get_sub_field('display_type_slider');
		$filter_on = get_sub_field('filter_on');
		$advantages_on = get_sub_field('advantages_on');
		if($advantages_on) {
			$advantages_list = get_sub_field('advantages_list');
		}
		slider_doctors_echo($doctors, $filter_on, $post_tags_specialization, $display_type_slider, $params_sub_field, (($advantages_on) ? $advantages_list : null));
	}

}

function sorting_select_specialization($class = null, $post_tags_tag){
	$list_array = get_sub_field('specialization_list');
	$item_array = array();
	if( (!empty($list_array)) && (count($list_array) > 1) ) {
		foreach ($list_array as $item) {
			$slug = (empty($item['specialization']->slug)) ? 'terms-all' : $item['specialization']->slug;
			$label = $item['label'];
			$label = (empty($label)) ? $item['specialization']->name : $label;
			$item_array[] = [
				'slug' => $slug,
				'label' => $label
			];
		}
	}
	else {
		foreach ($post_tags_tag as $item) {
			$slug = $item->slug;
			$label = $item->name;
			$item_array[] = [
				'slug' => $slug,
				'label' => $label
			];
		}
		$first_item = array('slug'=>'terms-all','label'=>'Все специалисты');
		array_unshift($item_array, $first_item);
	}
		$params = [
			'type_filter' => 'doctors',
			'items' => $item_array,
			'sorting_class' => $class
		];

		get_template_part('parts/components/standart/select', null, $params);
}


function list_doctors_echo($doctors, $filter_on = false, $post_tags_tag) { ?>
	<section class="doctors">
		<div class="doctors__container">
			<div class="nav-block filter">
				<?
				if($filter_on) {
					$sorting_class = ' grid';
					sorting_select_specialization($sorting_class, $post_tags_tag);
				}
				?>
			</div>
			<div class="doctors__body js-list-doctors">
			<?
				foreach($doctors as $val){
					$params_doctor = [
						'name' => $val['name'],
						'surname' => $val['surname'],
						'slug' => $val['slug'],
						'img' => $val['img'],
						'experience' => $val['experience'],
						'professions_array' => $val['professions_array']
					];
					get_template_part('parts/components/project/card-doctor', null, $params_doctor);
				}
			?>
			</div>
		</div>
	</section>
<?}

function slider_doctors_echo($doctors, $filter_on = false, $post_tags_tag = false, $type_slider, $args = false, $advantages = false ) {
	// print_r($doctors);
	if($type_slider == 'mini') {?>
		
		<section class="info-doctors">
			<div class="info-doctors__container">
				<div class="info-doctors__header">
					<h2><?=($args['title']) ? $args['title'] : 'Виртуозы своего дела';?></h2>
					<div class="info-descr">
						<h3><?=($args['subtitle']) ? $args['subtitle'] : 'Специалисты с опытом и стажем 10-37 лет';?></h3>
						<p><?=($args['description']) ? $args['description'] : 'Ежегодно подтверждаем квалификацию наших врачей на профильных курсах, семинарах и мастер-классах. Проведём осмотр составив план лечения с точным сроком и фиксированной ценой!';?></p>
					</div>
					
					<?
					if($advantages) {
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
					?>
					
				</div>
				<div class="info-doctors__body swiper">
					<nav class="info-doctors__nav">
						<?
						if($filter_on) {
							sorting_select_specialization(null, $post_tags_tag);
						}		


                        echo '<a href="'.get_field('page_doctors', 'options').'" class="btn-see"><span class="circle" aria-hidden="true"><span class="icon arrow"></span></span><span class="button-text">
						Все специалисты
                        </span></a>';

						?>

						<div class="slider-nav">
							<div class="doctors-prev slider-prev"></div>
							<div class="doctors-next slider-next"></div>
						</div>
					</nav>

					<div class="swiper-wrapper js-list-doctors">
					<?
						foreach($doctors as $val){
							$params_doctor = [
								'name' => $val['name'],
								'surname' => $val['surname'],
								'slug' => $val['slug'],
								'img' => $val['img'],
								'experience' => $val['experience'],
								'professions_array' => $val['professions_array']
							];
							get_template_part('parts/components/project/card-doctor', null, $params_doctor);
						}
						?>
					</div>
				</div>
			</div>
		</section>
	<?

	}
	else if($type_slider == 'big') {
		?>
		<section class="silder-doctors <?=(count($doctors) > 1) ? 'childs' : 'child';?>">
			<div class="silder-doctors__container">
				<div class="silders__wrapper">
					<div class="silder-doctors__swiper swiper">
						<div class="silder-doctors__wrapper swiper-wrapper">
							<?
								foreach($doctors as $args) {
									$term_title_content = (count($doctors) < 2) ? 'Ведущий '.$args['term_title'].'' : (($args['term_title_s']) ? 'Ведущие '.$args['term_title_s'].'' : 'Ведущие '.$args['term_title'].'');
									echo '<div class="silder-doctors__slide doctor swiper-slide">
									<div class="doctor__title">'.$term_title_content.'</div>
									<div class="doctor__descr">
										<h2 class="doctor__descr_name">
											<span>'.$args['name'].'</span>
											<span>'.$args['surname'].'</span>
										</h2>
										<p class="doctor__descr_text">'.$args['professions_text'].'</p>
										<p class="doctor__descr_practice">'.$args['experience'].'</p>
										<div class="doctor__descr_btn">';

											// 
											btn_generation_modal('doctor_slider', get_queried_object_id());
											// <button class="btn js-popup">Записаться на прием</button>

											echo '
											<a href="/doctors/'.$args['slug'].'" class="btn-line">
												<span class="btn__descr">Подробнее</span>&nbsp;
												<span class="btn__title">о враче</span>
											</a>
										</div>
									</div>
									<div class="doctor__img">
										<img src="'.$args['img'].'" alt="'.$args['name'].' '.$args['surname'].'">
									</div>
								</div>';
								}
							?>

						</div>
					</div>

					<!-- Маленький слайдер справа -->
					<div class="silder-thumbs">
						<div class="silder-thumbs__wrapper">
							<div class="doctors-thumbs swiper">
								<div class="doctors-thumbs__wrapper swiper-wrapper">
									<?
									foreach($doctors as $args) {
										echo '
										<div class="doctors-thumbs__slide swiper-slide">
											<div class="doctors-thumbs__title">
												<span>'.$args['name'].'</span>
												<span>'.$args['surname'].'</span>
											</div>
											<div class="doctors-thumbs__img">
												<img src="'.$args['img'].'" alt="'.$args['name'].' '.$args['surname'].'">
											</div>
										</div>';
									}
									?>
								</div>
							</div>
							<nav>
								<div class="doctor-prev slider-prev"></div>
								<div class="swiper-pagination">1 / 3</div>
								<div class="doctor-next slider-next"></div>
							</nav>
						</div>

						<?
                        echo '<a href="'.get_field('page_doctors', 'options').'" class="btn-see"><span class="circle" aria-hidden="true"><span class="icon arrow"></span></span><span class="button-text">
						Все специалисты
                        </span></a>';

						?>
					</div>
				</div>
			</div>
		</section>

	<?
	}
}