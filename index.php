<?php get_header() ?>

<main class="page-body">
  <div class="content">

    <?php while (have_posts()) : the_post() ?>

    <?php endwhile ?>

  </div>
</main>

<?php get_footer() ?>