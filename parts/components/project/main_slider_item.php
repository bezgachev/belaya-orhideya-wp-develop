<?if(!defined('ABSPATH')){exit;} ?>
<?
$title = $args['title'];
$description_array = $args['description'];
$img = $args['img'];
$settings = array($args['settings']);
// print_r($settings);
$page_id = $args['page_id'];
?>
<div class="swiper-slide first__slide">
    <div class="first__title"><?=$title;?></div>
    <ul>
        <?
        $text_array = preg_split('/<br[^>]*>/i', $description_array);
        foreach($text_array as $text) {
            echo '<li>'.$text.'</li>';
        }
        ?>
    </ul>
    <div class="first__content-btn">
        <?
        foreach($settings as $nav) {
            if($nav['navigation'] == 'popup'){
                $metric_key = get_field('metric_key', 'options');
                $type_form = $nav['type_form'];
                $size_form = $nav['size_form'];
                $title_open = $nav['title_open'];

                $params = [
                    'type_form' => $type_form,
                    'size_form' => $size_form,
                    'title_open' => $title_open,
                    'location' => 'main'
                ];
                btn_generation_modal(false, $page_id, $params);
            }
            else if ($nav['navigation'] == 'link') {
                if(!empty($nav['link'])) {
                    echo '<a href="'.$nav['link']['url'].'" class="btn">'.$nav['link']['title'].'</a>';

                }
            }
            if($nav['link_on']) {
                if(!empty($nav['link_two'])) {
                    echo '<a href="'.$nav['link_two']['url'].'" class="btn-line">'.$nav['link_two']['title'].'</a>';
                }
                else {
                    $page_price = get_field('page_price', 'options');
                    if(!empty($page_price)) {
                        echo '<a href="'.$page_price .'" class="btn-line">Цены</a>';
                    }
                }
            }
        }
        ?>
    </div>
    <img class="first__img" src="<?=$img;?>" alt="<?=$title;?>">
</div>