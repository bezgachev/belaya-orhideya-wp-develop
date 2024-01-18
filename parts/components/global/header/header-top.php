<?if(!defined('ABSPATH')){exit;}
$page_id = get_queried_object_id();
?>
<div class="header__body">
    <div class="header__container">
        <?
        get_template_part('parts/components/global/logo');

        if(isset($args['address'])) {
            echo '<div class="header__address"><div>';
                echo (isset($args['city'])) ? '<span>'.$args['city'].',</span>' : '';
                echo '<span>'.$args['address'].'</span>';
            echo '</div></div>';
        }

        if (isset($args['contacts'])) {
            $time_works = $args['contacts'];
            $time_works_main = $args['time_works_main'];
            echo '<div class="header__mode"><div>';
                foreach ($time_works as $key => $val) {
                    if ($key == $time_works_main) {
                        foreach ($val['days_work'] as $value) {
                            echo '<span>'.$value.'</span>';
                        }
                    }
                }
            echo '</div></div>';
        }

        if(isset($args['contacts'])) {
            echo '<div class="header__contacts">';
                $phones = $args['contacts'];
                foreach ($phones as $phone) {
                    $params_phones = [
                        'phones' => $phone['phones'],
                        'label' => $phone['label']
                    ];
                    get_template_part('parts/components/global/header/header', 'tel', $params_phones);
                }
            echo '</div>';
        }
        
        btn_generation_modal('header', get_queried_object_id());

?>
    </div>
</div>

