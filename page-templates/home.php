<?php
/*
Template Name: Front Page
*/
?>

<?php get_header() ?>

<?php
//echo get_form_by_id(18); // refactor
echo get_popup_by_id(45); // refactor
?>


<?php get_template_part('/template-parts/hero') ?>

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
            <button class="popup-message button-black" data-title="Заголовок попапчика"
                    data-text="<p>This is a <b>regular</b> paragraph block. Professionally productize highly efficient results with world-class core competencies. Objectively matrix leveraged architectures vis-a-vis error-free applications. Completely maximize customized portals via fully researched metrics. Enthusiastically generate premier action items through web-enabled e-markets. Efficiently parallel task holistic intellectual capital and client-centric markets.</p>">
                Попап с сообщением
            </button>
            <button class="popup-form button-white" data-title="Заголовок попапчика" data-text="Какой то текст"
                    data-form="">Попап с формой
            </button>
            <button onclick="location.href='https://google.com';">Кнопка с ссылкой</button>

            <h3 class="title-section">WEBP image and Popup</h3>
            <img class="popup-media lazy-img" data-src="http://wp-webpack/wp-content/uploads/2021/09/1.webp" alt="">


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
                <li>This is even longer list item with links in it. <a href="https://www.google.com"
                                                                       aria-label="External link: External site"
                                                                       class="is-external-link">External link</a> lorem
                    ipsum dolor sit amet, consectetur adipiscing elit. Etiam iaculis fringilla purus, sed feugiat mauris
                    tincidunt ut. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                    curae; Morbi mauris risus, <a href="https://airwptheme.com/demo">internal link</a> vel congue et,
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
            <form class="form-order">
                <div class="input-field">
                    <input id="nickname" name="nickname" type="text">
                    <label for="nickname">Nickname</label>
                </div>

                <br/>

                <div class="input-field">
                    <input id="email" name="email" type="email">
                    <label for="email">Email</label>
                </div>

                <br/>

                <div class="input-field">
                    <textarea id="bio" name="bio"> </textarea>
                    <label for="bio">Your Bio</label>
                </div>

                <br/>


                <div class="input-field">
                    <select>
                        <option disabled selected value=""></option>
                        <option value="value1">Значение 1</option>
                        <option value="value2">Значение 2</option>
                        <option value="value3">Значение 3</option>
                    </select>
                    <label for="select">Select</label>
                </div>

                <br/>

                <div class="input-group">
                    <div class="input-group__title">Your gender?</div>
                    <div class="input-group__inner">
                        <div class="input-field-checkbox">
                            <input type="checkbox" id="man" name="man" checked>
                            <label for="man">Man</label>
                        </div>
                        <div class="input-field-checkbox">
                            <input type="checkbox" id="woman" name="woman">
                            <label for="woman">Woman</label>
                        </div>
                        <div class="input-field-checkbox">
                            <input type="checkbox" id="nonbinary" name="nonbinary">
                            <label for="nonbinary">NonBinary</label>
                        </div>
                    </div>
                </div>

                <br/>

                <div class="input-group">
                    <div class="input-group__title">What is your favorite genre of music?</div>
                    <div class="input-group__inner">
                        <div class="input-field-radio">
                            <input type="radio" id="rap" name="genre" value="rap" checked>
                            <label for="rap">Rap</label>
                        </div>
                        <div class="input-field-radio">
                            <input type="radio" id="pop" name="genre" value="pop">
                            <label for="pop">Pop</label>
                        </div>
                        <div class="input-field-radio">
                            <input type="radio" id="rock" name="genre" value="rock">
                            <label for="rock">Rock</label>
                        </div>
                        <div class="input-field-radio">
                            <input type="radio" id="classic" name="genre" value="classic">
                            <label for="classic">Classic</label>
                        </div>
                    </div>
                </div>

                <br/>

                <input type="submit" value="Отправить">


            </form>
        </div>
    </section>

<?php get_footer() ?>