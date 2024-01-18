<?if(!defined('ABSPATH')){exit;}
$args = get_query_var('global_params');
$stoks_count = $args['stoks_count'];
if($stoks_count >= 1) {

	$display_type = get_sub_field('display_type');
	if ($display_type == 'slider') {
		$title = get_sub_field('title');
		$subtitle = get_sub_field('subtitle');
		$description = get_sub_field('description');
		?>
		<div class="promo">
			<div class="promo__container">
				<div class="promo__descr">
					<h2>
						<?=($title) ? $title : 'Выгодные акции и предложения';?>
						<span>
							<?=($subtitle) ? $subtitle : 'Оптимизируйте свои расходы вместе с нами!';?>
						</span>
					</h2>
					<div class="promo__descr_text">
						<?=($description) ? $description : 'Воспользуйтесь горячими предложениями, скидками и акциями «Белой Орхидеи». Запускаем новые акции каждую неделю!';?>
					</div>
					<div class="promo__descr_notify">
						<?
						echo '<p>Для вас доступно </p><span>'.$stoks_count.'</span>';
						$descr_notify = ($stoks_count == 1) ? 'предложение' : (($stoks_count >= 2 && $stoks_count < 5) ? 'предложения' : 'предложений');
						echo '<p>'.$descr_notify.'!</p>';
						
                        echo '<a href="'.get_field('page_sale', 'options').'" class="btn-see"><span class="circle" aria-hidden="true"><span class="icon arrow"></span></span><span class="button-text">
						Смотреть все
                        </span></a>';

						?>
					</div>
				</div>
				<div class="promo__slider swiper">
					<div class="promo__navigation">
						<div class="promo-prev"></div>
						<div class="promo-next"></div>
					</div>
					<div class="swiper-wrapper">
						<?
						$post_tags = get_terms([
							'taxonomy' => 'stocks',
							'hide_empty' => 0,
							'parent' => 0,
							'post_status' => 'publish', 
							'orderby' => 'meta_value',
							'order' => 'ASC',
						]);
						foreach($post_tags as $tag ){
							$params = [
								'title' => $tag->name,
								'description' => $tag->description,
								'tag_id' => $tag->term_id,
							];
							$stocks_on = get_field('stocks-on', 'stocks_'.$tag->term_id);
							if ($stocks_on) {
								get_template_part('parts/components/project/stocks_item', null, $params);
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?
	}
	elseif($display_type == 'list') {
	?>
		<section class="stocks">
			<div class="stocks__container">
				<?
					$post_tags = get_terms([
						'taxonomy' => 'stocks',
						'hide_empty' => 0,
						'parent' => 0,
						'post_status' => 'publish', 
						'orderby' => 'meta_value',
						'order' => 'ASC',
					]);
					foreach($post_tags as $tag ){
						$params = [
							'title' => $tag->name,
							'description' => $tag->description,
							'tag_id' => $tag->term_id,
						];
						$stocks_on = get_field('stocks-on', 'stocks_'.$tag->term_id);
						if ($stocks_on) {
							get_template_part('parts/components/project/stocks_item', null, $params);
						}
					}
				?>
			</div>
		</section>
	<?
	}
}