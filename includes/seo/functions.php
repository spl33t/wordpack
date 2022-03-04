<?php

// Remove default WP robots
remove_filter('wp_robots', 'wp_robots_max_image_preview_large');

// Title, Desc, Keys
function seo_tags() {
    global $page, $paged, $post;

    //Global variables
    $title_separator = carbon_get_theme_option('title_separator');
    $siteName = carbon_get_theme_option('site_name');

    // Pages
    if ($paged >= 2 || $page >= 2) {
        $page_number = ' | ' . sprintf('Страница %s', max($paged, $page));
    } else {
        $page_number = '';
    }

    // Title tag
    $pageTitle = trim(get_the_title());
    $singlePageTitle = carbon_get_post_meta(get_the_ID(), 'seo-title');
    if (!empty($singlePageTitle)) {
        $pageTitle = $singlePageTitle;
    }

    if (is_front_page()) {
        $title = $siteName . $title_separator . $pageTitle;
    } elseif (is_singular()) {
        $title = $pageTitle . $title_separator . $siteName;
    } elseif (is_tag()) {
        $tagTitle = single_tag_title('', false);
        $title = $tagTitle . $title_separator . $siteName;
    } elseif (is_category()) {
        $categoryTitle = single_cat_title('', false);
        $title = $categoryTitle . $title_separator . $siteName;
    } elseif (is_archive()) {
        $archiveTitle = post_type_archive_title('', false);
        if ($archiveTitle == '') {
            $archiveTitle = get_queried_object()->name;
        }
        $title = $archiveTitle . $title_separator . $siteName;
    } elseif (is_home()) {
        $title = 'Блог' . $title_separator . $siteName;
    } elseif (is_search()) {
        $searchWord = get_search_query();
        if ($searchWord == '') $searchWord = 'Поиск';
        $title = $searchWord . $title_separator . $siteName;
    } elseif (is_404()) {
        $title = '404 Старница не найдена' . $title_separator . $siteName;
    } else {
        $title = $pageTitle . $title_separator . $siteName;
    }

    echo '<title>' . esc_attr(do_shortcode($title) . $page_number) . '</title>' . "\n";

    // Description tag
    $siteDescription = carbon_get_theme_option('site_description');
    $singlePageDescription = carbon_get_post_meta(get_the_ID(), 'seo-description');
    if (!empty($singlePageDescription)) {
        $siteDescription = $singlePageDescription;
    } elseif (is_singular('post')) {
        $description_article = strip_shortcodes($post->post_content);
        $description_article = str_replace(array("\n", "\r", "\t"), ' ', $description_article);
        $description_article = mb_substr($description_article, 0, 155);
        $description_article = rtrim($description_article, "!,.-");
        $description_article = substr($description_article, 0, strrpos($description_article, ' ')) . '...';
        $description_article = wp_strip_all_tags($description_article);

        $siteDescription = $description_article;
    }

    echo '<meta name="description" content="' . esc_attr(do_shortcode($siteDescription)) . '">' . "\n";

    // Keywords tag
    $default_keywords = carbon_get_theme_option('site_keywords');
    $keywords = carbon_get_post_meta(get_the_ID(), 'seo-keywords');
    $keywordsCats = get_the_category();
    $keywordsTags = get_the_tags();
    if (empty($keywords)) {
        if (!empty($keywordsCats)) foreach ($keywordsCats as $cat) $keywords .= $cat->name . ', ';
        if (!empty($keywordsTags)) foreach ($keywordsTags as $tag) $keywords .= $tag->name . ', ';
        $keywords .= $default_keywords;
    }
    echo '<meta name="keywords" content="' . esc_attr(do_shortcode($keywords)) . '">' . "\n";

    //Open Graph tags
    //og:type
    if (is_singular('post')) {
        echo '<meta property="og:type" content="article">' . "\n";
    } else {
        echo '<meta property="og:type" content="website">' . "\n";
    }
    echo '<meta property="og:title" content="' . esc_attr(do_shortcode($title) . $page_number) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr(do_shortcode($siteDescription)) . '">' . "\n";
    echo '<meta property="og:url" content="' . get_permalink() . '">' . "\n";
    echo '<meta property="og:site_name" content="' . $siteName . '">' . "\n";
    if (get_the_post_thumbnail_url()) echo '<meta property="og:image" content="' . get_the_post_thumbnail_url() . '">' . "\n";
}

add_action('seo_tags_hook', 'seo_tags');


//Exclude author pages in XML Sitemap
add_filter('wp_sitemaps_add_provider', 'remove_author_category_pages_from_sitemap', 10, 2);
function remove_author_category_pages_from_sitemap($provider, $name) {
    if ('users' === $name) {
        return false;
    }
    return $provider;
}

// Redirect from author page to home
add_action('template_redirect', 'my_custom_disable_author_page');
function my_custom_disable_author_page() {
    global $wp_query;

    if (is_author()) {
        // Redirect to homepage, set status to 301 permenant redirect.
        // Function defaults to 302 temporary redirect.
        wp_redirect(get_option('home'), 301);
        exit;
    }
}


//Blog Prefix
if(get_option( 'permalink_structure' ) != '/blog/%postname%/') {

    global $wp_rewrite;
//Write the rule
    $wp_rewrite->set_permalink_structure('/blog/%postname%/');
//Set the option
    update_option( "rewrite_rules", FALSE );
//Flush the rules and tell it to write htaccess
    $wp_rewrite->flush_rules( true );
}

// Display cond modal ***REFACTOR****
function seo_tags_hook() {
    do_action('seo_tags_hook');
}


