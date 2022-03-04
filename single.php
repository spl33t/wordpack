<?php get_header();
the_post() ?>

    <div class="container-with-sidebar single-container">
        <div class="content-with-sidebar single-content">
            <article>
                <header>
                    <h1 class="single-post__title"> <?php the_title() ?> </h1>
                    <div class="meta">
                        <time><?php the_time('d F Y') ?></time>
                        &nbsp; / &nbsp;
                        <?php the_category(', ') ?>
                    </div>
                </header>
                <br/>
                <?php the_content() ?>
            </article>


            <?php if (comments_open() || get_comments_number()) :
                comments_template();
            endif; ?>


        </div>

        <aside class="sidebar single-sidebar">
            <ul class="article-headings"></ul>
        </aside>
    </div>


<?php get_footer() ?>