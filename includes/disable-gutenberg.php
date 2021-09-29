<?php

/*
* Disable Styles Gutenberg
*/
add_action('wp_enqueue_scripts', 'dm_remove_wp_block_library_css');
function dm_remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
}
## Disable Gutenberg (новый редактор блоков в WordPress).
## ver: 1.2
if ('disable_gutenberg') {
	remove_theme_support('core-block-patterns'); // WP 5.5

	add_filter('use_block_editor_for_post_type', '__return_false', 100);

	// отключим подключение базовых css стилей для блоков
	// ВАЖНО! когда выйдут виджеты на блоках или что-то еще, эту строку нужно будет комментировать
	remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');

	// Move the Privacy Policy help notice back under the title field.
	add_action('admin_init', function () {
		remove_action('admin_notices', ['WP_Privacy_Policy_Content', 'notice']);
		add_action('edit_form_after_title', ['WP_Privacy_Policy_Content', 'notice']);
	});
}