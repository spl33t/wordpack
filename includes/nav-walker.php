<?php

// свой класс построения меню:
class Nav_Walker extends \Walker_Nav_Menu
{
    /*
	 * Позволяет перезаписать <ul class="sub-menu">
	 */
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        // Indent
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);

        // Default class to add to the file.
        $classes = array('sub-menu');

        /**
         * Filters the CSS class(es) applied to a menu list element.
         *
         * @since WP 4.8.0
         *
         * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        if (isset($args->has_dropdown) && $args->has_dropdown) {
            // Get the icon
            ob_start();
            echo get_template_directory_uri() . '/dist/icons.svg#icon-arrow_drop_down"';
            $icon = ob_get_clean();
            $output .= '<div class="dropdown-toggle" aria-expanded="false" aria-label="Open child menu">';
            $output .=  '<svg> <use xlink:href="' . $icon . '" /> </svg></div>';

            /*
                 * The `.dropdown-menu` container needs to have a labelledby
                 * attribute which points to it's trigger link.
                 *
                 * Form a string for the labelledby attribute from the the latest
                 * link with an id that was added to the $output.
                 */
            $labelledby = '';
            // Find all links with an id in the output.
            preg_match_all('/(<a.*?id=\"|\')(.*?)\"|\'.*?>/im', $output, $matches);
            // With pointer at end of array check if we got an ID match.

            if (end($matches[2])) {
                // Build a string to use as aria-labelledby.
                $labelledby = 'aria-labelledby="' . esc_attr(end($matches[2])) . '"';
            }
            $output .= "{$n}{$indent}<ul$class_names $labelledby>{$n}";
        } else {
            $output .= "\n{$n}{$indent}<ul>{$n}";
        }
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output
     * @param object $item Объект элемента меню, подробнее ниже.
     * @param int $depth Уровень вложенности элемента меню.
     * @param object $args Параметры функции wp_nav_menu
     */
    function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0)
    {
        // для WordPress 5.3+
        // function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {
        global $wp_query;
        /*
             * Некоторые из параметров объекта $item
             * ID - ID самого элемента меню, а не объекта на который он ссылается
             * menu_item_parent - ID родительского элемента меню
             * classes - массив классов элемента меню
             * post_date - дата добавления
             * post_modified - дата последнего изменения
             * post_author - ID пользователя, добавившего этот элемент меню
             * title - заголовок элемента меню
             * url - ссылка
             * attr_title - HTML-атрибут title ссылки
             * xfn - атрибут rel
             * target - атрибут target
             * current - равен 1, если является текущим элементом
             * current_item_ancestor - равен 1, если текущим (открытым на сайте) является вложенный элемент данного
             * current_item_parent - равен 1, если текущим (открытым на сайте) является родительский элемент данного
             * menu_order - порядок в меню
             * object_id - ID объекта меню
             * type - тип объекта меню (таксономия, пост, произвольно)
             * object - какая это таксономия / какой тип поста (page /category / post_tag и т д)
             * type_label - название данного типа с локализацией (Рубрика, Страница)
             * post_parent - ID родительского поста / категории
             * post_title - заголовок, который был у поста, когда он был добавлен в меню
             * post_name - ярлык, который был у поста при его добавлении в меню
             */
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        /*
             * Генерируем строку с CSS-классами элемента меню
             */
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // функция join превращает массив в строку
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        /*
             * Генерируем ID элемента
             */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

        /*
             * Генерируем элемент меню
             */
        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        // атрибуты элемента, title="", rel="", target="" и href=""
        $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';

        // ссылка и околоссылочный текст
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
