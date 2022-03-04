<?php get_header(); ?>

<?php get_template_part('/template-parts/archive/hero') ?>

    <div class="container-with-sidebar archive-container">
        <div class="content-with-sidebar archive-articles">
            <?php
            // проверяем есть ли посты в глобальном запросе - переменная $wp_query
            if (have_posts()) {
                // перебираем все имеющиеся посты и выводим их
                while (have_posts()) {
                    the_post();
                    get_template_part('/template-parts/archive/article');
                }
                ?>
                <div class="navigation">
                    <div class="next-posts"><?php next_posts_link(); ?></div>
                    <div class="prev-posts"><?php previous_posts_link(); ?></div>
                </div>
                <?php
            } // постов нет
            else {
                echo "<h2>Записей нет.</h2>";
            }
            ?>

        </div>

        <aside class="sidebar archive-sidebar">
            <?php get_template_part('/template-parts/archive/categories-list') ?>
        </aside>

    </div>

<?php get_footer(); ?>