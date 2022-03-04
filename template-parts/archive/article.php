<article class="post-item" id="post-<?php the_ID(); ?>">
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php
    // Picture
    if (has_post_thumbnail()) {
        the_post_thumbnail();
    }
    //Content
    the_excerpt();
    ?>
    <div class="meta">
        <time><?php the_time('d F Y') ?></time>
        &nbsp; / &nbsp;
        <?php the_category(', '); ?>
    </div>
</article>