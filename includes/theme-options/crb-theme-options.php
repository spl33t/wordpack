<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_main_theme_options');
function crb_main_theme_options() {
    Container::make('theme_options', 'Настройки темы')
        ->set_page_file('site-options.php')
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
}

add_action('carbon_fields_register_fields', 'crb_optimize_theme_options');
function crb_optimize_theme_options() {
    Container::make('theme_options', 'Оптимизация темы')
        ->set_page_parent('site-options.php') // reference to a top level container
        ->add_fields(array(
            Field::make('radio', 'disable_comments')
                ->set_options(array(
                    'true' => 'true',
                    'false' => 'false'
                ))
                ->set_default_value('false'),
            Field::make('radio', 'disable_wp_search')
                ->set_options(array(
                    'true' => 'true',
                    'false' => 'false'
                ))
                ->set_default_value('false'),
            Field::make('radio', 'disable_emojis')
                ->set_options(array(
                    'true' => 'true',
                    'false' => 'false'
                ))
                ->set_default_value('true'),
            Field::make('radio', 'disable_gutenberg')
                ->set_options(array(
                    'true' => 'true',
                    'false' => 'false'
                ))
                ->set_default_value('true'),
            Field::make('radio', 'disable_oembed')
                ->set_options(array(
                    'true' => 'true',
                    'false' => 'false'
                ))
                ->set_default_value('true'),
        ));
}

