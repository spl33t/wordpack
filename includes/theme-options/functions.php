<?php

add_action('carbon_fields_fields_registered', 'crb_values_are_avail');
function crb_values_are_avail() {
    //Comments disable
    if (carbon_get_theme_option('disable_comments') == 'true') {
        require plugin_dir_path(__FILE__) . '/functions/disable-wp-comments.php';
    }
    //Emojis disable
    if (carbon_get_theme_option('disable_emojis') == 'true') {
        require plugin_dir_path(__FILE__) . '/functions/disable-emojis.php';
    }
    //Gutenberg disable
    if (carbon_get_theme_option('disable_gutenberg') == 'true') {
        require plugin_dir_path(__FILE__) . '/functions/disable-gutenberg.php';
    }
    //Oembed disable
    if (carbon_get_theme_option('disable_oembed') == 'true') {
        require plugin_dir_path(__FILE__) . '/functions/disable-oembed.php';
    }
    //WP search disable
    if (carbon_get_theme_option('disable_wp_search') == 'true') {
        require plugin_dir_path(__FILE__) . '/functions/disable-wp-search.php';
    }

    //WP search disable
    if (carbon_get_theme_option('maintenance_mode') == 'yes') {
        if (!current_user_can('edit_themes') || !is_user_logged_in()) {
            wp_die('
                <h1>Ведутся технические работы</h1>
                <br>
                Сайт находится на техническом обслуживании, зайдите позже.
              ');
        }
    }

}

