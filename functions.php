<?php

/**
 * Loads Scripts and Styles
 */
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script('jquery');
	// CSS
	wp_enqueue_style(
		'styles', // идентификатор стиля
		get_stylesheet_directory_uri() . '/dist/main.css',  // URL стиля
		array(), // без зависимостей
		time() // версия
	);

	// JavaScript
	wp_enqueue_script(
		'scripts', // идентификатор скрипта
		get_stylesheet_directory_uri() . '/dist/main.js', // URL скрипта
		array(), // без зависимостей
		time(), // версия
		true
	);
});

/**
 * Loads Other Functions
 */
if ('Loads Other Functions') {
	require_once(__DIR__ . '/includes/carbon-fileds.php');
	require_once(__DIR__ . '/includes/custom-post-type.php');
	require_once(__DIR__ . '/includes/duplicate-posts.php');
	require_once(__DIR__ . '/includes/disable-wp-search.php');
	require_once(__DIR__ . '/includes/disable-gutenberg.php');
	require_once(__DIR__ . '/includes/disable-emojis.php');
	require_once(__DIR__ . '/includes/disable-oembed.php');
	require_once(__DIR__ . '/includes/seo.php');
	//require_once(__DIR__ . '/includes/debug.php');
}

/*
* Global variables for JavaScript
*/
add_action('wp_head', function () { ?>
	<script type="text/javascript">
		var templateUrl = '<?php echo get_template_directory_uri(); ?>';
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

function get_form($input_names, $class_name, $button_text)
{
	$inputs = '';

	foreach ($input_names as $input) {
		if ($input == 'phone') $inputs .= '<input class="xl-input _req" type="text" name="phone" required="true" placeholder="Телефон *" />';
		if ($input == 'name') $inputs .= '<input class="xl-input" type="text" name="name" placeholder="Имя" />';
		if ($input == 'letter') $inputs .= '<textarea name="textarea" placeholder="Сообщение"></textarea>';
	}

	return '<form class="form-order" id="form-' . $class_name . '">
	' . $inputs . '
	<textarea name="comment"></textarea>
	<textarea name="message"></textarea>
	<button class="button-brand xl-button">' . $button_text . '</button>
  </form>';
}



/*
* Register menu areas
*/
register_nav_menus(
	array(
		'header_menu' => 'Header Menu',
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
if ('Remove trash meta tags in <head> </head>') {
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
