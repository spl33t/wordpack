<!DOCTYPE html>
<html lang="en">

<head>
	<title> <?php echo wp_get_document_title() ?> </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
	<?php wp_head(); ?>
</head>

<body>
	<header class="page-header content">

	<?php echo get_bloginfo() ?>

		<?php
		wp_nav_menu(array(
			'theme_location'  => 'header_menu',
			'container'       => 'nav',
			'container_class'      => 'page-header__menu',
		));
		?>

	</header>