<?php
/*
* Регистрация кастомных записей
*/
add_action('init', 'register_post_types_services');
function register_post_types_services()
{
	register_post_type('services', [
		'label'  => null,
		'labels' => [
			'name'               => 'Услуги', // основное название для типа записи
			'singular_name'      => 'Услуга', // название для одной записи этого типа
			'add_new'            => 'Добавить ', // для добавления новой записи
			'add_new_item'       => 'Добавление ', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование ', // для редактирования типа записи
			'new_item'           => 'Новое ', // текст новой записи
			'view_item'          => 'Смотреть ', // для просмотра записи этого типа.
			'search_items'       => 'Искать ', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Услуги', // название меню
		],
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-admin-tools',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => true,
		'supports'            => ['title', 'page-attributes', 'thumbnail'], // 'title','editor','author','thumbnail','dashicons-admin-tools','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	]);
}


// хук, через который подключается функция
// регистрирующая новые таксономии (create_book_taxonomies)
add_action('init', 'create_service_taxonomies');

// функция, создающая новые таксономии
function create_service_taxonomies()
{

	// Добавляем древовидную таксономию (Категория)
	register_taxonomy('service', array('services'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => _x('Категория', 'taxonomy general name'),
			'singular_name'     => _x('Категория', 'taxonomy singular name'),
			'search_items'      =>  __('Посик Категорий'),
			'all_items'         => __('Все Категории'),
			'parent_item'       => __('Родительская Категория'),
			'parent_item_colon' => __('Родительская Категория:'),
			'edit_item'         => __('Редактировать Категорию'),
			'update_item'       => __('Обновить Категорию'),
			'add_new_item'      => __('Добавить Категорию'),
			'new_item_name'     => __('Новое имя категории'),
			'menu_name'         => __('Категория'),
		),
		'show_ui'       => true,
		'query_var'     => true,
		//'rewrite'       => array( 'slug' => 'the_genre' ), // свой слаг в URL
	));

	// Добавляем НЕ древовидную таксономию (Метки)
	register_taxonomy('label', 'services', array(
		'hierarchical'  => false,
		'labels'        => array(
			'name'                        => _x('Метка', 'taxonomy general name'),
			'singular_name'               => _x('Метка', 'taxonomy singular name'),
			'search_items'                =>  __('Искать Метку'),
			'popular_items'               => __('Популярные Метки'),
			'all_items'                   => __('Все Метки'),
			'parent_item'                 => null,
			'parent_item_colon'           => null,
			'edit_item'                   => __('Редактировать Метку'),
			'update_item'                 => __('Обновить Метку'),
			'add_new_item'                => __('Доьбаваить Метку'),
			'new_item_name'               => __('Новое имя Метки'),
			'separate_items_with_commas'  => __('Разделяйте метки запятыми'),
			'add_or_remove_items'         => __('Добавить или удалить метку'),
			'choose_from_most_used'       => __('Выберите из наиболее популярных меток'),
			'menu_name'                   => __('Метки'),
		),
		'show_ui'       => true,
		'query_var'     => true,
		//'rewrite'       => array( 'slug' => 'the_writer' ), // свой слаг в URL
	));
}