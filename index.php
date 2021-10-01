<?php get_header() ?>

<main class="page-body">
  <div class="content">

    <h2>Hello World</h2>

    <?php echo get_form(['name', 'phone'], 'hero', 'Бич'); ?>

    <button class="popup-message button-black xl-button" data-title="Заголовок попапчика" data-text="Какой то текст">Попап с сообщением</button>

    <button class="popup-form button-white xl-button" data-title="Заголовок попапчика" data-text="Какой то текст" data-form="">Попап с формой</button>

    <img class="popup-media lazy-img" data-src="http://wp-webpack/wp-content/uploads/2021/09/1.webp" alt="">

  </div>
</main>

<?php get_footer() ?>