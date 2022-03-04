<?php

/**
 * The current version of the theme
 */
define('WORDPACK_VERSION', '2.0');

/**
 * ENVIRONMENT Define
 */
$httpAddress = explode('.', $_SERVER['HTTP_HOST']);

if (substr($_SERVER['REMOTE_ADDR'], 0, 4) == '127.' || $_SERVER['REMOTE_ADDR'] == '::1') {
    define('ENVIRONMENT', 'development');
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 'On');
} elseif ($httpAddress[count($httpAddress) - 1] == 'tech') {
    define('ENVIRONMENT', 'development');
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 'On');
} else {
    define('ENVIRONMENT', 'production');
}

/**
 * Loads scripts and styles
 */
function scriptEnvVersion() {
    if (ENVIRONMENT == 'production') {
        return WORDPACK_VERSION;
    } else {
        return time();
    }
}

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('jquery');
    // CSS
    wp_enqueue_style(
        'styles', // идентификатор стиля
        get_stylesheet_directory_uri() . '/dist/main.css',  // URL стиля
        array(), // без зависимостей
        scriptEnvVersion() // версия
    );

    // JavaScript
    wp_enqueue_script(
        'scripts', // идентификатор скрипта
        get_stylesheet_directory_uri() . '/dist/main.js', // URL скрипта
        array(), // без зависимостей
        scriptEnvVersion(), // версия
        true
    );

    wp_localize_script('jquery', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );


});


/**
 * Loads other functions
 */
require get_theme_file_path('/includes/custom-post-type.php'); // CPT
require get_theme_file_path('/includes/services/index.php'); // Services CPT
require get_theme_file_path('/includes/carbon-fileds.php'); // CRB init
require get_theme_file_path('/includes/theme-options/index.php'); // Theme options
require get_theme_file_path('/includes/seo/index.php'); // SEO
require get_theme_file_path('/includes/modals/index.php'); // Modals
require get_theme_file_path('/includes/duplicate-posts.php');
require get_theme_file_path('/includes/nav-walker.php');
require get_theme_file_path('/includes/debug.php');
require get_theme_file_path('/includes/webp-converter.php');


/*
* Global variables for JavaScript
*/
add_action('wp_head', function () { ?>
    <script type="text/javascript">
        let templateUrl = '<?php echo get_template_directory_uri(); ?>';
    </script>
<?php });

/*
* Support theme functions (add_theme_support)
*/
add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
    // Other functions on link
    // https://wp-kama.ru/function/add_theme_support#html5
});

/*
* Register menu areas
*/
register_nav_menus(
    array(
        'header_menu' => 'Header menu',
    )
);


/*
 * Remove Metabox Content on All Pages
 */
add_action('admin_init', function () {
    remove_post_type_support('page', 'editor');
});

/*
 * Remove trash meta tags in <head> </head>
 */
if ('Remove trash meta tags in head tag') {
    remove_action('wp_head', 'wp_resource_hints', 2); //remove dns-prefetch
    remove_action('wp_head', 'wp_generator'); //remove meta name="generator"
    remove_action('wp_head', 'wlwmanifest_link'); //remove wlwmanifest
    remove_action('wp_head', 'rsd_link'); // remove EditURI
    remove_action('wp_head', 'rest_output_link_wp_head'); // remove 'https://api.w.org/
    remove_action('wp_head', 'rel_canonical'); //remove canonical
    remove_action('wp_head', 'wp_shortlink_wp_head', 10); //remove shortlink
    remove_action('wp_head', 'wp_oembed_add_discovery_links'); //remove alternate
}

/*
 * jQuery Migrate Disable
 */
add_filter('wp_default_scripts', function (&$scripts) {
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array('jquery-core'), '1.12.4');
    }
});


// Create demo page and home page set
if (isset($_GET['activated']) && is_admin()) {
    // Home page create
    $demo_page_title = 'WordPack demo page';
    $demo_page_check = get_page_by_title($demo_page_title);

    $demo_page = array(
        'post_type' => 'page',
        'post_title' => $demo_page_title,
        'post_status' => 'publish',
        'post_author' => 1,
    );

    if (!isset($demo_page_check->ID)) {
        //Add demo page
        $new_page_id = wp_insert_post($demo_page);
        //Change template for demo page
        update_post_meta($new_page_id, '_wp_page_template', '/page-templates/demo.php');
        //Change home page
        $homepage = get_page_by_title('WordPack demo page');
        update_option('page_on_front', $homepage->ID);
        update_option('show_on_front', 'page');
    }

    // Blog page create
    $blog_page_title = 'Blog';
    $blog_page_check = get_page_by_title($blog_page_title);

    $blog_page = array(
        'post_type' => 'page',
        'post_title' => $blog_page_title,
        'post_status' => 'publish',
        'post_author' => 1,
    );

    if (!isset($blog_page_check->ID)) {
        //Add blog page
        $new_page_id = wp_insert_post($blog_page);
        //Change post page
        $post_page = get_page_by_title('Blog');
        update_option('page_for_posts', $post_page->ID);
    }


    //Menu Create
    $menu_name = 'Header menu';
    $menu_location = 'header_menu';
    if (!wp_get_nav_menu_object($menu_name)) {
        $menu_id = wp_create_nav_menu($menu_name);

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Home'),
            'menu-item-classes' => 'home',
            'menu-item-url' => home_url('/'),
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Blog'),
            'menu-item-classes' => 'blog',
            'menu-item-url' => home_url('/blog/'),
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Пример страницы'),
            'menu-item-classes' => 'sample-page',
            'menu-item-url' => home_url('/sample-page/'),
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Download theme'),
            'menu-item-classes' => 'header-download-theme',
            'menu-item-url' => 'https://github.com/spl1t/wordpack',
            'menu-item-status' => 'publish'));


        if (!has_nav_menu($menu_location)) {
            $locations = get_nav_menu_locations();
            $locations[$menu_location] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }
}


function getImageByID($id, $class) {
    $imageLink = wp_get_attachment_image_url($id, 'full');
    if (file_exists($imageLink . '.webp')) {
        $template = '<picture class="' . $class . '">
                    <source srcset=" ' . $imageLink . '.webp " type="image/webp">
                    <source srcset="' . $imageLink . '" type="image/jpeg">
                    <img src="' . $imageLink . '">
                </picture>';

        echo $template;
        return;
    }

    if ($imageLink) {
        $template = '<picture class="' . $class . '">
                    <source srcset="' . $imageLink . '" type="image/jpeg">
                    <img src="' . $imageLink . '">
                </picture>';

        echo $template;
        return;
    }

    echo 'Изображение не найдено';
}

function getImageByUrl($url, $class) {
    if (file_exists($url . '.webp')) {
        $template = '<picture class="' . $class . '">
                    <source srcset=" ' . $url . '.webp " type="image/webp">
                    <source srcset="' . $url . '" type="image/jpeg">
                    <img src="' . $url . '">
                </picture>';

        echo $template;
        return;
    }

    if ($url) {
        $template = '<picture class="' . $class . '">
                    <source srcset="' . $url . '" type="image/jpeg">
                    <img src="' . $url . '">
                </picture>';

        echo $template;
        return;
    }

    echo 'Изображение не найдено';
}






