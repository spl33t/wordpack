<!DOCTYPE html>
<html lang="en">

<head>
	<?php $yandex_metrika = carbon_get_theme_option('site-ya-metrika'); ?>
	<?php if ($yandex_metrika) : ?>
		<?php echo $yandex_metrika; ?>
	<?php endif; ?>

	<?php $google_analytics = carbon_get_theme_option('site-google-analytics'); ?>
	<?php if ($google_analytics) : ?>
		<?php echo $google_analytics; ?>
	<?php endif; ?>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body>
	<div class="page">
		<header class="page-header content">
			<a class="logo" href="/">
				<?php echo get_bloginfo() ?>
			</a>

			<?php
			wp_nav_menu(array(
				'theme_location'  => 'header_menu',
				'container'       => 'nav',
				'container_class'      => 'page-header__menu',
			));
			?>

		</header>