<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

## заменим слово «записи» на «статьи»
add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
	$new = array(
		'name'                  => 'Отзывы',
		'singular_name'         => 'Отзыв',
		'add_new'               => 'Добавить отзыв',
		'add_new_item'          => 'Добавить отзыв',
		// 'edit_item'             => 'Редактировать статью',
		// 'new_item'              => 'Новая статья',
		// 'view_item'             => 'Просмотреть статью',
		// 'search_items'          => 'Поиск статей',
		// 'not_found'             => 'Статей не найдено.',
		// 'not_found_in_trash'    => 'Статей в корзине не найдено.',
		// 'parent_item_colon'     => '',
		'all_items'             => 'Отзывы',
		// 'archives'              => 'Архивы статей',
		// 'insert_into_item'      => 'Вставить в статью',
		// 'uploaded_to_this_item' => 'Загруженные для этой статьи',
		// 'featured_image'        => 'Миниатюра статьи',
		// 'filter_items_list'     => 'Фильтровать список статей',
		// 'items_list_navigation' => 'Навигация по списку статей',
		// 'items_list'            => 'Список статей',
		// 'menu_name'             => 'Записи',
		'name_admin_bar'        => 'Статью', // пункте "добавить"
	);
	return (object) array_merge( (array) $labels, $new );
}

// хук для регистрации
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){
	register_taxonomy( 'doctors', [ 'post' ], [
		'label'                 => 'Имя', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Специалисты',
			'singular_name'     => 'Специалисты',
			'search_items'      => 'Поиск специалиста',
			'all_items'         => 'Все специалисты',
			'view_item '        => 'Смотреть',
			'parent_item'       => 'Родитель специалиста',
			'parent_item_colon' => 'Родитель специалиста:',
			'edit_item'         => 'Редактирование специалиста',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить нового специалиста',
			'new_item_name'     => __( 'New Tag Name' ),
			'menu_name'         => 'Врачи',
			'back_to_items'     => '← Перейти к специалистам',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => false, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		// 'hierarchical'          => false,
		'rewrite'       			=> array( 'slug' => 'doctors' ),
		// 'rewrite'               => true,
		// 'query_var'     		=> true,
		// 'query_var'             => $taxonomy, // название параметра запроса
		// 'query_var' 			=> true,
		'capabilities'          => array(),
		'meta_box_cb'           => false, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );

	register_taxonomy( 'stocks', [ 'post' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Акции',
			'singular_name'     => 'Акции',
			'search_items'      => 'Поиск акций',
			'all_items'         => 'Все акции',
			'view_item '        => 'Смотреть',
			'parent_item'       => 'Родитель акции',
			'parent_item_colon' => 'Родитель акции:',
			'edit_item'         => 'Редактирование акции',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить новую акцию',
			'new_item_name'     => __( 'New Tag Name' ),
			'menu_name'         => 'Акции',
			'back_to_items'     => '← Перейти к акциям',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => false, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => false, // равен аргументу public
		// 'show_in_menu'          => false, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => false, // равен аргументу show_ui
		// 'hierarchical'          => false,
		// 'hierarchical'			=> true,
		// 'rewrite'               => true,
		'rewrite'       			=> array( 'slug' => 'stocks' ),
		//'query_var'             => $taxonomy, // название параметра запроса
		// 'query_var'     		=> true,
		'capabilities'          => array(),
		'meta_box_cb'           => false, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );

	register_taxonomy( 'portfolio', [ 'post' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Портфолио',
			'singular_name'     => 'Портфолио',
			'search_items'      => 'Поиск работы',
			'all_items'         => 'Все работы',
			'view_item '        => 'Смотреть',
			'parent_item'       => 'Родитель портфолио',
			'parent_item_colon' => 'Родитель портфолио:',
			'edit_item'         => 'Редактирование работы',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить новую работу',
			'new_item_name'     => __( 'New Tag Name' ),
			'menu_name'         => 'Портфолио',
			'back_to_items'     => '← Перейти к портфолио',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => false, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => false, // равен аргументу public
		// 'show_in_menu'          => false, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => false, // равен аргументу show_ui
		// 'hierarchical'          => false,
		// 'hierarchical'			=> true,
		// 'rewrite'               => true,
		'rewrite'       			=> array( 'slug' => 'portfolio' ),
		//'query_var'             => $taxonomy, // название параметра запроса
		// 'query_var'     		=> true,
		'capabilities'          => array(),
		'meta_box_cb'           => false, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );

	register_taxonomy( 'vacancy', [ 'post' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Вакансии',
			'singular_name'     => 'Вакансии',
			'search_items'      => 'Поиск вакансий',
			'all_items'         => 'Все вакансии',
			'view_item '        => 'Смотреть',
			'parent_item'       => 'Родитель вакансии',
			'parent_item_colon' => 'Родитель вакансии:',
			'edit_item'         => 'Редактирование вакансии',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить новую вакансию',
			'new_item_name'     => __( 'New Tag Name' ),
			'menu_name'         => 'Вакансии',
			'back_to_items'     => '← Перейти к вакансиям',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => false, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => false, // равен аргументу public
		// 'show_in_menu'          => false, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => false, // равен аргументу show_ui
		// 'hierarchical'          => false,
		// 'hierarchical'			=> true,
		// 'rewrite'               => true,
		'rewrite'       			=> array( 'slug' => 'vacancy' ),
		//'query_var'             => $taxonomy, // название параметра запроса
		// 'query_var'     		=> true,
		'capabilities'          => array(),
		'meta_box_cb'           => false, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );


}

## Переименуем таксономию category (post_tag)
add_action( 'init', function(){
	global $wp_taxonomies;
	$labels                     = & $wp_taxonomies['post_tag']->labels;
	// $labels->slug               = 'Специализации';
	$labels->name               = 'Специализации';
	$labels->singular_name      = 'Специализации';
	$labels->add_new            = 'Добавить Специализацию';
	$labels->add_new_item       = 'Добавить Специализацию';
	$labels->edit_item          = 'Редактировать специализацию';
	$labels->new_item           = 'Специализации';
	$labels->view_item          = 'Просмотр специализации';
	$labels->search_items       = 'Поиск специализации';
	$labels->not_found          = 'Специализации не найдены';
	$labels->not_found_in_trash = 'Специализации в корзине не найдены';
	$labels->all_items          = 'Все специализации';
	$labels->menu_name          = 'Специализации';
	$labels->name_admin_bar     = 'Специализации';
});

add_action( 'init', function(){
	global $wp_taxonomies;
	$labels                     = & $wp_taxonomies['category']->labels;
	// $labels->slug               = 'Специализации';
	$labels->name               = 'Услуги';
	$labels->singular_name      = 'Услуги';
	$labels->add_new            = 'Добавить услугу';
	$labels->add_new_item       = 'Добавить услугу';
	$labels->edit_item          = 'Редактировать услугу';
	$labels->new_item           = 'Услуги';
	$labels->view_item          = 'Просмотр услуги';
	$labels->search_items       = 'Поиск услуги';
	$labels->not_found          = 'Услуги не найдены';
	$labels->not_found_in_trash = 'Услуги в корзине не найдены';
	$labels->all_items          = 'Все услуги';
	$labels->menu_name          = 'Услуги';
	$labels->name_admin_bar     = 'Услуги';
});


// АКЦИИ таксономия
add_filter('manage_stocks_custom_column' , 'stocks_thumbnail_columns_content' , 10 , 3);
function stocks_thumbnail_columns_content($content, $column_name, $term_id) {
    if ('stocks_thumbnail' == $column_name) {
        $term = get_term($term_id);
        $thumbnail_url = get_field('stocks-img', $term);
        $content = '<img src="'.$thumbnail_url.'" width="60" />';
	}
    return $content;
}


add_filter('manage_stocks_custom_column' , 'stocks_on_columns_content' , 10 , 4);
function stocks_on_columns_content($content, $column_name, $term_id) {
	if ('stocks_on' == $column_name) {
        $term = get_term($term_id);
        $stocks_on_var = get_field('stocks-on', $term);
			if($stocks_on_var == 1) {
				$content = '<span style="color:green;">Да</span>';
			}
			else {
				$content = '<span style="color:red;">Нет</span>';
			}
	}
    return $content;
}
add_filter( 'manage_edit-stocks_columns', 'stocks_edit_columns');
function stocks_edit_columns( $col ) {
	unset($col[ 'slug' ]);
	unset($col[ 'posts' ]);
	unset($col[ 'stocks_on' ]);
	unset($col[ 'name' ]);
	unset($col[ 'description' ]);
	unset($col[ 'stocks_thumbnail' ]);
	unset($col[ 'cb' ]);
	$col[ 'cb' ] = __('Cb');
	$col[ 'stocks_thumbnail' ] = __('Thumbnail');
	$col[ 'name' ] = __('Name');
	$col[ 'description' ] = __('Description');
	$col[ 'stocks_on' ] = 'Включено';
	return $col;
}

//Доктора таксономия
add_filter('manage_doctors_custom_column' , 'doctors_thumbnail_columns_content' , 10 , 3);
function doctors_thumbnail_columns_content($content, $column_name, $term_id) {
    if ('doctors_thumbnail' == $column_name) {
        $term = get_term($term_id);
        $thumbnail_url = get_field('specialist-img', $term);
		$thumbnail_mini_url = get_field('specialist-img-mini', $term);
		$default_img = get_template_directory_uri().'/assets/img/wp/doctor/default.png';
		if (!empty($thumbnail_url) && !empty($thumbnail_mini_url)) {
			$img_url = $thumbnail_url;
			$content = '<a href="/wp-admin/term.php?taxonomy=doctors&tag_ID='.$term_id.'"><img src="'.$img_url.'" width="80" /></a>';
		}else {
			$img_url = $default_img;
			$type_img = ((empty($thumbnail_url)) && (empty($thumbnail_mini_url))) ? 'изображение и миниатюру' : ((empty($thumbnail_url)) && (!empty($thumbnail_mini_url)) ? 'изображение' : 'миниатюру');
			$content = '<a href="/wp-admin/term.php?taxonomy=doctors&tag_ID='.$term_id.'" style="color:red;display:block;text-decoration:underline;"><img src="'.$img_url.'" width="80" /><br>Заполните '.$type_img.'!</a>';
		}
	}
    return $content;
}

add_filter('manage_doctors_custom_column' , 'doctors_professions_columns_content' , 10 , 4);
function doctors_professions_columns_content($contents, $column_name, $term_id) {
    if ('doctors_professions' == $column_name) {
        $term = get_term($term_id);
        $professions = get_field('specialist-profession', $term);
		$experience = get_field('experience', $term);
		$current_year = date("Y");
		$experience_year = $current_year - $experience;
		foreach($professions as $value) {
			$content = $value->name.'<br>';
		}
		$experience_html = 'Стаж ' .$experience_year.' ' .inclination_years(substr($experience_year, -1), $experience_year).' ('.$experience.')';
		$contents = $content .''. $experience_html;
	}

    return $contents;
}


add_filter( 'manage_edit-doctors_columns', 'doctors_edit_columns');
function doctors_edit_columns($col) {
	unset($col[ 'slug' ]);
	unset($col[ 'posts' ]);
	unset($col[ 'name' ]);
	unset($col[ 'description' ]);
	unset($col[ 'stocks_thumbnail' ]);
	unset($col[ 'cb' ]);
	$col[ 'cb' ] = __('Cb');
	$col[ 'doctors_thumbnail' ] = __('Thumbnail');
	$col[ 'name' ] = 'Фамилия';
	$col[ 'doctors_professions' ] = 'Специализации, стаж';
	return $col;
}

//Специализации

add_filter( 'manage_edit-post_tag_columns', 'post_tag_edit_columns', 25);
function post_tag_edit_columns($col) {
	// unset($col[ 'slug' ]);
	unset($col[ 'posts' ]);
	// unset($col[ 'name' ]);
	unset($col[ 'description' ]);
	// unset($col[ 'thumbnail' ]);
	// unset($col[ 'cb' ]);
	// $col[ 'cb' ] = __('Cb');
	// $col[ 'doctors_thumbnail' ] = __('Thumbnail');
	// $col[ 'name' ] = 'Фамилия';
	// $col[ 'doctors_professions' ] = 'Специализации, стаж';
	return $col;
}


//Вакансии
add_filter( 'manage_edit-vacancy_columns', 'vacancy_edit_columns', 25);
function vacancy_edit_columns($col) {
	// unset($col[ 'slug' ]);
	unset($col[ 'posts' ]);
	// unset($col[ 'name' ]);
	$col[ 'vacancy_on' ] = 'Включено';
	// unset($col[ 'description' ]);
	// unset($col[ 'thumbnail' ]);
	// unset($col[ 'cb' ]);
	// $col[ 'cb' ] = __('Cb');
	// $col[ 'doctors_thumbnail' ] = __('Thumbnail');
	// $col[ 'name' ] = 'Фамилия';
	// $col[ 'doctors_professions' ] = 'Специализации, стаж';
	return $col;
}

add_filter('manage_vacancy_custom_column' , 'vacancy_on_columns_content' , 10 , 4);
function vacancy_on_columns_content($content, $column_name, $term_id) {
	if ('vacancy_on' == $column_name) {
        $term = get_term($term_id);
        $stocks_on_var = get_field('vacancy_on', $term);
			if($stocks_on_var == 1) {
				$content = '<span style="color:green;">Да</span>';
			}
			else {
				$content = '<span style="color:red;">Нет</span>';
			}
	}
    return $content;
}


// Услуги
add_filter( 'manage_edit-category_columns', 'post_edit_columns', 25);
function post_edit_columns( $col ) {
	unset($col[ 'description' ]);
	unset($col[ 'posts' ]);
	unset($col[ 'slug' ]);
	$col[ 'main_cat' ] = 'Категория';
	$col[ 'slug' ] = 'Ярлык';
	return $col;
}

add_filter('manage_category_custom_column' , 'category_on_columns_content' , 10 , 4);
function category_on_columns_content($content, $column_name, $term_id) {
	if ('main_cat' == $column_name) {
        $term = get_term($term_id);
        $category_main = get_field('category_main', $term);
		if($category_main) {
			$content = '<span>'.$category_main['label'].'</span>';
		}else {
			$content = '';
		}
	}
    return $content;
}