<?if(!defined('ABSPATH')){exit;}
$advantages = get_sub_field('advantages');
$display_type = $advantages['display_type'];
$title = $advantages['title'];
$subtitle_on = $advantages['subtitle_on'];
$subtitle = $advantages['subtitle'];
$list = $advantages['list'];
if (!empty($list)) {
    if ($display_type == 'advantages') {
        if($list[0]['img']) {
        ?>
            <section class="triger">
                <div class="triger__container">
                    <h2><?=($title) ? $title : 'Заботимся о каждом пациенте';?></h2>

                    <?if($subtitle_on) {?>
                        <div class="triger__subtitle"><?=($subtitle) ? $subtitle : 'Наша искренняя цель — это высокое качество лечения и безупречный сервис';?></div>
                    <?}?>

                    <div class="triger__items">
                        <?
                        foreach($list as $item) {
                            $title = $item['title'];
                            $subtitle = $item['subtitle'];
                            $img = $item['img'];
                            ?>
                            <div class="triger__item">
                                <div class="triger__item_img">
                                    <img src="<?=$img;?>" alt="<?=$title;?>">
                                </div>
                                <div class="triger__item_title"><?=$title;?></div>
                                <div class="triger__item_subtitle"><?=$subtitle;?></div>
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
    else if ($display_type == 'advantages-cards') {?>
        <div class="trigger-prosthetics bg-dots">
            <div class="trigger-prosthetics__container">
                <h2><?=$title;?></h2>
                <div class="trigger-prosthetics__items">
                    <?
                    $count = 1;
                    foreach($list as $item) {
                        echo '
                        <div class="trigger-prosthetics__item">
                        <span>'.$count.'</span>
                        <h3>'.$item['title'].'</h3>
                        <p>'.$item['subtitle'].'</p>
                    </div>
                        ';
                        $count++;
                    }
                    ?>
                </div>
            </div>
        </div>
    <?
    }
    else if ($display_type == 'advantages-cards-text') {?>
        <section class="about-trigger">
            <div class="about-trigger__container">
                <?
                foreach($list as $key => $item) {
                    $subtitle = $item['subtitle'];
                    $img = $item['img'];
                    ?>
                    <div class="about-trigger__item">
                        <img src="<?=$img;?>" alt="Преимущество-<?=($key+1);?>">
                        <p><?=$subtitle;?></p>
                    </div>
                    <?
                }
                $text_1 = $advantages['text_1'];
                $text_2 = $advantages['text_2'];
                if((!empty($text_1)) || (!empty($text_2))) {          
                    ?>
                    <div class="about-trigger__item">
                        <?
                        echo ((!empty($text_1)) ? '<p>'.$text_1.'</p>' : null);
                        echo ((!empty($text_2)) ? '<span>'.$text_2.'</span>' : null);
                        ?>
                    </div>
                <?}?>
            </div>
        </section>
    <?
    }
}