<?
if(!defined('ABSPATH')){exit;}
$page_id = get_queried_object_id();

$editor = get_sub_field('editor');
$display_type = $editor['display_type'];
$editor_title = $editor['title'];
$editor_text = $editor['text'];
if(!empty($editor_text)) {
    if ($display_type == 'editor') {
        if(is_privacy_policy()) { ?>
            <section class="container privacy">
                <h1><?=$editor_title;?></h1>
                <div class="privacy__subtitle">Положение о политике обработки персональных данных</div>
                <?=$editor_text;?>
            </section>
        <?
        }else {
        ?>
            <section class="certificates">
                <div class="certificates__container">
                    <?
                        echo ($editor_title) ? '<h2>'.$editor_title.'</h2>' : null;
                        echo $editor_text;
                    ?>
                </div>
            </section>
        <?
        }
    }
    else if ($display_type == 'editor-one-image') { 
        $editor_image = $editor['img'];
        $page_tax = get_field('page_tax', 'options');
        if(!empty($page_tax)) {
            $check_page_tax = url_to_postid($page_tax);
            if($page_id == $check_page_tax) {?>
                <section class="tax">
                    <div class="tax__container">
                        <?
                            echo ($editor_title) ? '<h1>'.$editor_title.'</h1>' : null;
                            echo $editor_text;
                            echo (!empty($editor_image)) ? '<img src="'.$editor_image.'" alt="Налоговый вычет 13%">' : null;
                        ?>
                    </div>
                </section>
            <?
            }else {
                ?>
                <section class="directory-info">
                    <div class="directory-info__container">
                        <div class="directory-info__descr">
                            <?
                                echo ($editor_title) ? '<h2>'.$editor_title.'</h2>' : null;
                                echo $editor_text;
                            ?>
                        </div>
                        <?
                            
                            if(!empty($editor_image)) {?>
                                <div class="directory-info__img">
                                    <svg width="374" height="374" viewBox="0 0 374 374" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M376 -2H-2V376H376V-2ZM82.7226 76.6723C137.697 29.7012 211.228 -7.59448 279.494 29.1366C353.325 68.8627 384.992 154.447 369.73 231.1C354.945 305.351 291.693 357.743 212.827 363.965C131.135 370.407 43.6578 334.021 9.90203 259.482C-21.5005 190.141 27.2245 124.092 82.7226 76.6723Z" fill="white"></path>
                                    </svg>
                                    <img src="<?=$editor_image;?>" alt="directory-info-img">
                                </div>
                            <?
                            }
                        ?>
                    </div>
                </section>
            <? 
            }
        }
        
    }
    else if ($display_type == 'editor-one-image-1') {
        $editor_image = $editor['img'];
        $editor_link = $editor['link'];
        $editor_reverse = $editor['reverse'];
        ?>
        <section class="blocks<?echo ((!$editor_reverse) ? ' reverse' : null)?>">
            <div class="blocks__container">
                <div class="block-two">
                    <?
                    echo ($editor_image) ? '<div class="block__img"><img src="'.$editor_image.'" alt=""></div>' : null;
                    ?>
                    <div class="block__descr">
                        <?echo ($editor_title) ? '<h3>'.$editor_title.'</h3>' : null;
                        echo $editor_text;
                        if (!empty($editor_link)) {
                            $term_obj_id = $editor_link->term_id;
                            $link = get_category_link($term_obj_id);
                            echo '<a href="'.$link.'" class="btn-line">Подробнее</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?
    }
    else if ($display_type == 'editor-text-slider') { 
        $sliders = $editor['slider'];
        ?>
        	<section class="chinese-medicine">
                <div class="chinese-medicine__container">
                    <div class="chinese-medicine__items">
                        <div class="chinese-medicine__item">
                            <?
                                echo ($editor_title) ? '<h2>'.$editor_title.'</h2>' : null;
                                echo $editor_text;
                            ?>
                        </div>
                        <?
                        if(!empty($sliders)) {?>
                            <div class="chinese-medicine__item">
                                <div class="chinese-medicine__slider swiper">
                                    <div class="swiper-wrapper">
                                        <?
                                            foreach ($sliders as $key => $val) {
                                                echo '<div class="swiper-slide"><img src="'.$val.'" alt="image-'.($key+1).'"></div>';
                                            }
                                        ?>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        <?
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?
    }
}