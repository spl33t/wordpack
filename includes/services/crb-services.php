<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_services');
function crb_services() {
    Container::make('post_meta', 'SERVICES', 'SERVICES')
        ->where('post_type', '=', 'service')
        ->add_fields(array(
            Field::make('text', 'price', 'Price'),
        ));
}


