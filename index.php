<?php get_header() ?>

<main class="page-body">
  <div class="content">


    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <a href="<?php echo get_post_permalink(); ?>">
          <h2><?php the_title(); ?></h2>
        </a>
        <article>
          <?php the_content(); ?>
        </article>
        <br />
      <?php endwhile; ?>
    <?php endif; ?>


  </div>
</main>

<?php get_footer() ?>