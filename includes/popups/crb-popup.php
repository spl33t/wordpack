<?php
/*
* CRB FORMS
*/


use Carbon_Fields\Container;
use Carbon_Fields\Field;

function conditions_exclude_button() {
    return array(
        'relation' => 'OR', // Optional, defaults to "AND"
        array(
            'field' => 'popup_call_type_select',
            'value' => 'entry', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
        ),
        array(
            'field' => 'popup_call_type_select',
            'value' => 'timed', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
        ),
        array(
            'field' => 'popup_call_type_select',
            'value' => 'scroll', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
        ),
        array(
            'field' => 'popup_call_type_select',
            'value' => 'exit', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
        ),
    );
}

add_action('carbon_fields_register_fields', 'crb_modals');
function crb_modals() {

    Container::make('post_meta', 'MODALS', 'MODALS')
        ->where('post_type', '=', 'popup')
        ->add_fields(array(
            Field::make('textarea', 'popup_title', 'Popup title'),
            Field::make('textarea', 'popup_content', 'Popup content'),
            Field::make('select', 'popup_call_type_select', 'Тип вызова popup')
                ->set_options(array(
                    'button' => 'button',
                    'entry' => 'entry',
                    'timed' => 'timed',
                    'scroll' => 'scroll',
                    'exit' => 'exit'
                ))
                ->set_width(50),
            Field::make('select', 'popup_call_pages', 'На каких страницах показывать')
                ->set_options(array(
                    'all' => 'all',
                    'include' => 'include',
                    'exclude' => 'exclude',
                ))
                ->set_conditional_logic(conditions_exclude_button())
                ->set_width(50),
            Field::make('text', 'button_text', 'Button text')
                ->set_width(50)
                ->set_conditional_logic(array(
                    'relation' => 'AND', // Optional, defaults to "AND"
                    array(
                        'field' => 'popup_call_type_select',
                        'value' => 'button', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                        'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                    )
                )),
            Field::make('association', 'assoc_page')
                ->set_types(array(
                    array(
                        'type' => 'post',
                        'post_type' => 'page',
                    ),
                    array(
                        'type' => 'post',
                        'post_type' => 'post',
                    ),
                    array(
                        'type' => 'post',
                        'post_type' => 'services',
                    ),
                    array(
                        'type' => 'term',
                        'taxonomy' => 'category',
                    ),
                    array(
                        'type' => 'term',
                        'taxonomy' => 'post_tag',
                    ),
                ))
                ->set_conditional_logic(array(
                    'relation' => 'OR', // Optional, defaults to "AND"
                    array(
                        'field' => 'popup_call_pages',
                        'value' => 'include', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    ),
                    array(
                        'field' => 'popup_call_pages',
                        'value' => 'exclude', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    ),
                )),
        ));

}
