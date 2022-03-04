<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_main_theme_options');
function crb_main_theme_options() {

    $basic_options_container = Container::make('theme_options', 'Настройки темы')
        ->set_page_file('site-options.php')
        ->add_fields(array(

            // Телефоны
            Field::make('separator', 'separator-phones', 'Телефон'),
            Field::make('text', 'site-telephone', 'Телефон')
                ->set_width(50),
            Field::make('text', 'site-telephone-work', 'Время работы телефона')
                ->set_width(50),
            Field::make('text', 'site-add-telephone', 'Дополнительный телефон')
                ->set_width(50),
            Field::make('text', 'site-add-telephone-work', 'Время работы дополнительного телефона')
                ->set_width(50),

            // Адрес
            Field::make('separator', 'separator-address', 'Адрес'),
            Field::make('text', 'site-adress', 'Адрес')
                ->set_width(50),
            Field::make('text', 'site-adress-work', 'Время работы адреса')
                ->set_width(50),

            // Email
            Field::make('separator', 'separator-email', 'Email'),
            Field::make('text', 'site-email', 'Почта')
                ->set_width(50),
            Field::make('text', 'site-email-lead', 'Почта для заявок')
                ->set_attribute( 'placeholder', 'Оставьте пустым тогда письма будут приходить на обычную почту' )
                ->set_width(50),

            // Юр. данные
            Field::make('separator', 'separator-legal_data', 'Юр. данные'),
            Field::make('text', 'site-inn', 'ИНН')
                ->set_width(50),
            Field::make('text', 'site-ogrn', 'ОГРН')
                ->set_width(50),

            // WhatsApp
            Field::make('separator', 'separator-whatsapp', 'WhatsApp'),
            Field::make('text', 'site-whatsapp', 'Whatsapp account')
                ->set_width(33),

            // Telegram
            Field::make('separator', 'separator-telegram', 'Telegram'),
            Field::make('text', 'site-telegram', 'Telegram account')
                ->set_width(33),
            Field::make('text', 'telegram_bot_token', 'Telegram Bot Token')
                ->set_width(33),
            Field::make('text', 'telegram_chat_id', 'Telegram Chat ID')
                ->set_width(33),

            // Viber
            Field::make('separator', 'separator-viber', 'Viber'),
            Field::make('text', 'site-viber', 'Viber account')
                ->set_width(33),

            // Instagram
            Field::make('separator', 'separator-instagram', 'Instagram'),
            Field::make('text', 'site-instagram', 'Instagram account')
                ->set_width(33),

            // YouTube
            Field::make('separator', 'separator-youtube', 'Youtube'),
            Field::make('text', 'site-youtube', 'Youtube account')
                ->set_width(33),

            // FaceBook
            Field::make('separator', 'separator-facebook', 'FaceBook'),
            Field::make('text', 'site-facebook', 'Facebook account')
                ->set_width(33),

            // VK
            Field::make('separator', 'separator-vk', 'VK'),
            Field::make('text', 'site-vk', 'VK account')
                ->set_width(33),

            // TitTok
            Field::make('separator', 'separator-tik-tok', 'Tik Tok'),
            Field::make('text', 'site-tik-tok', 'Tik Tok account')
                ->set_width(33),

            //Другое, счётчики
            Field::make('separator', 'separator-other', 'Другое'),
            Field::make('complex', 'site-head-include', 'Теги для head')
                ->add_fields('tag', array(
                    Field::make('textarea', 'tag'),
                ))
        ));


    // Optimization theme functions
    Container::make('theme_options', 'Оптимизация темы')
        ->set_page_parent($basic_options_container) // reference to a top level container
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


    // Other options
    Container::make('theme_options', 'Другое')
        ->set_page_parent($basic_options_container) // reference to a top level container
        ->add_fields(array(
            Field::make( 'checkbox', 'maintenance_mode', 'Технические работы')
                ->set_option_value( 'yes' )
        ));



}


add_action('carbon_fields_register_fields', 'crb_optimize_theme_options');
function crb_optimize_theme_options() {

}

