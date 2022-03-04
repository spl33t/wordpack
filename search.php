<?php get_header(); ?>

<?php get_template_part('/template-parts/archive/hero-search'); ?>

<?php if (get_search_query() == '') : // Пустой запрос

else : ?>
    <div class="container-with-sidebar archive-container">
        <div class="content-with-sidebar archive-articles">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    get_template_part('/template-parts/archive/article');
                endwhile;
            else :
                echo "<h2>Записей нет.</h2>";
            endif;
            ?>
            <div class="navigation">
                <div class="next-posts"><?php next_posts_link(); ?></div>
                <div class="prev-posts"><?php previous_posts_link(); ?></div>
            </div>
        </div>

        <aside class="sidebar archive-sidebar">
            <?php get_template_part('/template-parts/archive/categories-list') ?>
        </aside>
    </div>
<?php endif; ?>


<?php get_footer(); ?>