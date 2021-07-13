<?php


/**
 * Loads <list assets here>.
 */
add_action( 'wp_enqueue_scripts', 'true_enqueue_js_and_css' );
 
function true_enqueue_js_and_css() {
 
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
 
}


/*
* Поддержка некоторых опций в теме (add_theme_support)
*/
add_action( 'after_setup_theme', function(){
	add_theme_support( 'post-thumbnails' );
} );

/*
* Регистрация области меню
*/
register_nav_menus(
	array(
		'header_menu' => 'Header Menu',
	));


/*
* Мета теги в HEAD
*/
function theme_xyz_header_metadata() {

    // Post object if needed
    // global $post;

    // Page conditional if needed
    // if( is_page() ){}
/*
	?>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
		(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
			m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
		(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

		ym(81216991, "init", {
			clickmap:true,
			trackLinks:true,
			accurateTrackBounce:true,
			webvisor:true
		});
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/81216991" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->

	<!-- /Yandex.WebMaster -->
	<meta name="yandex-verification" content="9e869054031f478d" />
	<!-- /Yandex.WebMaster -->
	<?php
*/
}
add_action( 'wp_head', 'theme_xyz_header_metadata' );

