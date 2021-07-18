<!DOCTYPE html>
<html lang="en">

<head>
	<?php if (is_404()) : ?>
		<title><?php echo 'Cтраница не найдена';
				echo ' - ';
				echo get_bloginfo(); ?></title>
	<?php else : ?>
		<?php $custom_title = carbon_get_post_meta(get_the_ID(), 'seo-title'); ?>
		<?php if ($custom_title) : ?>
			<title><?php echo $custom_title;
					echo ' - ';
					echo get_bloginfo(); ?></title>
		<?php else : ?>
			<title><?php
					echo get_the_title();
					echo ' - ';
					echo get_bloginfo(); ?></title>
		<?php endif; ?>
	<?php endif ?>
	<?php $meta_description = carbon_get_post_meta(get_the_ID(), 'seo-description'); ?>
	<?php if ($meta_description) : ?>
		<meta name="description" content="<?php echo $meta_description ?>">
	<?php endif; ?>

	<?php $meta_keywords = carbon_get_post_meta(get_the_ID(), 'seo-keywords'); ?>
	<?php if ($meta_keywords) : ?>
		<meta name="keywords" content="<?php echo $meta_keywords ?>">
	<?php endif; ?>

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
			<a href="/">
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