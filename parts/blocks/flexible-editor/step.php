<?
if(!defined('ABSPATH')){exit;}
$array = get_sub_field('step');
$title = get_sub_field('title');
if(!empty($array)) {?>
    <section class="step-prosth">
        <div class="step-prosth__container">
            <h2><?=$title;?></h2>
            
            <?

                function wrapper_item($title, $subtitle = false, $main, $index = false) {
                    // $count = 1;
                    echo '<div class="step-prosth__item">
                    <div><h3>'.(($main) ? ($index+1).' этап — '.$title : $title).'</h3>
                    '.(($subtitle) ? '<p>'.$subtitle : '</p>').'
                    </div></div>';
                    // $count++;
                }

                foreach($array as $key => $row) {
                    // $row_index = 1;
                    $title = $row['title_step'];
                    echo '<div class="step-prosth__items">';
                    wrapper_item($title, false, true, $key);

                    $list = $row['list'];
                    // 
                    foreach($list as $col) {
                        $title = $col['title'];
                        $subtitle = $col['subtitle'];
                        if($title && $subtitle) {
                            wrapper_item($title, $subtitle, false, false);
                        }
                        
                    }
                    echo '</div>';
                }
            ?>
        </div>
    </section>
<?
}
?>