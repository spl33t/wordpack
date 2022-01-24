<?php

add_action('wp', 'action_function_name_11');
function action_function_name_11() {
    $currentID = get_the_ID();
    //var_dump(get_the_term_list($currentID));

    $args = array(
        'post_type' => 'popup',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $assoc_pages = carbon_get_the_post_meta('assoc_page');
            $call_pages = carbon_get_the_post_meta('popup_call_pages');
            $popup_title = carbon_get_the_post_meta('popup_title');
            $popup_content = carbon_get_the_post_meta('popup_content');

            if ($call_pages == 'all') {
                echo $popup_title, $popup_content;
            } elseif ($call_pages == 'include') {
                // Перебор асоциированных страниц
                var_dump($assoc_pages);
                foreach ($assoc_pages as $assoc_page) {
                    if ($assoc_page['id'] == $currentID) {
                        echo $assoc_page['id'];
                    }
                }
            } elseif ($call_pages == 'exclude') {
                // Перебор асоциированных страниц
                foreach ($assoc_pages as $assoc_page) {
                    if ($assoc_page['id'] != $currentID) {
                        echo $popup_title, $popup_content;
                    }
                }
            }

        }
    } else {
        // Постов не найдено
    }
    // Возвращаем оригинальные данные поста. Сбрасываем $post.
    wp_reset_postdata();
}


function get_popup_by_id($popupID) {
    $popup_title = carbon_get_post_meta($popupID, 'popup_call_type_select');
    $popup_content = carbon_get_post_meta($popupID, 'popup_call_type_select');

    $popup_call_type = carbon_get_post_meta($popupID, 'popup_call_type_select');
    if ($popup_call_type == 'button') {
        echo '<button class="popup_button popup_button_id-' . $popupID . '">Оставить </button>';
    } elseif ($popup_call_type == 'entry') {
        $association = carbon_get_post_meta($popupID, 'crb_association');

        var_dump($association);
    }

}

function get_modal_by_id($postID) {
    $title = carbon_get_post_meta($postID, 'test');
    $form_result = '';
    ?>

    <script type="text/javascript">
        let title = '<?php echo $title; ?>';
        const pageContent = document.querySelector('.page-content')
        let data = new Object()

        // Create Popup Element
        const popup = document.createElement('div');
        popup.className = "popup";
        popup.addEventListener('click', (e) => {
            let target = e.target.className
            if (target == 'popup-inner' || target == 'popup' || target == 'popup__close') {
                removePopup()
            }
        })

        // Remove Popup
        function removePopup() {
            popup.remove()
            data = {}
            document.body.style.overflow = 'auto'
        }

        function createPopup(data) {

            let template = `
                            <div class="popup-inner">
                                <div class="popup__body">
                                    <div class="popup__close">x</div>
                                    <h6 class="popup__title">${title}</h6>
                                    <p class="popup__text">sas</p>
                                </div>
                            </div>
                           `


            popup.innerHTML = template
            pageContent.appendChild(popup)
            document.body.style.overflow = 'hidden'
        }

        createPopup(data);

    </script>;

    <?php

    return $title;
}