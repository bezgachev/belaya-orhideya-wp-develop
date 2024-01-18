<?
if(!defined('ABSPATH')){exit;}
$group = get_sub_field('dms');
$title = $group['title'];
$subtitle = $group['subtitle'];
$array = $group['list'];
if(!empty($array)) { ?>
    <section class="dms">
        <div class="dms__container">
            <h1><?=$title;?></h1>
            <p class="dms__desct"><?=$subtitle;?></p>
            <div class="dms__items">
                <?
                foreach($array as $val) {
                echo ($val['img'])
                    ?
                        '<div class="dms__item"><img class="" src="'.$val['img'].'" alt="'.$val['title'].'">
                            <p class="dms__item_title">'.$val['title'].'</p>
                        </div>'
                    :
                        '
                        <div class="dms__item">
                            <p class="dms__item_title">'.$val['title'].'</p>
                        </div>
                        ';
                }
                ?>
            </div>
        </div>
    </section>
<?
}
?>