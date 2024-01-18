<?if(!defined('ABSPATH')){exit;}
$gallery = $args;
foreach($gallery as $key => $item) {
    echo '<div class="swiper-slide clinic-slide"><img src="'.$item.'" alt="gallery-'.($key+1).'"></div>';
}