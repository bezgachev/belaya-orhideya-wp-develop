<?if(!defined('ABSPATH')){exit;}
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$subtitle_on = get_sub_field('subtitle_on');
$args_global = get_query_var('global_params');
?>
<section class="contacts">
	<div class="contacts__container">
		<div class="contacts__body">
			<div class="contacts__body_title">
				<h2><?=($title) ? $title : 'Ждём вас у себя в гостях';?></h2>
                <?
                    if($subtitle_on && is_front_page()) {
                        echo '<span>';
                        echo ($subtitle) ? $subtitle : 'Гарантируем комфорт и тёплый приём';
                        echo '</span>';
                    }
                ?>
			</div>
			<div class="contacts__wrapper">
                <?
                $contacts = $args_global['contacts'];
                foreach($contacts as $contact) {
                    $phone = $contact['phones'];
                    $phones = (is_array($phone)) ? true : false;
                    echo '<div class="contacts__descr">';
                    if($phones) {
                        echo '<h3>'.$contact['label'].'</h3>';
                    }
                    echo '<div class="descr"><div class="descr__tel">';
                    if(!$phones) {
                        echo '<h3>'.$contact['label'].'</h3>';
                    }
                        if($phones) {
                            foreach ($phone as $val) {
                                echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $val).'">'.$val.'</a>';
                            }
                        }else {
                            echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $phone).'">'.$phone.'</a>';
                        }
                    echo '</div><div class="line"></div><div class="descr__mode">';
                        foreach ($contact['days_work'] as $key => $value) {
                            echo '<span>';
                            echo $value;
                            echo '</span>';
                            if($value !== end($contact['days_work'])) {
                                echo '<br>';
                            }
                        }
                    echo '</div></div></div>';
                }
                ?>
			</div>
			<div>
				<div class="contacts__item">
                <?
                    if(isset($args_global['email'])) {
                        echo '<a href="mailto:'.$args_global['email'].'" class="contacts__item_mail">'.$args_global['email'].'</a>';
                    }
                    if(isset($args_global['address'])) {
                        echo (isset($args_global['gis'])) ? '<a href="'.$args_global['gis'].'" class="contacts__item_map" target="_blank">' : '<div class="contacts__item_map">';
                            echo (isset($args_global['city'])) ? str_replace('-', '&#8209;', $args_global['city']).', ': '';
                            $address = $args_global['address']; 
                            echo str_replace(' ', '&nbsp;', $address);
                        echo (isset($args_global['gis'])) ? '</a>' : '</div>';
                    }
                    ?>
				</div>


                <?
                    btn_generation_modal('ymaps', get_queried_object_id());

                ?>
			</div>

            <?
            $social_on = get_sub_field('social_on');
            if(!$social_on) {
                $social_on = $args;
            }
            echo '<div class="social">';
            if(isset($args_global['socials']) && (!empty($args_global['socials'])) && ($social_on == 1)) {
                $params_social = ['socials' => $args_global['socials']];
                get_template_part('parts/components/standart/social', null, $params_social);
            }
            echo '</div>';
            ?>


		</div>

        <? get_template_part('parts/components/standart/ymaps'); ?>
        

	</div>
</section>