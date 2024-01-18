<?if(!defined('ABSPATH')){exit;}

$all_categories = get_categories(array(
	'hide_empty' => 0,
	'parent'  => 0,
	'meta_key' => 'tax_position',
	'orderby' => 'tax_position',
	'order' => 'ASC'
));

// echo '<pre>';
// print_r($all_categories);
// echo '</pre>';

$category_link_array = array();
$taxonomy = 'category';
if(is_array($all_categories)) {
	foreach($all_categories as $cat){
		$id = $cat->term_id;
		$slug = $cat->slug;
		$img = get_field('category_img', $taxonomy.'_'.$id);
		$category_main = get_field('category_main', $taxonomy.'_'.$id);
		$parent_check = $cat->parent;
		$category_link_array[] = [
			'term_id' => $id,
			'slug' => $slug,
			'name' => $cat->name,
			'img' => ($img) ? $img : null,
			'category_main' => (($category_main) ? $category_main : null),
			'parent-main' => (($parent_check == 0) ? true : false),
		];
	}
}

if(is_array($category_link_array)) {
	echo '<section class="price-catalog">';
		echo '<div class="price-catalog__container">';
		?>
			<nav class="price-catalog-nav sticky">
				<button>
					<svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg"><line x1="1.5" y1="5.5" x2="15.5" y2="5.5" stroke="#655A8F" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" /><line x1="1.5" y1="10.5" x2="15.5" y2="10.5" stroke="#655A8F" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round" /><line x1="1.5" y1="15.5" x2="15.5" y2="15.5" stroke="#655A8F" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round"/></svg>
					<span>Выбрать услугу</span>
				</button>

				<div class="price-catalog__nav-mob nav-mob sticky">
					<ul class="nav-mob__tabs">
						<li class="nav__item active">Стоматология</li>
						<li class="nav__item">Косметология</li>
						<li class="nav__item">SPA-центр</li>
					</ul>
					<div class="nav-mob__content">

						<?
						$group_cat = false;
						$prev_cat = array();
						foreach($category_link_array as $category_key => $item) {
							$term_id = $item['term_id'];
							$category_main = $item['category_main'];
							$cat_slug = $category_main['value'];
							$cat_title = $category_main['label'];
							if(!empty($prev_cat)) {
								$end_element = end($prev_cat);
								if($end_element == $cat_slug) {
									$group_cat = false;
								}else {
									$group_cat = true;
								}
							}else {
								$group_cat = true;
							}
							
							if($group_cat) {
								if($category_key > 0) {
									echo '</ul>';
								}
								if($category_key == 0) {
									echo '<ul class="active">';
								}
								else {
									echo '<ul>';
								}
							}
							$title = $item['name'];
							$slug = $item['slug'];
							echo '<li><a class="scroll-to" href="#'.$slug.'">'.$title.'</a></li>';
							$prev_cat[] = $cat_slug;
						}
						$prev_cat = null;
					echo '</div>';
				echo '</div>';
			echo '</nav>';

			echo '<div class="price-catalog__body">';

				echo '<span class="price-prosthetics__time">Последнее обновление <span class="js-last-update"></span></span>';

				echo '<div class="tables">';
					$group_cat = false;
					$dir_theme = get_stylesheet_directory_uri().'/assets/img/wp/price/';
					$prev_cat = array();
					foreach($category_link_array as $category_key => $item) {
						$term_id = $item['term_id'];
						$category_main = $item['category_main'];
						$cat_slug = $category_main['value'];
						$cat_title = $category_main['label'];
						if(!empty($prev_cat)) {
							$end_element = end($prev_cat);
							if($end_element == $cat_slug) {
								$group_cat = false;
							}else {
								$group_cat = true;
							}
						}else {
							$group_cat = true;
						}

						if($group_cat) {
							if($category_key > 0) {
								echo '</div>';
							}
							echo '<div class="tables__body">';
							echo '<h2 id="'.$cat_slug.'" style="background-image: url('.$dir_theme.'/'.$cat_slug.'.png); background-color: #E9F2FF;">'.$cat_title.'</h2>';
						}

						$title = $item['name'];
						$img = $item['img'];
						$slug = $item['slug'];
						echo '<div class="tables__title">';
							echo '<span id="'.$slug.'" class="anchor"></span>';
							echo (!empty($img)) ? '<div class="tables__title_img"><img src="'.$img.'" alt="'.$title.'"></div>' : null;
							echo '<h3>'.$title.'</h3>';
						echo '</div>';
						$prev_cat[] = $cat_slug;
						$get_content = get_field_object('blocks', $taxonomy.'_'.$term_id)['value'];
						if(is_array($get_content)) {
							foreach($get_content as $content) {
								if($content['acf_fc_layout'] == 'price') {
									$price_list = $content['price'];
								}
							}
							if(is_array($price_list)) {
								price_list_table($price_list);
							}
						}
					}
					$prev_cat = null;
					echo '</div>';
				echo '</div>';
			echo '</div>';

			echo '<div class="price-catalog__nav nav sticky">';
				echo '<ul class="nav__items">';
					$group_cat = false;
					$count = true;
					// $close = false;
					$prev_cat = array();
					foreach($category_link_array as $item) {
						$category_main = $item['category_main'];
						$cat_slug = $category_main['value'];
						$cat_title = $category_main['label'];
						if(!empty($prev_cat)) {
							$end_element = end($prev_cat);
							if($end_element == $cat_slug) {
								$group_cat = false;
								// $count = 0;
							}else {
								$group_cat = true;
							}
						}else {
							$group_cat = true;
						}

						$title = $item['name'];
						$slug = $item['slug'];

						if($group_cat) {
							echo ($count==false) ? '</ul></li>' : null;
							echo '<li class="nav__item '.(($count) ? 'active':null).'">';
							echo '<a href="#'.$cat_slug.'" class="scroll-to nav__item_link">'.($cat_slug == 'dental' ? 'Стоматологические услуги' : $cat_title).'</a>';
							echo '<ul>';
							echo '<li '.(($count) ? 'class="active"':'').'><a href="#'.$slug.'" class="scroll-to">'.$title.'</a></li>';
						}
						else {
							echo '<li><a href="#'.$slug.'" class="scroll-to">'.$title.'</a></li>';
						}
						$count = false;
						$prev_cat[] = $cat_slug;
					}
				echo '</ul>';
				echo '</li>';
				$args = get_query_var('global_params');
				if(isset($args['contacts'])) {?>
					<div class="hint">
						<h5>Мы поможем!</h5>
						<p>Дадим грамотную консультацию и поможем определиться</p>
						<div class="phones">
							<?
							$contacts = $args['contacts'];
							foreach ($contacts as $key => $phone) {
								echo '<div class="phones_item">';
									echo '<img src="'.get_stylesheet_directory_uri().'/assets/img/wp/form/'.$key.'.svg" alt="'.$key.'">';
									echo '<span>'.$phone['label'].'</span>';
									$phones = (is_array($phone['phones'])) ? true : false;
									if($phones) {
										foreach ($phone['phones'] as $val) {
											echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $val).'">'.$val.'</a>';
										}
									}else {
										echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $phone['phones']).'">'.$phone['phones'].'</a>';
									}
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';
		echo '</div>';
	echo '</section>';
}