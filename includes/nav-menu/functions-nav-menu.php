<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function get_nav_menu_item_children( $parent_id, $nav_menu_items, $depth = true) {
    $nav_menu_item_list = array();
    $index = 0;
    foreach ( (array) $nav_menu_items as $nav_menu_item ) {
        if ( $nav_menu_item->menu_item_parent == $parent_id ) {
            $title = $nav_menu_item->title;
            $id = $nav_menu_item->ID;
            $url = $nav_menu_item->url;
            $url = ($url == '' || $url == '#') ? 'null' : $url;
            $nav_menu_item_list[$id] = [
                'index' => $index++,
                'id' => $id,
                'title' => $title,
                'url' => $url,
				'children'=> 'null'
            ];
			if ( $depth == true) {
				if ( $children = get_nav_menu_item_children( $id, $nav_menu_items ) ) {
					if (array_key_exists($id, $nav_menu_item_list)) {
						$nav_menu_item_list[$id]['children'] = $children;
					}
				}
			}
        }
    }
    return $nav_menu_item_list;
}


function desktop_header_main_nav_menu(){
	$div_svg_burger = '<div class="burger__svg"><svg class="ham" viewBox="0 0 100 100" width="80"><path class="line top" d="m 30,33 h 40 c 0,0 8.5,-0.68551 8.5,10.375 0,8.292653 -6.122707,9.002293 -8.5,6.625 l -11.071429,-11.071429"></path><path class="line middle" d="m 70,50 h -40"></path><path class="line bottom" d="m 30,67 h 40 c 0,0 8.5,0.68551 8.5,-10.375 0,-8.292653 -6.122707,-9.002293 -8.5,-6.625 l -11.071429,11.071429"></path></svg></div>';
	$menu_name = 'header-main-menu';
	$btn_close_menu = '<button class="close-menu"><svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1742_6357)"><path d="M4.80825e-06 -9.61651e-06C4.17682e-06 7.22269 1.42262 14.3747 4.18663 21.0476C6.95064 27.7205 11.0019 33.7836 16.1091 38.8909C21.2164 43.9981 27.2795 48.0494 33.9524 50.8134C40.6253 53.5774 47.7773 55 55 55L55 -4.80825e-06L4.80825e-06 -9.61651e-06Z" fill="#F6F6FF"></path><g opacity="0.4"><path d="M39 16L27 28" stroke="#55507D" stroke-width="2" stroke-linecap="round"></path><path d="M27 16L39 28" stroke="#55507D" stroke-width="2" stroke-linecap="round"></path></g></g><defs><clipPath id="clip0_1742_6357"><path d="M0 0H39C47.8366 0 55 7.16344 55 16V55H0V0Z" fill="white"></path></clipPath></defs></svg></button>';
	$locations = get_nav_menu_locations();
	$tabs_li = null;
	if (isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items_locations = wp_get_nav_menu_items($locations[$menu_name]);
		$menu_items_nav = wp_get_nav_menu_items($menu->term_id);
		$nav_menu_item_parents = array();
		foreach ($menu_items_nav as $index => $nav_menu_item) {
			if ($nav_menu_item->menu_item_parent == 0) {
				$title = $nav_menu_item->title;
				$id = $nav_menu_item->ID;
				$url = $nav_menu_item->url;
				$url = ($url == '' || $url == '#') ? 'null' : $url;
				$nav_menu_item_parents[$id] = [
					'id' => $id,
					'title' => $title,
					'url' => $url
				];
			}
		}


		echo '<div class="header__container">';
			echo '<ul class="header-nav">';
			foreach($nav_menu_item_parents as $key => $menu_nav) {
				$id_parent = $menu_nav['id'];
				$title_parent = $menu_nav['title'];
				$url_parent = $menu_nav['url'];
				echo ($url_parent == '#burger') ? '<li class="burger">' : '<li class="header__link">';
				$global_params = get_query_var('global_params');
				$stocks_count = $global_params['stoks_count'];
				$check_page_sale = get_field('page_sale', 'options');
				echo ($url_parent == 'null') ? '<span>'.$title_parent.'</span>' : (($url_parent == '#burger') ? $div_svg_burger : '<a href="'.$url_parent.'">'.$title_parent.''.(($url_parent == $check_page_sale) ? '<span class="stocks-count">'.$stocks_count.'</span>' : null) .'</a>');

					$menu_items = get_nav_menu_item_children($id_parent, $menu_items_locations, true);
					$children_items = array();

					if($menu_items) {
						$children_check = array_column($menu_items, 'children');
						if(array_search("null", $children_check) !== false){
							echo '<div class="dropdown light">';
						}else {
							echo '<div class="dropdown">';
						}
							echo '<div class="dropdown__body">';
								echo '<ul class="dropdown__tabs">';
									foreach($menu_items as $key => $tab) {
										if ($tab) {
											$url_tab = $tab['url'];
											$title_tab = $tab['title'];
											$first = ($tab['index'] == 0) ? $first = ' active' : $first = '';
											if($tab['children'] !== 'null') {
												$children_items[] = $tab['children'];
											}
											$tabs_li .= ($url_tab == 'null') ? '<li class="tab-header'.$first.'"><span>'.$title_tab.'</span></li>' : '<li class="tab-header'.$first.'"><a href="'.$url_tab.'">'.$title_tab.'</a></li>';
										}
									}
									echo $tabs_li;
								echo '</ul>';

								if($children_items) {
									echo '<div class="dropdown__content">';
										foreach($children_items as $index_uls => $uls) {
											if ($uls) {
												echo ($index_uls == 0) ? $btn_close_menu.'<ul class="content-header active">' : '<ul class="content-header">';
													foreach($uls as $li) {
														$this_url = $li['url'];
														$this_title = $li['title'];
														echo ($this_url == 'null') ? '<li><span>'.$this_title.'</span></li>' : '<li><a href="'.$this_url.'">'.$this_title.'</a></li>';
													}
												echo '</ul>';
											}
										}
									echo '</div>';
								}

							echo '</div>';
						echo '</div>';
					}
					$nav_menu_item_parents = null;
					$menu_items = null;
					$tab = null;
					$tabs_li = null;
					$children_items = null;
					$uls = null;
					$li = null;
					// unset($children_items, $menu_items, $nav_menu_item_parents, $tabs_li, $items_children, $tab, $uls, $li);
				echo '</li>';
			}
		echo '</ul></div>';
	}
}


function mobile_header_main_nav_menu(){
	echo '<div class="header-mobile__nav">';
	$menu_name = 'header-main-menu';
	$locations = get_nav_menu_locations();
	if (isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items_locations = wp_get_nav_menu_items($locations[$menu_name]);
		$menu_items_nav = wp_get_nav_menu_items($menu->term_id);
		$nav_menu_item_parents = array();
		foreach ($menu_items_nav as $index => $nav_menu_item) {
			if ($nav_menu_item->menu_item_parent == 0) {
				$title = $nav_menu_item->title;
				$id = $nav_menu_item->ID;
				$url = $nav_menu_item->url;
				$url = ($url == '' || $url == '#') ? 'null' : $url;
				$nav_menu_item_parents[$id] = [
					'id' => $id,
					'title' => $title,
					'url' => $url
				];
			}
		}
		$count_key = 0;
		$count_nav_menu_item_parents = count($nav_menu_item_parents);
		$burger_menu_list = '';
		foreach($nav_menu_item_parents as $key => $menu_nav) {
			echo ($count_key==0) ? '<ul class="mob-tabs">' : null;
			$id_parent = $menu_nav['id'];
			$title_parent = $menu_nav['title'];
			$url_parent = $menu_nav['url'];
			if ($url_parent == '#burger') {
				$burger_menu_items = get_nav_menu_item_children($id_parent, $menu_items_locations, true);
				if($burger_menu_items) {
					foreach($burger_menu_items as $key => $burger_item) {
						if ($burger_item) {
							$url_item = $burger_item['url'];
							$title_item = $burger_item['title'];
							$burger_menu_list .= '<li><a href="'.$url_item.'">'.$title_item.'</a></li>';
						}
					}
				}
			}
			echo ($url_parent == 'null')
				? '<li><span>'.$title_parent.'</span></li>'
				: (($url_parent == '#burger' && $burger_menu_list) ? $burger_menu_list
				: '<li><a href="'.$url_parent.'">'.$title_parent.'</a></li>');
			echo ($count_key == ($count_nav_menu_item_parents-1)) ? '</ul>' : null;
			$count_key++;
		}

		$children_items = array();
		$count_key = 0;
		$tabs_li = '';
		foreach($nav_menu_item_parents as $key => $menu_nav) {
			$id_parent = $menu_nav['id'];
			$title_parent = $menu_nav['title'];
			$url_parent = $menu_nav['url'];
			if($url_parent == 'null') {
				$div_title = true;
				$menu_items = get_nav_menu_item_children($id_parent, $menu_items_locations, true);
				if($menu_items) {
					echo ($count_key==0) ? '<div class="mob-contents">' : null;
					echo '<ul>';
					// echo '<pre>';
					// print_r($menu_items);
					// echo '</pre>';
						foreach($menu_items as $key => $tab) {
							if ($tab) {
								$url_tab = $tab['url'];
								$title_tab = $tab['title'];
								// $first = ($tab['index'] == 0) ? $first = ' active' : $first = '';
								if($tab['children'] !== 'null') {
									$children_items[] = $tab['children'];
								}
								echo ($div_title) ? '<div class="mob-contents__title"><span>'.$title_parent.'</span><button class="back">назад</button></div>' : null;

								if($children_items) {
									echo '<li>';
										echo ($url_tab == 'null') ? '<span>'.$title_tab.'</span>' : '<a href="'.$url_tab.'">'.$title_tab.'</a>';
											echo ($url_tab == 'null') ? '<ul>' : null;
												foreach($children_items as $index_uls => $uls) {
													if ($uls) {
														foreach($uls as $li) {
															$this_url = $li['url'];
															$this_title = $li['title'];
															$tabs_li = ($this_url == 'null') ? '<li><span>'.$this_title.'</span></li>' : '<li><a href="'.$this_url.'">'.$this_title.'</a></li>';
															echo $tabs_li;
															$tabs_li = null;
														}
														$li = null;
													}
												}
												$children_items = null;
												$uls = null;
										echo ($url_tab == 'null') ? '</ul>' : null;
									echo '</li>';
								}
								$div_title = false;
							}
						}
					echo '</ul>';
					echo ($count_key == ($count_nav_menu_item_parents-1)) ? '</div>' : null;
					$count_key++;
				}
				$nav_menu_item_parents = null;
				$menu_items = null;
				$tab = null;
				$tabs_li = null;
				$children_items = null;
				$uls = null;
				$li = null;
			}
		}
	}
	echo '</div></div>';
}