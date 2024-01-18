<?
if(!defined('ABSPATH')){exit;}
$args = get_queried_object();
$page_id = $args->term_id;
$taxonomy = $args->taxonomy.'_'.$args->term_id;

$vacancy_on = get_field('vacancy_on', $taxonomy);
if($vacancy_on) {
    ?>
    <section class="vacancy-inside">
	<div class="vacancy-inside__container">
		<div class="vacancy-inside__header">
			<div class="vacancy-inside__header_title">
				<h1><?=$args->name;?></h1>
				<div>
					<p><?=$args->description;?></p>
                    
                    <?
                    $page_id_set = url_to_postid(get_field('page_vacancy', 'options'));
                    $flexible_content = get_field('blocks', $page_id_set); 
                    if( have_rows('blocks', $page_id_set) ):
                    
                        while( have_rows('blocks', $page_id_set) ) : the_row();
                            
                            $layout = get_row_layout();
                            if($layout === 'vacancy') {
                                btn_generation_modal('vacancy', get_queried_object_id());

                            }

                        endwhile;
                    
                    endif;
                    ?>
				</div>
			</div>
            <div class="vacancy-inside__header_descr descr">
                <?
                $vacancy_descr = array('group_salary', 'experience', 'schedule');
                foreach ($vacancy_descr as $key => $value) {
                    echo '<div class="descr__info">';
                    $object = get_field_object($value, $taxonomy);
                        echo '<h2>'.$object['label'].'</h2>';
                        $value = $object['value'];
                        echo '<p>';
                        if($key == 0) {
                            echo ($value['salary_at']) ? 'От '.number_format((int)$value['salary'], 0, '', '.').' ₽' : number_format((int)$value['salary'], 0, '', '.').' ₽';
                        }
                        if($key == 1) {
                            echo $value;
                        }
                        if($key == 2) {
                            $value_array = $value;
                            $count = count($value_array);
                            for ($i=0; $i < $count ; $i++) {
                                if ($i == 0) {
                                    echo $value[$i].', ';
                                }
                                else {
                                    echo ($i == $count-1) ? mb_strtolower($value[$i]) : mb_strtolower($value[$i]).', ';
                                }
                            }
                        }
                        echo '</p>';
                    echo '</div>';
                }
                ?>
            </div>
		</div>

		
            <?
            if(get_field('vacancy_descr_1', $taxonomy) || get_field('vacancy_descr_2', $taxonomy) || get_field('vacancy_descr_3', $taxonomy)) {
                echo '<div class="vacancy-inside__body">';

                $descr_array = array('vacancy_descr_1', 'vacancy_descr_2', 'vacancy_descr_3');

                foreach($descr_array as $descr) {
                    $object = get_field_object($descr, $taxonomy);
                    $text = $object['value'];
                    if($text) {
                        echo '<h2>'.$object['label'].':</h2>';
                        echo '<ul>';

                        $text_array = preg_split('/<br[^>]*>/i', $text);
                        foreach($text_array as $text) {
                            echo '<li>'.$text.'</li>';
                        }
                        // echo $object['value'];
                        echo '</ul>';
                    }
                    // print_r($object);
                }

                echo '</div>';
            }
            ?>
	</div>
</section>
<?

$section_on = get_field('section_on', $taxonomy);
if($section_on) {
    $flexible_content = get_sub_field('blocks'); 
    if( have_rows('blocks') ):
    
        while( have_rows('blocks') ) : the_row();
            
            $layout = get_row_layout();
            get_template_part('parts/blocks/'.$layout.'');
        endwhile;
    endif;
}

}else {
    $url_home = get_site_url();
    echo '<div class="my_redirect_url d-hide" data-url="'.$url_home.'"></div>';
}