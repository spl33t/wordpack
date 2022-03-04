<?php
/**
 * Template for header
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php seo_tags_hook(); ?>
    <?php $scripts = carbon_get_theme_option('site-head-include'); ?>
    <?php if ($scripts) : ?>
        <?php foreach ($scripts as $script) : ?>
            <?php echo $script['tag']; ?>
        <?php endforeach; ?>
    <?php endif ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class('no-js'); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">

    <header class="page-header sticky-header">
        <div class="page-header-inner">

            <!-- Brandig Start -->
            <a class="site-branding" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <svg class="site-logo">
                    <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/icons.svg#icon-instagram"/>
                </svg>
                <div class="site-title-wrapper">
                    <p class="site-title"> <?php echo carbon_get_theme_option('site_name'); ?> </p>
                    <p class="site-subtitle"> <?php echo carbon_get_theme_option('site_description'); ?> </p>
                </div>
            </a>
            <!-- Brandig End -->

            <!-- Nav Start -->
            <div class="main-navigation-wrapper" id="main-navigation-wrapper">

                <button class="burger-menu" type="button" aria-label="Открыть главное меню навигации по сайту">
						<span class="burger-menu-icon">
							<span class="burger-menu-icon-top"></span>
							<span class="burger-menu-icon-middle"></span>
							<span class="burger-menu-icon-bottom"></span>
						</span>
                    <span class="burger-menu-label">Открыть меню</span>
                </button>

                <nav class="nav-main" aria-label="Главная навигация">
                    <?php $mainMenu = wp_nav_menu(array(
                        'theme_location' => 'header_menu',
                        'container' => false,
                        'depth' => 4,
                        'menu_class' => 'menu-items',
                        'menu_id' => 'main-menu',
                        'echo' => false,
                        'fallback_cb' => __NAMESPACE__ . '\Nav_Walker::fallback',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'has_dropdown' => true,
                        'walker' => new Nav_Walker(),
                    ));

                    if (!empty($mainMenu)) {
                        echo $mainMenu;
                    } elseif (empty($mainMenu) && current_user_can('editor') || current_user_can('administrator')) {
                        echo '<a href="/wp-admin/nav-menus.php?action=edit&menu=0">Добавить меню</a>';
                    } else {
                        echo '<p>Меню недоступно</p>';
                    }
                    ?>
                </nav>

            </div>
            <!-- Nav End -->

        </div>
    </header>

    <main class="page-content">