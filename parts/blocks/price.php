<?if(!defined('ABSPATH')){exit;}
$title = get_sub_field('title');
$price_repeater = get_sub_field('price');
$price_add_more_on = get_sub_field('price_add_more_on');

?>
<div class="price-prosthetics">
	<div class="price-prosthetics__container">
		<h2><?=$title;?></h2>
        <span class="price-prosthetics__time">Последнее обновление <span class="js-last-update"></span></span>
		<div class="tables">
        <?
		if(is_array($price_repeater)) {
			price_list_table($price_repeater);
		}

		?>
		</div>
	</div>
</div>
<?
if($price_add_more_on) {
	get_template_part('parts/blocks/see-also');
	$params_banner_callback = [
		'title' => 'Задайте вопрос!',
		'subtitle' => 'Дадим грамотную консультацию и&nbsp;поможем определиться'
	];
	get_template_part('parts/blocks/mini-banner-callback', null, $params_banner_callback);
}