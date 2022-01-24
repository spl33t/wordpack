<?php

// Remove default WP robots
remove_filter('wp_robots', 'wp_robots_max_image_preview_large');

// Title, Desc, Keys
add_action('wp_head', function () {
    $title_separator = carbon_get_theme_option('title_separator');
    $global_title = carbon_get_theme_option('global_title');
    $global_description = carbon_get_theme_option('global_description');


    global $page, $paged, $post;
    $default_keywords = 'call center, колл центр';

    //Title
    $nameblog = get_bloginfo('name', 'display');
    $title = trim(get_the_title()) . $title_separator . $nameblog;
    $custom_title = carbon_get_post_meta(get_the_ID(), 'seo-title');
    $url = ltrim(esc_url($_SERVER['REQUEST_URI']), '/');
    $archive = post_type_archive_title('', false);;
    $cat = single_cat_title('', false);
    $tag = single_tag_title('', false);
    $search = get_search_query();

    if (!empty($custom_title)) $title = $custom_title;
    if ($paged >= 2 || $page >= 2) $page_number = $title_separator . sprintf('Page %s', max($paged, $page));
    else $page_number = '';

    if (is_home() || is_front_page()) $seo_title = $nameblog . $title_separator . $title;
    elseif (is_singular()) $seo_title = $title;
    elseif (is_tag()) $seo_title = 'Тег: ' . $tag . $title_separator . $nameblog;
    elseif (is_category()) $seo_title = 'Категория: ' . $cat . $title_separator . $nameblog;
    elseif (is_archive()) $seo_title = 'Архив: ' . $archive . $title_separator . $nameblog;
    elseif (is_search()) $seo_title = 'Поиск: ' . $search . $title_separator . $nameblog;
    elseif (is_404()) $seo_title = '404 - Not Found: ' . $url . $title_separator . $nameblog;
    else                              $seo_title = $nameblog . $title_separator . $title;

    echo '<title>' . esc_attr(do_shortcode($seo_title) . $page_number) . '</title>' . "\n";
    // End title

    // Description
    $custom_description = carbon_get_post_meta(get_the_ID(), 'seo-description');  // Individual custom description
    $description = get_bloginfo('description', 'display'); // Default Description
    $description_article = strip_tags($post->post_content);
    $description_article = strip_shortcodes($post->post_content);
    $description_article = str_replace(array("\n", "\r", "\t"), ' ', $description_article);
    $description_article = mb_substr($description_article, 0, 155);
    $description_article = rtrim($description_article, "!,.-");
    $description_article = substr($description_article, 0, strrpos($description_article, ' ')) . '...';


    if (!empty($custom_description)) $description = $custom_description;
    elseif (is_singular('post')) $description = $description_article;

    echo '<meta name="description" content="' . esc_attr(do_shortcode($description)) . '">' . "\n";

    // Keywords
    $keys = carbon_get_post_meta(get_the_ID(), 'seo-keywords');
    $cats = get_the_category();
    $tags = get_the_tags();
    if (empty($keys)) {
        if (!empty($cats)) foreach ($cats as $cat) $keys .= $cat->name . ', ';
        if (!empty($tags)) foreach ($tags as $tag) $keys .= $tag->name . ', ';
        $keys .= $default_keywords;
    }
    echo '<meta name="keywords" content="' . esc_attr(do_shortcode($keys)) . '">' . "\n";

    //Open Graph
    //og:type
    if (is_singular('post')) {
        echo '<meta property="og:type" content="article">' . "\n";
    } else {
        echo '<meta property="og:type" content="website">' . "\n";
    }
    // og:title
    echo '<meta property="og:title" content="' . esc_attr(do_shortcode($seo_title) . $page_number) . '">' . "\n";
    // og:desc
    echo '<meta property="og:description" content="' . esc_attr(do_shortcode($description)) . '">' . "\n";
    // og:url
    echo '<meta property="og:url" content="' . get_permalink() . '">';
    // og:sitename
    echo '<meta property="og:site_name" content="' . get_bloginfo('name', 'display') . '">' . "\n";
    // og:image
    if (get_the_post_thumbnail_url()) echo '<meta property="og:image" content="' . get_the_post_thumbnail_url() . '">' . "\n";
}, -1000);


//Exclude author pages in XML Sitemap
add_filter('wp_sitemaps_add_provider', 'remove_author_category_pages_from_sitemap', 10, 2);
function remove_author_category_pages_from_sitemap($provider, $name) {
    if ('users' === $name) {
        return false;
    }
    return $provider;
}

// Redirect from authors page to home page
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

// Blog prefix for post
add_action('generate_rewrite_rules', 'add_rewrite_rules');
function add_rewrite_rules($wp_rewrite) {
    $new_rules = array(
        'blog/(.+?)/?$' => 'index.php?post_type=post&name=' . $wp_rewrite->preg_index(1),
    );

    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

add_filter('post_link', 'change_blog_links', 1, 3);
function change_blog_links($post_link, $id = 0) {
    $post = get_post($id);
    if (is_object($post) && $post->post_type == 'post') {
        return home_url('/blog/' . $post->post_name . '/');
    }
    return $post_link;
}


