<?php


/**
 * Template for header
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php $yandex_metrika = carbon_get_theme_option('site-ya-metrika'); ?>
	<?php if ($yandex_metrika) : ?>
		<?php echo $yandex_metrika; ?>
	<?php endif; ?>

	<?php $google_analytics = carbon_get_theme_option('site-google-analytics'); ?>
	<?php if ($google_analytics) : ?>
		<?php echo $google_analytics; ?>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class('no-js'); ?>>

	<?php wp_body_open(); ?>

	<div id="page" class="site">

		<div class="header-container fixed-header">
			<header class="site-header">
				<?php get_template_part('template-parts/header/branding'); ?>
				<?php get_template_part('template-parts/header/navigation'); ?>
			</header>
		</div>

		<main class="page-body page-fixed-header">