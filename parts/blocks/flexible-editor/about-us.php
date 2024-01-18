<?
if(!defined('ABSPATH')){exit;}
$editor = get_sub_field('about_us');
$editor_title = $editor['title'];
$editor_text_1 = $editor['text_1'];

$advantages = $editor['advantages'];
$editor_text_2 = $editor['text_2'];
$editor_text_3 = $editor['text_3'];
$rows = $editor['rows'];
?>
<section class="about">
	<div class="about__container">
		<h2><?=$editor_title;?></h2>
		<div class="about__items">
            <?if(($rows == 'about-us') || ($rows == 'about-us-1') ) {?>
                <div class="about__item text">
                    <?=$editor_text_1;?>
                </div>
                <?if(!empty($advantages)) {
                    ?>
                    <div class="about__item card">
                        <?
                            foreach($advantages as $item) {
                                echo '
                                    <div class="about__item_content">
                                        <h4>'.$item['title'].'</h4>
                                        <p>'.$item['subtitle'].'</p>
                                    </div>
                                ';
                            }
                        ?>
                        <div class="about__item_content"><img src="<?=get_template_directory_uri();?>/assets/img/bg/about.jpg" alt="about"></div>
                    </div>
                    <?
                }
            }
            ?>
            <?if(($rows == 'about-us') || ($rows == 'about-us-2') ) {?>
                <div class="about__item img"><img src="<?=get_template_directory_uri();?>/assets/img/bg/about1.jpg" alt="">
                    <p><?=$editor_text_2;?></p>
                </div>
                <div class="about__item text-descr">
                    <?=$editor_text_3;?>
                </div>
            <?
            }
            ?>
		</div>
	</div>
</section>