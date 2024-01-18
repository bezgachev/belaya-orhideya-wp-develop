<?if(!defined('ABSPATH')){exit;} 
$name = $args['name'];
$surname = $args['surname'];
$full_name = $name .' '.$surname;
$professions_array = $args['professions_array'];
$experience = $args['experience'];
$slug = $args['slug'];
$img = $args['img'];
?>
<a href="/doctors/<?=$slug;?>" data-url-doctor="/doctors/<?=$slug;?>" data-url-reviews="/doctors/<?=$slug;?>/#reviews" class="doctor-card">
    <div class="doctor-card__wrapper">
        <div class="doctor-card__title">
            <h2><?=$full_name;?></h2>
        </div>
        <div class="doctor-card__body">
                <img class="doctor-card__body_img" src="<?=$img;?>" alt="<?=$full_name;?>"> 
            <div class="doctor-card__body_info doctor-info js-reviews">
                <span><?=$experience;?></span>
                <span class="doctor-info__reviews">Отзывы</span>
            </div>
        </div>
    </div>
    <div class="doctor-card__nav">
        <?
            foreach($professions_array as $value) {
              echo '<span data-for="'.$value->slug.'" class="doctor-card__nav_item">'.mb_strtolower($value->name).'</span>';
            }
        ?>
    </div>
</a>