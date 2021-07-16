<?php get_header() ?>

<main class="page-body">
  <?php if(carbon_get_theme_option('site-logo-white') !== "") : ?>
  <img src="<?php echo carbon_get_theme_option('site-logo-white'); ?>">
  <?php else : echo 'Лого не установлено' ?>
  <?php endif ?>
  <h2>Hello World</h2>
  <p>SASS TEST</p>
  <div class="gallery">
    <div class="gallery-cell"></div>
    <div class="gallery-cell"></div>
    <div class="gallery-cell"></div>
    <div class="gallery-cell"></div>
  </div>

  <style>
    textarea[name="comment"],
    textarea[name="message"] {
      display: none;
    }
  </style>

  <form id="form-order">
    <input type="text" name="name" placeholder="Имя" />
    <input class="_req" type="text" name="phone" required="true" placeholder="Телефон *" />
    <textarea name="comment"></textarea>
    <textarea name="message"></textarea>
    <button>Отправить</button>
  </form>
</main>

<?php get_footer() ?>