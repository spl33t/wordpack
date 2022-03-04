<?php
/**
 * Temlate part name: Hero
 *
 */
?>

<section id="hero" class="hero">
    <div class="content">
        <?php getImageByUrl($_SERVER['HTTP_HOST'] . 'http://malena77.beget.tech/wp-content/themes/devWp/assets/img/wordpack-hero-demo.png', 'hero-picture'); ?>
        <div class="hero-info">
            <h1 class="hero__title">Hi, this is theme worked <br/> on WebPack</h1>
            <p class="hero__subtitle">Fast, easy and frendly for SEO</p>
            <button onclick="location.href='https://github.com/spl1t/wordpack';">
                <svg style="width: 30px; height: 30px; margin-right: 1rem; fill: #fff;">
                    <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/icons.svg#icon-github" />
                </svg>
                Get on Github
            </button>
        </div>
    </div>
</section>
