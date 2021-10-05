<?php
/*
* SEO
*/

// Remove default WP robots
remove_filter('wp_robots', 'wp_robots_max_image_preview_large');

// Title, Desc, Keys
add_action('wp_head', function () {
    global $page, $paged, $post;
    $default_keywords = 'wordpress, services'; // customize

    //Title
    $custom_title = carbon_get_post_meta(get_the_ID(), 'seo-title');
    $url = ltrim(esc_url($_SERVER['REQUEST_URI']), '/');
    $nameblog = get_bloginfo('name', 'display');
    $title = trim(get_the_title());
    $archive = post_type_archive_title('', false);;
    $cat = single_cat_title('', false);
    $tag = single_tag_title('', false);
    $search = get_search_query();

    if (!empty($custom_title)) $title = $custom_title;
    if ($paged >= 2 || $page >= 2) $page_number = ' | ' . sprintf('Page %s', max($paged, $page));
    else $page_number = '';

    if (is_home() || is_front_page()) $seo_title = $nameblog . ' | ' . $title;
    elseif (is_singular())            $seo_title = $title . ' | ' . $nameblog;
    elseif (is_tag())                 $seo_title = 'Тег: ' . $tag . ' | ' . $nameblog;
    elseif (is_category())            $seo_title = 'Категория: ' . $cat . ' | ' . $nameblog;
    elseif (is_archive())             $seo_title = 'Архив: ' . $archive . ' | ' . $nameblog;
    elseif (is_search())              $seo_title = 'Поиск: ' . $search . ' | ' . $nameblog;
    elseif (is_404())                 $seo_title = '404 - Not Found: ' . $url . ' | ' . $nameblog;
    else                              $seo_title = $nameblog . ' | ' . $title;

    echo  '<title>' . esc_attr($seo_title . $page_number) . '</title>';


    // Description
    $custom_description = carbon_get_post_meta(get_the_ID(), 'seo-description');
    $description = get_bloginfo('description', 'display');

    if (!empty($custom_description)) $description = $custom_description;

    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";


    // Keywords
    $keys = carbon_get_post_meta(get_the_ID(), 'seo-keywords');
    $cats = get_the_category();
    $tags = get_the_tags();
    if (empty($keys)) {
        if (!empty($cats)) foreach ($cats as $cat) $keys .= $cat->name . ', ';
        if (!empty($tags)) foreach ($tags as $tag) $keys .= $tag->name . ', ';
        $keys .= $default_keywords;
    }
    echo '<meta name="keywords" content="' . esc_attr($keys) . '">';

    //Open Graph
    //og:type
    if (is_singular('post')) {
        echo '<meta property="og:type" content="article">';
    } else {
        echo '<meta property="og:type" content="website">';
    }
    // og:title
    echo '<meta property="og:title" content="' .  esc_attr($seo_title . $page_number)  . '">';
    // og:desc
    echo '<meta property="og:description" content="' . esc_attr($description) . '">';
    // og:url
    echo '<meta property="og:url" content="' . get_permalink() . '">';
    // og:sitename
    echo '<meta property="og:site_name" content="' . get_bloginfo('name', 'display') . '">';
    // og:image
    if (get_the_post_thumbnail_url()) echo '<meta property="og:image" content="' . get_the_post_thumbnail_url()  . '">';
}, -1000);



//Exclude author pages in XML Sitemap 
add_filter('wp_sitemaps_add_provider', 'remove_author_category_pages_from_sitemap', 10, 2);
function remove_author_category_pages_from_sitemap($provider, $name)
{
    if ('users' === $name) {
        return false;
    }
    return $provider;
}

// Redirect from authors page to home page
add_action('template_redirect', 'my_custom_disable_author_page');
function my_custom_disable_author_page()
{
    global $wp_query;

    if (is_author()) {
        // Redirect to homepage, set status to 301 permenant redirect. 
        // Function defaults to 302 temporary redirect. 
        wp_redirect(get_option('home'), 301);
        exit;
    }
}
