<?if(!defined('ABSPATH')){exit;}

$page_id = get_queried_object_id();
?>

<section class="first">
	<div class="first__container">
		<div class="first-swiper swiper">
			<div class="swiper-wrapper first__slides">
            <?
            $first_slides = get_sub_field('main_slider');
            foreach($first_slides as $first_slide) {
                $title = $first_slide['title'];
                $description = $first_slide['description'];
                $img = $first_slide['img'];
                $group = $first_slide['group'];
                $params = [
                    'title'=> $title,
                    'description'=> $description,
                    'img'=> $img,
                    'settings' => $group,
                    'page_id' => $page_id
                ];
                get_template_part('parts/components/project/main_slider_item', null, $params);
            }
            ?>
			</div>
			<div class="first-dots"></div>
			<div class="first-prev"></div>
			<div class="first-next"></div>
		</div>
	</div>
</section>