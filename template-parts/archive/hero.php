<div class="archive-hero">
    <div class="archive-hero-container">
        <?php

        $count = $GLOBALS['wp_query']->found_posts;
        // Title
        if (is_home()) {
            echo '<h1 class="archive-title">Архив новостей <span>' . $count . '</span></h1> ';
        }
        if (is_archive()) {
            $archiveTitle = post_type_archive_title('', false);
            if ($archiveTitle == '') {
                $archiveTitle = get_queried_object()->name;
            }

            echo '<h1 class="archive-title">' . $archiveTitle . '<span>' . $count . '</span></h1> ';
        }

        // Description
        if (is_tax() || is_category()) {
            echo term_description();
        }

        ?>

    </div>
</div>