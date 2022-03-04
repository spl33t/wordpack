<form class="form-mailing">
    <div class="form-items-title">Your personal info</div>
    <div class="form-items">
        <div class="form-item" input-req>
            <div class="input-text">
                <input id="example-phone" type="tel">
                <label for="example-phone">Phone number</label>
            </div>
        </div>

        <div class="form-item">
            <div class="input-text">
                <input id="example-email" type="email">
                <label for="example-email">Email</label>
            </div>
        </div>
    </div>

    <div class="form-item hide-hide-hide">
        <div class="input-text">
            <textarea id="example-message"></textarea>
            <label for="example-message">Your message</label>
        </div>
    </div>

    <div class="form-item">
        <div class="input-text">
            <textarea id="example-letter"></textarea>
            <label for="example-letter">Your message</label>
        </div>
    </div>

    <div class="form-items">
        <div class="form-item">
            <div class="input-text">
                <input id="example-car" type="text">
                <label for="example-car">You car</label>
            </div>
        </div>

        <div class="form-item">
            <div class="input-select">
                <select id="example-fruit">
                    <option disabled selected value=""></option>
                    <option value="value1">Значение 1</option>
                    <option value="value2">Значение 2</option>
                    <option value="value3">Значение 3</option>
                </select>
                <label for="example-fruit">Select</label>
            </div>
        </div>
    </div>

    <div class="form-item">
        <label class="form-item__title" for="example-your_gender">Your gender?</label>
        <div class="input-group-check__items" id="example-your_gender">
            <div class="input-check">
                <input id="example-man" type="checkbox">
                <label for="example-man">Man</label>
            </div>
            <div class="input-check">
                <input id="example-woman" type="checkbox">
                <label for="example-woman">Woman</label>
            </div>
            <div class="input-check">
                <input id="example-nonbinary" type="checkbox">
                <label for="example-nonbinary">NonBinary</label>
            </div>
        </div>
    </div>

    <div class="form-item" input-req>
        <label class="form-item__title" for="example-music_genre">What is your favorite genre of music?</label>
        <div class="input-group-check__items" id="example-music_genre">
            <div class="input-check">
                <input id="example-rap" type="radio" name="genre" value="rap">
                <label for="example-rap">Rap</label>
            </div>
            <div class="input-check">
                <input id="example-pop" type="radio" name="genre" value="pop">
                <label for="example-pop">Pop</label>
            </div>
            <div class="input-check">
                <input id="example-rock" type="radio" name="genre" value="rock">
                <label for="example-rock">Rock</label>
            </div>
            <div class="input-check">
                <input id="example-classic" type="radio" name="genre" value="classic">
                <label for="example-classic">Classic</label>
            </div>
        </div>
    </div>

    <div class="form-item" input-req>
        <div class="input-single-check">
            <input id="example-mailing_list" type="checkbox">
            <label for="example-mailing_list">Получать интересные предложения на почту</label>
        </div>
    </div>

    <input type="submit" value="Отправить">

</form>
