<?if(!defined('ABSPATH')){exit;}
$title = get_sub_field('title');
$dir_theme = get_stylesheet_directory_uri();
$dir_theme_wp = ''.$dir_theme.'/assets/img/wp/icons-services-catalog/';
$all_categories = get_categories( array(
	'hide_empty' => 0,
	'parent'  => 0,
	'meta_key' => 'tax_position',
	'orderby' => 'tax_position',
	'order' => 'ASC'
) );
$category_link_array = array();
$taxonomy = 'category';
if(is_array($all_categories)) {
	foreach( $all_categories as $cat ){
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
    echo '<section class="complex-services">';
        echo '<h2>'.(($title) ? $title : 'Оказываем полный комплекс услуг в&nbsp;одном месте').'</h2>';
		echo '<div class="complex-services__container">';
			echo '<div class="complex-services__tabs filter nav-block">';
				echo '<div class="complex-services__tabs_title tabs">';

				$group_cat = false;
				$prev_cat = array();
				$first_item = true;
				$count = true;
				$array_list_cat_main = [
					'dental' => 'Стоматологические услуги',
					'cosmetic' => 'Косметологические услуги',
					'spa' => 'SPA процедуры',
					'medic' => 'Медицина'
				];
				foreach($category_link_array as $item) {
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
					}
					else {
						$group_cat = true;
					}
					if ($group_cat) {
						// if($count) {
							echo '
								<div class="tab-title'.(($first_item) ? ' active' : null).'"> 
									<div class="tab-title__img"><img src="'.$dir_theme_wp.''.$cat_slug.'.svg" alt="'.$array_list_cat_main[$cat_slug].'"></div>
									<div class="tab-title__text">'.$array_list_cat_main[$cat_slug].'</div>
								</div>
							';
							$first_item = false;
						// }
					}
					$prev_cat[] = $cat_slug;
					$count = false;
				}
				$prev_cat = null;
				echo '</div>';
				echo '<div class="complex-services__tabs_content">';
					$first_item = true;
					$group_cat = false;
					$prev_cat = array();
					function tab_content__item($url, $src, $title) {
						echo '
							<a href="'.$url.'" class="tab-content__item">
								<div class="tab-content__item_block">
									'.(($src) ? '<div class="tab-content__item_img"><img src="'.$src.'" alt="'.$title.'"></div>' : null).'
									<div class="tab-content__item_title">'.$title.'</div>
								</div>
							</a>
							';
					}
					foreach($category_link_array as $item) {
						$term_id = $item['term_id'];
						$category_main = $item['category_main'];
						$cat_slug = $category_main['value'];
						$cat_title = $category_main['label'];
						$title = $item['name'];
						$src_img = $item['img'];
						$slug = $item['slug'];
						$url_term = get_category_link($term_id);
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
						if ($group_cat) {
							echo ($first_item==false) ? '</div></div>' : null;
							echo '
								<div class="tab-content'.(($first_item) ? ' active' : null).'"> 
									<div class="tab-title">
										<div class="tab-title__img"><img src="'.$dir_theme_wp.''.$cat_slug.'.svg" alt="'.$cat_title.'"></div>
										<div class="tab-title__text">'.$cat_title.'</div>
									</div>
									<div class="tab-content__body">
								';
						}
						tab_content__item($url_term, $src_img, $title);
						$prev_cat[] = $cat_slug;
						$first_item = false;
					}
					$prev_cat = null;
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>';
}