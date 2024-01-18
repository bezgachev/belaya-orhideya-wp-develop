<?if(!defined('ABSPATH')){exit;}
$dir_theme = get_stylesheet_directory_uri();
$dir_theme_wp = ''.$dir_theme.'/assets/img/wp/see-also';
$section_type = get_sub_field('section_type');

$layout = get_row_layout();
if($layout == 'price') {
	$section_type = 'standart';
}

if($section_type == 'standart') {
?>
<section class="see-also">
	<div class="see-also__container">
		<h3>Смотрите также</h3>
		<div class="see-also__items">
			<a class="see-also__item" href="<?=get_field('page_sale', 'options');?>">
                <img class="" src="<?=$dir_theme_wp;?>/1.svg" alt="Акции и скидки">
				<h4>Акции и&nbsp;скидки</h4>
            </a>
			<a class="see-also__item" href="<?=get_field('page_service_dms', 'options');?>">
                <img class="" src="<?=$dir_theme_wp;?>/2.svg" alt="Лечение по ДМС">
				<h4>Лечение по&nbsp;ДМС</h4>
            </a>
			<a class="see-also__item" href="<?=get_field('page_tax', 'options');?>">
                <img class="" src="<?=$dir_theme_wp;?>/3.svg" alt="Налоговый вычет 13%">
				<h4>Налоговый вычет&nbsp;13%</h4>
            </a>
			<a class="see-also__item" href="<?=get_field('page_answers_questions', 'options');?>">
                <img class="" src="<?=$dir_theme_wp;?>/4.svg" alt="Ответы на вопросы">
				<h4>Ответы на&nbsp;вопросы</h4>
            </a>
		</div>
	</div>
</section>
<?
}else {
	$list = array();
	$list_array = get_sub_field('list');
	if(empty($list_array)) {
		return;
	}
		foreach($list_array as $item) {
			$id = $item['link']->term_id;
			$title = $item['link']->name;
			$params = [
				'id' => $id,
				'title' => $title 
			];
			$list[] = $params;
		}
	$display_type = get_sub_field('display_type');
	$taxonomy = 'category';
	if(($display_type) && (!empty($list))) {?>
		<section class="slider-block four">
			<div class="slider-block__container">
				<div class="slider-block__wrapper">
					<h2>Другие наши&nbsp;услуги</h2>
					<div class="slider-block__nav">
						<div class="slider-block-prev slider-prev"></div>
						<div class="slider-block-next slider-next"></div>
					</div>
				</div>

				<div class="swiper slider-block-swiper">
					<div class="swiper-wrapper">
						<?
							foreach($list as $val) {
								$url = get_category_link($val['id']);
								$img = get_field('category_img', $taxonomy.'_'.$val['id']);
								echo '<a href="'.$url.'" class="swiper-slide">';
									echo ((!empty($img) ? '<img src="'.$img.'">' : null));
									echo '<div>'.$val['title'].'</div>';
								echo '</a>';
							}
						?>
					</div>
				</div>
			</div>
		</section>
	<?
	}
	if((!$display_type) && (!empty($list))) {?>
		<section class="slider-block three">
			<div class="slider-block__container">
				<div class="slider-block__wrapper">
					<h2>Смотрите также</h2>
					<div class="slider-block__nav">
						<div class="slider-block-prev slider-prev"></div>
						<div class="slider-block-next slider-next"></div>
					</div>
				</div>
				<div class="swiper slider-block-swiper">
					<div class="swiper-wrapper">
						<?
							foreach($list as $val) {
								$url = get_category_link($val['id']);
								echo '<a href="'.$url.'" class="swiper-slide">';
									echo '<p>'.$val['title'].'</p>';
									echo '<span><button class="btn-line">Подробнее</button></span>';
								echo '</a>';
							}
						?>
					</div>
				</div>
			</div>
		</section>
	<?
	}
}