<?php
/**
 * Temlate part name: Hero
 * 
 */
?>

<section id="hero" class="hero">
    <div class="content">
        <h1 class="hero__title">Hi, this is theme worked <br /> on WebPack</h1>
        <p class="hero__subtitle">Fast, easy and frendly for SEO</p>
        <?php echo get_form(['name', 'phone'], 'hero', 'Отправить');  ?>
    </div>
</section>
