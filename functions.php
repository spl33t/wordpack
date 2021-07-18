<?php
// Carbon_Fields
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
	/*
	/ Глобальные настройки темы
	*/
	Container::make('theme_options',  'Настройки темы')
		->add_fields(array(
			//Брэндинг
			Field::make('separator', 'site-branding', 'Брендинг'),
			Field::make('image', 'site-logo-white', 'Белое лого')
				->set_value_type('url')
				->set_width(50),
			Field::make('image', 'site-logo-black', 'Чёрное лого')
				->set_value_type('url')
				->set_width(50),
			Field::make('color', 'site-color-main', 'Основной цвет'),
			//Контакты
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
			//Соц. сети, мессенджеры
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
			//Другое, счётчики
			Field::make('separator', 'site-other', 'Другое'),
			Field::make('textarea', 'site-ya-metrika', 'Код счетчика Я.Метрика'),
			Field::make('textarea', 'site-google-analytics', 'Код счетчика Google Analytics'),
		));

	/*
	/ СЕО
	*/
	Container::make('post_meta', 'SEO', 'SEO')
		->add_fields(array(
			Field::make('textarea', 'seo-title', 'Title'),
			Field::make('textarea', 'seo-description', 'Description Meta'),
			Field::make('textarea', 'seo-keywords', 'Keywords Meta')
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

	wp_enqueue_script( 'jquery' );
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

/*
* Отключение стилей для Gutenberg
*/
function dm_remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'dm_remove_wp_block_library_css');


/*
/ Отключение эмоджи
*/
if ('Отключаем Emojis в WordPress') {

	/**
	 * Disable the emoji's
	 */
	function disable_emojis()
	{
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_styles', 'print_emoji_styles');
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
		add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
		add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
	}
	add_action('init', 'disable_emojis');

	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 * 
	 * @param    array  $plugins  
	 * @return   array             Difference betwen the two arrays
	 */
	function disable_emojis_tinymce($plugins)
	{
		if (is_array($plugins)) {
			return array_diff($plugins, array('wpemoji'));
		}

		return array();
	}

	/**
	 * Remove emoji CDN hostname from DNS prefetching hints.
	 *
	 * @param  array  $urls          URLs to print for resource hints.
	 * @param  string $relation_type The relation type the URLs are printed for.
	 * @return array                 Difference betwen the two arrays.
	 */
	function disable_emojis_remove_dns_prefetch($urls, $relation_type)
	{

		if ('dns-prefetch' == $relation_type) {

			// Strip out any URLs referencing the WordPress.org emoji location
			$emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
			foreach ($urls as $key => $url) {
				if (strpos($url, $emoji_svg_url_bit) !== false) {
					unset($urls[$key]);
				}
			}
		}

		return $urls;
	}
}
