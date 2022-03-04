<?php
/*
Template Name: demo
*/
?>

<?php get_header() ?>

    <style>
        .demo .content > * {
            margin-bottom: 20px;
        }

        .demo .content > table {
            width: 100%;
            max-width: 400px;
        }

        .demo .content > form {
            max-width: 600px;
        }

        .demo .content > button {
            margin-right: 20px;
        }
    </style>


<?php get_template_part('/template-parts/hero') ?>

    <section class="demo">
        <div class="content">
            <h1>This is a heading (H1)</h1>
            <h2>This is a heading (H2)</h2>
            <h3>This is a heading (H3)</h3>
            <h4>This is a heading (H4)</h4>
            <h5>This is a heading (H5)</h5>
            <h6>This is a heading (H6)</h6>

            <h3 class="title-section">Paragraph</h3>
            <p>This is a <b>regular</b> paragraph block. Professionally productize highly efficient results with
                world-class core competencies. Objectively matrix leveraged architectures vis-a-vis error-free
                applications. Completely maximize customized portals via fully researched metrics. Enthusiastically
                generate premier action items through web-enabled e-markets. Efficiently parallel task holistic
                intellectual capital and client-centric markets.</p>

            <h3 class="title-section">Buttons and Popup</h3>
            <button class="button-black" data-modal="example">Попап с сообщением</button>
            <button class="button-white" data-modal="order">Попап с формой</button>
            <button onclick="location.href='https://google.com';">Кнопка с ссылкой</button>
            <button class="button-white" onclick="location.href='https://www.instagram.com/spl33t/';">
                <svg>
                    <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/icons.svg#icon-instagram" />
                </svg>
                Кнопка с иконкой
            </button>

            <h3 class="title-section">WEBP image</h3>
            <?php getImageByID(21, 'hero-picture'); ?>

            <h3 class="title-section">Table</h3>
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Antero</td>
                    <td>34</td>
                </tr>
                <tr>
                    <td>Jorma</td>
                    <td>23</td>
                </tr>
                <tr>
                    <td>Mikko</td>
                    <td>19</td>
                </tr>
                <tr>
                    <td>Päivi</td>
                    <td>25</td>
                </tr>
                <tr>
                    <td>Leila</td>
                    <td>27</td>
                </tr>
                <tr>
                    <td>Tomi</td>
                    <td>27</td>
                </tr>
                </tbody>
            </table>

            <h3 class="title-section">UL List</h3>
            <ul>
                <li>This is ul list item</li>
                <li>This is a long ul list item. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam iaculis
                    fringilla purus, sed feugiat mauris tincidunt ut. Vestibulum ante ipsum primis in faucibus orci
                    luctus et ultrices posuere cubilia curae; Morbi mauris risus, auctor vel congue et, euismod non
                    mauris.
                </li>
                <li>This is even longer list item with links in it.
                    <a href="https://www.google.com" aria-label="External link: External site">External link</a> lorem
                    ipsum dolor sit amet, consectetur adipiscing elit. Etiam iaculis fringilla purus, sed feugiat mauris
                    tincidunt ut. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                    curae; Morbi mauris risus, <a href="<?php echo get_home_url(); ?>">internal link</a> vel congue et,
                    euismod non mauris.
                </li>
            </ul>

            <h3 class="title-section">OL List</h3>
            <ol>
                <li>This is ol list item</li>
                <li>This is ol list item</li>
                <li>This is ol list item</li>
            </ol>

            <h3 class="title-section">Form</h3>
            <?php get_template_part('/template-parts/forms/example') ?>

        </div>
    </section>

<?php get_footer() ?>