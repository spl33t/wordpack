<?php

/**
 * Site logo.
 */

?>

<a class="branding" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
    <svg class="logo">
        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/icons.svg#icon-instagram" />
    </svg>
    <p class="title"> <?php bloginfo('name'); ?> </p>
</a>