<?php
$condition_type = $args['condition_type'];
?>

<div id="modal-order" class="modal <?php echo $condition_type ?>">
    <div class="modal-inner">
        <div class="modal__body">
            <div class="modal__close">x</div>
            <h6 class="modal__title">Заказ</h6>
            <?php get_template_part('/template-parts/forms/order') ?>
        </div>
    </div>
</div>