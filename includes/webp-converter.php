<?php

// Only dependency that's used
// TODO: Implement filter for the_content();

use WebPConvert\WebPConvert;

add_filter('wp_generate_attachment_metadata', function ($meta) {
    $path = wp_upload_dir(); // get upload directory
    $file = $path['basedir'] . '/' . $meta['file']; // Get full size image

    $files[] = $file; // Set up an array of image size urls

    foreach ($meta['sizes'] as $size) {
        $files[] = $path['path'] . '/' . $size['file'];
    }

    foreach ($files as $file) { // iterate through each image size
        list($orig_w, $orig_h, $orig_type) = @getimagesize($file);
        $image = wp_load_image($file);

        switch ($orig_type) {
            case IMAGETYPE_PNG:
            case IMAGETYPE_JPEG:
                $success = WebPConvert::convert($file, $file . '.webp', array(
                    'quality' => 90,
                    // more options available!
                ));
                break;
        }
    }
    return $meta;

});


add_action('delete_attachment', function ($id) {
    if (wp_attachment_is_image($id)) {
        $imageLinks = get_images($id);
        foreach ($imageLinks as $imageLink) {
            if (ABSPATH . wp_make_link_relative($imageLink) . '.webp') {
                unlink(ABSPATH . wp_make_link_relative($imageLink) . '.webp');
            }
        }
    }
});

add_filter('post_thumbnail_html', function ($html, $post_id, $post_thumbnail_id, $size, $attr) {
    $id = get_post_thumbnail_id(); // gets the id of the current post_thumbnail (in the loop)
    $src = wp_get_attachment_image_src($id, $size); // gets the image url specific to the passed in size (aka. custom image size)
    $alt = get_the_title($id); // gets the post thumbnail title
    //$class = $attr['class']; // gets classes passed to the post thumbnail, defined here for easier function access
    if (empty($src)) {
        $src = wp_get_attachment_image_src($id, 'full'); // gets the image url specific to the passed in size (aka. custom image size)
    }

    $html = '<picture>';
    // Check if webp version exists, not converting Gif images
    if (file_exists(ABSPATH . wp_make_link_relative($src[0]) . '.webp')) {
        $html .= '<source srcset="' . $src[0] . '.webp" type="image/webp">';
    }
    $html .= '<source srcset="' . $src[0] . '" type="image/jpeg">';
    $html .= '<img src="' . $src[0] . '" alt="fallback">';
    $html .= '</picture>';


    return $html;
}, 99, 5);

function get_images($id) {
    if (!wp_attachment_is_image($id)) {
        return;
    }

    $links = [];
    $sizes = get_intermediate_image_sizes();

    foreach ($sizes as $size) {
        $image = wp_get_attachment_image_src($id, $size);
        if (!empty($image)) {
            $links[] = $image[0];
        }
    }

    return $links;
}

?>