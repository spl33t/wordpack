<?php
/*
* CRB FORMS
*/


use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_forms');
function crb_forms() {

    Container::make('post_meta', 'FORMS', 'FORMS')
        ->where('post_type', '=', 'form')
        ->add_fields(array(
            Field::make('textarea', 'test', 'Title'),
            Field::make('complex', 'form_elements')
                ->add_fields('phone_input', array(
                    Field::make('radio', 'is_require')
                        ->set_options(array(
                            'true' => 'true',
                            'false' => 'false',
                        ))
                ))
                ->add_fields('name_input', array(
                    Field::make('radio', 'is_require')
                        ->set_options(array(
                            'true' => 'true',
                            'false' => 'false',
                        ))
                        ->set_default_value('false')
                ))
        ));

}


