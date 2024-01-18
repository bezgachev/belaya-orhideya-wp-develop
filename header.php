<!doctype html>
<html lang="ru">
<head>
<meta charset="<?bloginfo('charset');?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100;8..144,200;8..144,300;8..144,400;8..144,500;8..144,600;8..144,700;8..144,800;8..144,900;8..144,1000&display=swap" rel="stylesheet">
<?wp_head(); get_template_part('includes/global/get-options');?>
<script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(88986021, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/88986021" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WB7R21TWKE"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WB7R21TWKE');
</script>
</head>
<body>

<header>
	<div class="header">
        <?
			$args = get_query_var('global_params');
            get_template_part('parts/components/global/header/header', 'top', $args);
            get_template_part('parts/components/global/header/header', 'bottom');
		?>
    </div>
    <?get_template_part('parts/components/global/header/header', 'mobile', $args);?>
	<div class="header-overlay"></div>
</header>
<?
$page_id = get_queried_object_id();
$page_check = $page_id;
$page_set = array();
$pages = [
	'page_price' => '02',
	'page_doctors' => '04',
	'page_gallery' => '07',
	'page_documents' => '08',
	'page_tax' => '10',
	'page_service_dms' => '11',
	'page_certificates' => '12',
	'page_vacancy' => '13',
	'page_about' => '15',
	'page_sale' => '16',
	'page_contacts' => '17',
	'page_reviews' => '18',
	'page_portfolio' => '19'
];

foreach ($pages as $key => $val) {
	$value = get_field($key, 'options');
	if(!empty($value)) {
		$id = url_to_postid($value);
		$page_set[$id] = $val;
	}
}
$page_set[url_to_postid(get_home_url())] = '01';
$page_set['tax_doctors'] = '04';
$page_set['tax_vacancy'] = '14';
$page_set['tax_category'] = '03';
$page_set['tax_post_tag'] = '05';

if (is_archive()) {
	$object = get_queried_object();
	$slug_tax = $object->taxonomy;
	$page_check = 'tax_'.$slug_tax;
}

if (array_key_exists($page_check, $page_set)) {
	echo '<main class="page-'.$page_set[$page_check].'">';
}else {
	echo '<main>';
}

if(!is_front_page()){
	if(!is_404()) {
		get_template_part('parts/components/standart/bread-crumbs', null, $page_id);
	}
}