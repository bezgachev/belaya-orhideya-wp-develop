<?if(!defined('ABSPATH')){exit;}
$first_item = $args['first_item'];
// $last_item = $args['last_item'];
$loading_item = $args['loading_item'];
$name = $args['name'];
?>


<div class="feedback-card js-feedback swiper-slide<?=($first_item) ? ' first-item' : '';?><?=($loading_item) ? ' loading-item' : '';?>">
	<div class="feedback-card__title title">
		<div class="title__img" data-source="<?=$args['source']['value'];?>" data-text="<?=strtoupper(mb_substr($name, 0, 1));?>"></div>
		<h4 class="title__name"><?=$name;?></h4>
		<div class="title__star">
			<span class="title__star_content" data-count="<?=$args['count'];?>"></span>
			<span class="title__star_data"><?=$args['data'];?></span>
		</div>
		<div class="title__source"><?=$args['source']['label'];?></div>
	</div>
	<div class="feedback-card__descr">
        <?
            if($args['doctor']) {
                echo '<div class="feedback-card__descr_title line">
                <span>Лечащий врач:</span> '.$args['doctor'].'
            </div>';
            }
        ?>
		<p class="line">
            <?=$args['comment'];?>
		</p>
	</div>
	<button class="feedback-card__btn">Показать полностью</button>
	<button class="feedback-card__popup">Показать полностью</button>
</div>