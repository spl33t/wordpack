<?php

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