<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*

//Удаляем уведомление об обновлении WordPress для всех кроме админа
add_action( 'admin_head', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		remove_action( 'admin_notices', 'update_nag', 3 );
		remove_action( 'admin_notices', 'maintenance_nag', 10 );
	}
} );


//удаляем мета-тег версии движка с DOM дерева
add_filter('the_generator', 'remove_wpversion');
function remove_wpversion() {
	return '';
}


//удаление ненужных текстов в DOM дереве(type для css)
add_filter('style_loader_tag', 'clean_style_tag');
function clean_style_tag($src) {
    return str_replace("type='text/css'", '', $src);
}

// //удаление ненужных текстов в DOM дереве(type для js)
add_filter('script_loader_tag', 'clean_script_tag');
function clean_script_tag($src) {
    return str_replace("type='text/javascript'", '', $src);
}


//Удалить ссылки на RSS ленты
function fb_disable_feed(){wp_redirect(get_option('siteurl'));}
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
add_action( 'do_feed', 'fb_disable_feed', 1 );
add_action( 'do_feed_rdf', 'fb_disable_feed', 1 );
add_action( 'do_feed_rss', 'fb_disable_feed', 1 );
add_action( 'do_feed_rss2', 'fb_disable_feed', 1 );
add_action( 'do_feed_atom', 'fb_disable_feed', 1 );


//Отключить REST API
add_filter( 'rest_enabled', '__return_false' );
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'template_redirect', 'rest_output_link_header', 11);
remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
remove_action( 'init', 'rest_api_init' );
remove_action( 'rest_api_init', 'rest_api_default_filters', 10 );
remove_action( 'parse_request', 'rest_api_loaded' );
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10 );

//Отключаем Emoji
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

//Отменяем srcset
add_filter('wp_calculate_image_srcset_meta', '__return_null' );
add_filter('wp_calculate_image_sizes', '__return_false', 99 );
remove_filter('the_content', 'wp_make_content_images_responsive' );

*/
//Отключаем Gutenberg
add_filter('use_block_editor_for_post_type', '__return_false', 100);
add_action('admin_init', function() {
    remove_action('admin_notices', ['WP_Privacy_Policy_Content', 'notice']);
    add_action('edit_form_after_title', ['WP_Privacy_Policy_Content', 'notice']); 
});
function gut_style_disable() { wp_dequeue_style('wp-block-library'); }
add_action('wp_enqueue_scripts', 'gut_style_disable', 100);

/*
//Отключение XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

//Отключение dns-prefetch
remove_action( 'wp_head', 'wp_resource_hints', 2 );

//Отключение rel shortlink
remove_action( 'wp_head', 'wp_shortlink_wp_head' );


add_action('wp_footer','wooexperts_remove_block_data',0);
add_action('admin_enqueue_scripts','wooexperts_remove_block_data',0);
function wooexperts_remove_block_data(){ 
    remove_filter('wp_print_footer_scripts',array('Automattic\WooCommerce\Blocks\Assets','print_script_block_data'),1);
    remove_filter('admin_print_footer_scripts',array('Automattic\WooCommerce\Blocks\Assets','print_script_block_data'),1);
}

*/

//Отключение визуального редактора
//add_filter( 'user_can_richedit', '__return_false' );

//Footer в админке
add_filter('admin_footer_text', 'remove_footer_admin');
function remove_footer_admin () {
	echo '<p>Разработка сайтов <a href="https://weblitex.ru" target="_blank">ООО "Лайтекс"</a> | E-mail: <a href="mailto:info@weblitex.ru">info@weblitex.ru</a> | Сайт разработан на основе WordPress.</p>';
}

add_action('admin_footer', 'tutsplus_add_script_wp_footer');
function tutsplus_add_script_wp_footer() {
    $settings_forms = get_field('settings_forms', 'options');
	?>
	<script type="text/javascript">
		jQuery(function($){
			let banner_page = $('.layout[data-layout="banner-page"]:not(.layout.acf-clone)');
    			if (banner_page.length) {
        			banner_page.find('.type_form_banner[data-name="type_form"]').each(function () {
						$(this).find('select').html(`
							<?
							foreach($settings_forms as $val) {
								$value = $val['type_form_label'];
									echo '<option value="'.$value.'">'.$value.'</option>';
							}
							?>
						`);
					let select_val = banner_page.find('.type_form_admin input[type="text"]').val();
						banner_page.find(`.type_form_banner[data-name="type_form"] select option[value="${select_val}"]`).prop('selected', true);
					});
					let change_select = $('.layout[data-layout="banner-page"]:not(.layout.acf-clone) .type_form_banner[data-name="type_form"]');
					$(change_select).on('change', 'select', function () {
						let val = $(this).val();
						$(this).parents('.acf-fields').find('.type_form_admin input[type="text"]').val(val);
					});
				}

				let modal = $('.acf-field-group[data-name="modal_group"]');
				if (modal.length) {
					modal.find('.acf-field-accordion .type_form_banner[data-name="type_form"]').each(function () {
						$(this).find('select').html(`
							<?
							foreach($settings_forms as $val) {
								$value = $val['type_form_label'];
									echo '<option value="'.$value.'">'.$value.'</option>';
							}
							?>
						`);
						let select_val = $(this).parents('.acf-field-accordion').find('.type_form_admin input[type="text"]').val();
						$(this).parents('.acf-field-accordion').find(`.type_form_banner[data-name="type_form"] select option[value="${select_val}"]`).prop('selected', true);
					
					});
					let change_select = $('.acf-field-group[data-name="modal_group"] .type_form_banner[data-name="type_form"]');
					$(change_select).on('change', 'select', function () {
						let val = $(this).val();
						$(this).parents('.acf-field-accordion').find('.type_form_admin input[type="text"]').val(val);
					});
				}

				let form_desktop = $('.layout[data-layout="forms"]:not(.layout.acf-clone), .layout[data-layout="fqu"]:not(.layout.acf-clone)');
				if (form_desktop.length) {
					form_desktop.find('.type_form_main[data-name="type_form"]').each(function () {
						let th = $(this);
						th.find('select').html(`
							<?
							foreach($settings_forms as $val) {
								$value = $val['type_form_label'];
									echo '<option value="'.$value.'">'.$value.'</option>';
							}
							?>
						`);
						let select_val = form_desktop.find('.type_form_admin input[type="text"]').val();
						form_desktop.find(`.type_form_main[data-name="type_form"] select option[value="${select_val}"]`).prop('selected', true);
					});
					let change_select = $('.layout[data-layout="forms"]:not(.layout.acf-clone) .type_form_main[data-name="type_form"], .layout[data-layout="fqu"]:not(.layout.acf-clone) .type_form_main[data-name="type_form"]');
					$(change_select).on('change', 'select', function () {
						let val = $(this).val();
						$(this).parents('.acf-fields').find('.type_form_admin input[type="text"]').val(val);
					});
				}

				let main_slider = $('.layout[data-layout="main-slider"]:not(.layout.acf-clone)');
				if(main_slider.length) {
					main_slider.find('.acf-repeater .acf-row:not(.acf-row.acf-clone)').each(function () {
						$(this).find('.acf-fields .acf-field-accordion .acf-field-group .type_form_banner[data-name="type_form"] select').html(`
							<?
							foreach($settings_forms as $val) {
								$value = $val['type_form_label'];
									echo '<option value="'.$value.'">'.$value.'</option>';
							}
							?>
						`);
						let select_val = $(this).find('.type_form_admin input[type="text"]').val();
						$(this).find(`.type_form_banner[data-name="type_form"] select option[value="${select_val}"]`).prop('selected', true);
					
					});
					let change_select = $('.layout[data-layout="main-slider"]:not(.layout.acf-clone) .acf-repeater .acf-row:not(.acf-row.acf-clone) .acf-fields .acf-field-accordion .acf-field-group .type_form_banner[data-name="type_form"]');
					$(change_select).on('change', 'select', function () {
						let val = $(this).val();
						$(this).parents('.acf-row:not(.acf-row.acf-clone)').find('.type_form_admin input[type="text"]').val(val);
					});
				}

				let vacancy = $('.layout[data-layout="vacancy"]:not(.layout.acf-clone) .acf-field-group');
				if(vacancy.length) {
					vacancy.find('.type_form_banner[data-name="type_form"]').each(function () {
						$(this).find('select').html(`
							<?
							foreach($settings_forms as $val) {
								$value = $val['type_form_label'];
									echo '<option value="'.$value.'">'.$value.'</option>';
							}
							?>
						`);
						let select_val = vacancy.find('.type_form_admin input[type="text"]').val();
						vacancy.find(`.type_form_banner[data-name="type_form"] select option[value="${select_val}"]`).prop('selected', true);
					});
					let change_select = $('.layout[data-layout="vacancy"]:not(.layout.acf-clone) .type_form_banner[data-name="type_form"]');
					$(change_select).on('change', 'select', function () {
						let val = $(this).val();
						$(this).parents('.acf-fields').find('.type_form_admin input[type="text"]').val(val);
					});
				}
		});
	</script>
	<style>
		.js-admin-password {
			position: absolute;
			right: 0px;
			top: 0;
			height: 30px;
			width: 30px;
			cursor: pointer;
		}
		.js-admin-password svg {
			padding-top: 4px;
			padding-left: 4px;
		}
		.test-mail-smtp-send {
			background: #0d99d5;
    		border-color: #007cba;
			cursor: pointer;
			height: 32px;
			width: 170px;
			text-align: center;
			padding-top: 5px;
			/* padding: 0 10px 0 10px; */
			color: #FFF;
			border-radius: 5px;
			box-sizing: border-box;
		}
		.test-mail-smtp-info {
			margin-top: 10px;
		}
		.test-mail-smtp-info.send-ok {
			color: #008000;
		}
		.test-mail-smtp-info.send-error {
			color: #d63638;
		}
		.image-optional-acf img {
			/* width: 200px !important; */
			height: 150px !important;
		}
		.taxonomy-portfolio #edittag .form-field.term-description-wrap, .taxonomy-post_tag #edittag .form-field.term-description-wrap {
			display: none !important;
		}
		/* .taxonomy-post_tag #edittag .preview-specialization, .taxonomy-category #edittag .preview-category{
			display: block;
			float: left;
			margin-top: 12px;
		} */
		.editor_image img {
			width: 150px !important;
		}
		.specialist-img img {
			width: 200px !important;
		}
		.specialist-img-mini img {
			width: 120px !important;
		}
		form#edittag {
			min-width: fit-content !important;
			max-width: inherit;
			/* margin-right: 200px; */
		}
		.taxonomy-category .form-field.term-description-wrap, #edittag .form-table .term-parent-wrap .description {
			display: none;
		}
		.taxonomy-category .price .acf-field-group[data-name="price"]{
			padding: 0 !important;
		}

		.taxonomy-category .price .acf-field-group[data-name="price"] .acf-input{ 
			height: 100% !important;
		}
		.taxonomy-category .price .acf-field-group[data-name="price"] .acf-table{
			padding: 0 !important;
			border-top: none !important;
			border-left: none !important;
			border-bottom: none !important;
			height: 100% !important;
		}
		.taxonomy-category .price .acf-field-group[data-name="price"].acf-table th{
			border-bottom: none !important;
		}
		.taxonomy-category .price-group .acf-table th:nth-child(3) {
			display: none;
		}
		.taxonomy-category .price-group .price_list {
			padding: 0;
		}
		.taxonomy-category .price-group .price_list .acf-table th:nth-child(3) {
			display: block;
		}
		.taxonomy-category .price-group .price_list th:nth-child(1), .taxonomy-category .price-group .price_list td:nth-child(1) {
			width: 18px;
			padding: 0;
		}
		.taxonomy-category .price .acf-field-group[data-name="titles"] {
			padding: 0;
			/* border: 0; */
		}
		.taxonomy-category .price .acf-field-group[data-name="titles"] .acf-field-text[data-name="title"] label {
			display: none;
		}
		.taxonomy-category .price .acf-field-group[data-name="titles"] .acf-fields.-top.-border {
			border: none;
		}
		.taxonomy-category .price .acf-field-text[data-name="title"] {
			padding-top: 0;
		}
		.taxonomy-category .price .acf-field-repeater[data-name="title_list"] .acf-field-text[data-name="title"] {
			padding-top: 8px !important;
		}
		


		.taxonomy-category .price .acf-field-repeater[data-name="price_list"] {
			border-left: none;
			border-top: 1px solid #d5d9dd;
    		display: block;
			margin-top: 102px;
			/* padding-top: 100px; */
		}
		.taxonomy-category .price .acf-field-repeater[data-name="price_list"] .acf-table {
			border-bottom: 1px solid #d5d9dd !important;
		}


		.taxonomy-category .layout[data-layout="banner-page"] .acf-field[data-name="btn_on"], .taxonomy-category .layout[data-layout="banner-page"] .acf-field[data-name="group"], .taxonomy-post_tag .layout[data-layout="banner-page"] .acf-field[data-name="btn_on"], .taxonomy-post_tag .layout[data-layout="banner-page"] .acf-field[data-name="group"], .taxonomy-post_tag .layout[data-layout="banner-page"] .acf-field[data-name="links_reviews_on"], .taxonomy-post_tag .layout[data-layout="banner-page"] .acf-field[data-name="advantages_on"] {
			display: none !important;
		}


		input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
		input[type="number"] {
			-moz-appearance: textfield;
		}
		input[type="number"]:hover, input[type="number"]:focus {
			-moz-appearance: number-input;
		}
		input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
		


		.taxonomy-doctors .acf-fields.-clear .specialist-img{
			width: auto !important;
		}
		.term-php #wpbody #edittag .my-custom-table .my-custom-field .preview-category{
			margin-top: 0;
			margin-left: 12px;
		}
		.term-php #wpbody #edittag .my-custom-table .my-custom-field {
			float: right;
		}
		.d-hide {
			display: none !important;
		}
		.taxonomy-portfolio .form-field.term-description-wrap{
			display: none !important;
		}
	</style>
    <?
}