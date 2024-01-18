<?if(!defined('ABSPATH')){exit;}

$gallery = get_field('gallery_clinic', 'options');

$display_type = get_sub_field('display_type');
if(!$display_type) {
	$display_type = $args;
}

$subtitle_on = get_sub_field('subtitle_on');
if ($display_type == 'slider') {
	if (empty($gallery)) {
		return;
	}
	$title = get_sub_field('title');
	$subtitle = get_sub_field('subtitle');
	?>
	<section class="slider-clinic">
		<div class="slider-clinic__container">
			<h2 class="slider-clinic__title <?=(!$subtitle_on)? 'slider-clinic__subtitle-off':'';?>"><?=(!empty($title)) ? $title : 'Посетите клинику, не выходя из дома';?></h2>
			<?if($subtitle_on && is_front_page()) {?>
				<div class="slider-clinic__subtitle"><?=(!empty($subtitle)) ? $subtitle : 'Мы работаем — вы улыбаетесь!';?></div>
			<?}
			else {?>
				<div class="slider-clinic__subtitle"></div>
			<?}?>
		</div>
		<div class="swiper clinic-swiper">
			<div class="swiper-wrapper clinic-wrapper">
			<? get_template_part('parts/components/project/slider-clinic', null, $gallery); ?>
			</div>
			<div class="clinic-pagination"></div>
		</div>
	</section>
<?
}
else if ($display_type == 'list') {
	$url_home = get_site_url();
	$title = single_post_title('',false);
	if (empty($gallery)) {
		my_redirect_url($url_home);
	}
	?>
	<section class="gallery">
		<div class="gallery__container">
			<?
				if(!is_front_page()) {
					echo '<h1>'.$title.'</h1>';
				}
			?>
			<div class="gallery__items">
				<?        
					foreach($gallery as $key => $item) {
						echo '<div class="gallery__item"><img src="'.$item.'" alt="gallery-'.($key+1).'"></div>';
					}
				?>
			</div>
			<button class="btn show-photo">Показать больше</button>
		</div>
		</section>
		<section class="gallery-full">
		<div class="gallery-full__container">
			<div class="swiper-button-next slider-next"></div>
			<div class="swiper-button-prev slider-prev"></div>
			<button class="btn-close"></button>
			<div class="gallery-full__wrapper">
				<div class="swiper mySwiper2">
					<div class="swiper-wrapper">
					<?
						foreach($gallery as $key => $item) {
							echo '<div class="swiper-slide"><img src="'.$item.'" alt="gallery-'.($key+1).'"></div>';
						}
					?>
					</div>
				</div>
				<div class="swiper mySwiper">
					<div class="swiper-wrapper">
					<?
						foreach($gallery as $key => $item) {
							echo '<div class="swiper-slide"><img src="'.$item.'" alt="gallery-'.($key+1).'"></div>';
						}
					?>
					</div>
				</div>
			</div>
		</div>
		</section>
	<?
}