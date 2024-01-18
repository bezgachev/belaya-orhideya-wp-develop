<?
$title = single_post_title('',false);
$field_array = array('yur_face', 'yur_address', 'tel_faks', 'domein', 'e_mail', 'ogrn', 'inn', 'kpp', 'general_director', 'number_license');
$documents_requisites_on = get_sub_field('documents_requisites_on');
if(empty($documents_requisites_on)) {
	return;
}
?>
<section class="documents">
	<div class="documents__container">
		<h1><?=$title;?></h1>
		<div class="documents__wrapper">
			<?
			if(in_array('requisites', $documents_requisites_on)) {?>
				<div class="documents__descr information">
					<h2>Основные сведения</h2>
					<div class="information__items">
						<?
						foreach($field_array as $field) {
							if ($field == 'domein') {
								$label =  'Адрес интернет-сайта';
								$value = get_site_url();
								$value = '<a href="'.$value.'">'.str_replace('https://', '', $value) .'</a>';
							}else {
								$var = get_field_object($field, 'options');
								$label =  $var['label'];
								$value =  $var['value'];
							}
							
							if ($field == 'e_mail') {
								$label = 'Адрес электронной почты';
								$value = '<a href="mailto:'.$value.'">'.$value .'</a>';
							}
							elseif ($field == 'tel_faks') {
								$value = '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $value).'">'.$value .'</a>';
							}
							echo '
								<div class="information__item">
									<div class="information__item_title">'.$label.'</div>
									<div class="information__item_descr">'.$value.'</div>
								</div>
							';
						}
						?>
					</div>
				</div>
			<?
			}
			if(in_array('documents', $documents_requisites_on)) {?>
				<div class="documents__items">
					<?
					$documents = get_sub_field_object('files');
					$documents_array = $documents['value'];
					foreach ($documents_array as $documents) {
							echo '<div class="documents__item"><a href="'.$documents['url'].'" target="_blank">'.$documents['title'].'</a></div>';
					}
					?>
				</div>
			<?
			}
			?>
		</div>
	</div>
</section>