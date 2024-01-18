<?if(!defined('ABSPATH')){exit;} ?>


<?
$id = $args['tag_id'];
$title = $args['title'];
$description = $args['description'];
$img_url = get_field('stocks-img', 'stocks_'.$id);
$price_main = get_field('stoks-price-main', 'stocks_'.$id);
$price_sale = get_field('stoks-price-sale', 'stocks_'.$id);
$price_main_space = number_format((int)$price_main, 0, '', ' ');
$price_sale_space = number_format((int)$price_sale, 0, '', ' ');
$unit = get_field('stocks-unit', 'stocks_'.$id);
$stocks_forever = get_field('stocks-forever', 'stocks_'.$id);
$stocks_date = get_field('stocks-close', 'stocks_'.$id);
?>

<div class="swiper-slide stock-card">
	<div class="stock-card__descr">
		<h3><?=$title;?></h3>
		<div class="stock-card__descr_text"><?=$description;?></div>
		<div class="stock-card__descr_price">
            <?  
            	echo ($price_sale) ? '<span>'.$price_main_space . ' '.$unit.'</span>'.$price_sale_space. ' '.$unit : (($price_main == 0) ? '' : $price_main_space. ' '.$unit.'');
            ?>
		</div>
		<div class="stock-card__descr_data">
			<?
				echo ($stocks_forever) ? 'Предложение действует всегда' : 'Акция до '.$stocks_date;
			?>		
		</div>
	</div>
	<div class="stock-card__img frame">
		<svg width="194" height="194" viewBox="0 0 194 194" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M194 0H0V194H194V0ZM4.01001 96.1562C4.57153 60.533 32.8691 34.406 66.3525 22.3096C104.429 8.55396 150.82 2.11182 175.556 34.1826C201.885 68.3208 191.918 116.752 165.428 150.765C141.642 181.306 100.559 189.939 63.9058 177.539C28.647 165.611 3.4231 133.401 4.01001 96.1562Z" fill="white" preserveAspectRatio="xMinYMin meet" style="border:1px solid red;" /></svg>
		<img src="<?=$img_url;?>" alt="<?=$title;?>">
	</div>
</div>