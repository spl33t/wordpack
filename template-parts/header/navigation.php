<?php

/**
 * Site navigation.
 */
?>

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

    <?php wp_nav_menu(array(
      'theme_location' => 'main_menu',
      'container'      => false,
      'depth'          => 4,
      'menu_class'     => 'menu-items',
      'menu_id'        => 'main-menu',
      'echo'           => true,
      'fallback_cb'    => __NAMESPACE__ . '\Nav_Walker::fallback',
      'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'has_dropdown'   => true,
      'walker'         => new Nav_Walker(),
    )); ?>

  </nav><!-- #nav -->


</div>