<?php

add_action('wp_ajax_modal_ajax', 'modal_ajax_callback');
add_action('wp_ajax_nopriv_modal_ajax', 'modal_ajax_callback');
function modal_ajax_callback() {
    $modal = $_POST['modal'];

    if ($modal) {
        echo get_template_part('/template-parts/modals/' . $modal);

    }

    // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
    wp_die();
}



function modal_display_hook() {
    do_action('modal_display_hook');
}

function modal_for_front_page() {
    if(is_front_page()) {
        get_template_part('template-parts/modals/order', '', ['condition_type' => 'delay_50']);
    }
}
add_action('modal_display_hook', 'modal_for_front_page');



