<?php get_header() ?>

<main class="page-body">

  <div class="content">
    <h2>Hello World</h2>
    <p>SASS TEST</p>


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
  </div>
</main>

<?php get_footer() ?>