<ul>
                <?php

                $taxonomy = 'category';

                if(is_archive()) {
                    $post_type = get_queried_object()->name;
                    if($post_type == 'service') {
                        $taxonomy = 'service_category';
                    }
                }



                if(is_tax() || is_category()) {
                    $term = get_queried_object()->taxonomy;
                    $post_type = get_taxonomy($term)->object_type;

                    if($post_type[0] == 'service') {
                        $taxonomy = 'service_category';
                    }
                }






                $args = array(
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'parent' => 0,
                    'taxonomy' => $taxonomy
                );
                $categories = get_categories($args);

                foreach ($categories as $cat) {
                    $term_link = get_term_link($cat->term_id);
                    echo "<li><a href='{$term_link}'>{$cat->name}</a></li>";
                }
                ?>
            </ul>