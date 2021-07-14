<?php

// Carbon_Fields
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
	Container::make('theme_options',  'Theme Options')
		->add_fields(array(
			Field::make('separator', 'site-branding', 'Брендинг'),
			Field::make('image', 'site-logo-white', 'Белое лого')
				->set_value_type('url')
				->set_width(50),
			Field::make('image', 'site-logo-black', 'Белое лого')
				->set_value_type('url')
				->set_width(50),
			Field::make('color', 'site-color-main', 'Основной цвет'),


			Field::make('separator', 'site-contact', 'Контакты'),
			Field::make('text', 'site-telephone', 'Телефон')
				->set_width(50),
			Field::make('text', 'site-telephone-work', 'Время работы телефона')
				->set_width(50),
			Field::make('text', 'site-add-telephone', 'Дополнительный телефон')
				->set_width(50),
			Field::make('text', 'site-add-telephone-work', 'Время дополнительного телефона')
				->set_width(50),
			Field::make('text', 'site-adress', 'Адрес')
				->set_width(50),
			Field::make('text', 'site-adress-work', 'Время работы адреса')
				->set_width(50),
			Field::make('text', 'site-email', 'Электронная почта')
				->set_width(100),
			Field::make('text', 'site-inn', 'ИНН')
				->set_width(50),
			Field::make('text', 'site-ogrn', 'ОГРН')
				->set_width(50),


			Field::make('separator', 'site-social', 'Соц. сети / Мессенджеры'),
			Field::make('text', 'site-whatsapp', 'Whatsapp')
				->set_width(33),
			Field::make('text', 'site-telegram', 'Telegram')
				->set_width(33),
			Field::make('text', 'site-viber', 'Viber')
				->set_width(33),
			Field::make('text', 'site-instagram', 'Instagram')
				->set_width(33),
			Field::make('text', 'site-youtube', 'Youtube')
				->set_width(33),
			Field::make('text', 'site-facebook', 'Facebook')
				->set_width(33),
			Field::make('text', 'site-vk', 'VK')
				->set_width(33),
			Field::make('text', 'site-tik-tok', 'Tik Tok')
				->set_width(33),


			Field::make('separator', 'site-other', 'Другое'),
			Field::make('textarea', 'site-ya-metrika', 'Код счетчика Я.Метрика'),
			Field::make('textarea', 'site-google-analytics', 'Код счетчика Google Analytics'),
		));
}

add_action('after_setup_theme', 'crb_load');
function crb_load()
{
	require_once('vendor/autoload.php');
	\Carbon_Fields\Carbon_Fields::boot();
}


/**
 * Loads <list assets here>.
 */
add_action('wp_enqueue_scripts', 'true_enqueue_js_and_css');

function true_enqueue_js_and_css()
{

	// CSS
	wp_enqueue_style(
		'styles', // идентификатор стиля
		get_stylesheet_directory_uri() . '/dist/main.css',  // URL стиля
		array(), // без зависимостей
		time() // версия
	);

	// JavaScript
	wp_enqueue_script(
		'scripts', // идентификатор скрипта
		get_stylesheet_directory_uri() . '/dist/main.js', // URL скрипта
		array(), // без зависимостей
		time(), // версия
		true
	);
}


/*
* Поддержка некоторых опций в теме (add_theme_support)
*/
add_action('after_setup_theme', function () {
	add_theme_support('post-thumbnails');
});

/*
* Регистрация области меню
*/
register_nav_menus(
	array(
		'header_menu' => 'Header Menu',
	)
);
