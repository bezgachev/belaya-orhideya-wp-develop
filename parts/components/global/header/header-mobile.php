<?if(!defined('ABSPATH')){exit;} 
?>
<div class="header-mobile">
	<div class="header-mobile__header">
		<?get_template_part('parts/components/global/logo');
            btn_generation_modal('header', get_queried_object_id());
        ?>
		<div class="mobile-burger">
			<div class="icon"></div>
		</div>
	</div>
	<?
        if(isset($args['contacts'])) {
            echo '<div class="header-mobile__footer">';
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

	mobile_header_main_nav_menu();
	?>
</div>