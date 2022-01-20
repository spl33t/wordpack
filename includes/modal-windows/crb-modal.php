<?php
/*
* CRB FORMS
*/


use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_modals');
function crb_modals() {

    Container::make('post_meta', 'MODALS', 'MODALS')
        ->where('post_type', '=', 'modal')
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


