<?php

/**
 * Carbon Fields.
 */

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
			Field::make('complex', 'site-head-include', 'Теги для head')
				->add_fields('tag', array(
					Field::make('textarea', 'tag'),
				))
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
	require_once(get_stylesheet_directory() . '/vendor/autoload.php');
	\Carbon_Fields\Carbon_Fields::boot();
}
