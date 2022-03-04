<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_seo');
function crb_seo() {
    Container::make('theme_options', 'SEO')
        ->set_page_file('seo-options.php')
        ->set_icon('dashicons-search')
        ->add_tab(__('Глобально'), array(
            Field::make('select', 'title_separator')
                ->set_options(array(
                    ' - ' => '-',
                    ' – ' => '–',
                    ' — ' => '—',
                    ' · ' => '·',
                    ' • ' => '•',
                    ' * ' => '*',
                    ' ⋆ ' => '⋆',
                    ' « ' => '«',
                    ' » ' => '»',
                    ' < ' => '<',
                    ' > ' => '>',
                )),
            Field::make('textarea', 'site_name')
                ->set_default_value(get_bloginfo('name')),
            Field::make('textarea', 'site_description')
                ->set_default_value(get_bloginfo('description')),
            Field::make('textarea', 'site_keywords')
                ->set_default_value(get_bloginfo('wordpack')),
        ));

    /*
     * SEO for Single Post (post meta)
     */
    Container::make('post_meta', 'SEO', 'SEO')
        ->where('post_type', '=', 'post')
        ->or_where('post_type', '=', 'page')
        ->or_where('post_type', '=', 'layout')
        ->or_where('post_type', '=', 'services')
        ->add_fields(array(
            Field::make('textarea', 'seo-title', 'Title'),
            Field::make('textarea', 'seo-description', 'Description Meta'),
            Field::make('textarea', 'seo-keywords', 'Keywords Meta')
        ));
}


