<?if(!defined('ABSPATH')){exit;}
$dir_theme = get_stylesheet_directory_uri();
$dir_theme_wp = ''.$dir_theme.'/assets/img/bg';
$global_args = get_query_var('global_params');
$type_service = get_sub_field('type_service');
$layout = get_row_layout();
if($layout == 'price') {
	$title = $args['title'];
	$subtitle = $args['subtitle'];
}else {
	$title = get_sub_field('title');
	$subtitle = get_sub_field('subtitle');
}
?>
<section class="callback">
	<div class="callback__container"> <img src="<?=$dir_theme_wp;?>/girl.png" alt="">
		<div class="callback__wrapper">
			<div class="callback__title">
				<h3><?=($title) ? $title : 'Задайте вопрос!';?></h3>
				<p><?=($subtitle) ? str_replace(' и ', ' и&nbsp;', $subtitle) : 'Дадим грамотную консультацию и&nbsp;поможем определиться';?></p>
			</div>
			<?
				if(isset($global_args['contacts'])) {
					echo '<div class="callback__tel">';
						$contacts = $global_args['contacts'];
						foreach ($contacts as $key => $phone) {
							if($type_service == $key) {
								$phone = $phone['phones'];
								if(is_array($phone)) {
									foreach ($phone as $val) {
										echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $val).'">'.$val.'</a>';
									}
								}
								else {
									echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $phone).'">'.$phone.'</a>';
								}
							}
						}
					echo '</div>';
				}

				btn_generation_modal('mini_banner', get_queried_object_id());

				?>
		</div>
	</div>
</section>