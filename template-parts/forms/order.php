<form class="form-mailing">
    <div class="form-item" input-req>
        <div class="input-text">
            <input id="order-phone" type="tel">
            <label for="order-phone">Number</label>
        </div>
    </div>

    <div class="form-item">
        <div class="input-text">
            <input id="order-email" type="email">
            <label for="order-email">Email</label>
        </div>
    </div>

    <div class="form-item hide-hide-hide">
        <div class="input-text">
            <textarea id="order-message" name="message"></textarea>
            <label for="order-message">Your message</label>
        </div>
    </div>

    <div class="form-item">
        <div class="input-text">
            <textarea id="order-letter"></textarea>
            <label for="order-letter">Your message</label>
        </div>
    </div>

    <div class="form-item">
        <div class="input-text">
            <input id="order-car" type="text">
            <label for="order-car">You car</label>
        </div>
    </div>

    <div class="form-item">
        <div class="input-select">
            <select id="order-fruit">
                <option disabled selected value=""></option>
                <option value="value1">Значение 1</option>
                <option value="value2">Значение 2</option>
                <option value="value3">Значение 3</option>
            </select>
            <label for="order-fruit">Select</label>
        </div>
    </div>

    <div class="form-item">
        <label class="form-item__title" for="order-your_gender">Your gender?</label>
        <div class="input-group-check__items" id="order-your_gender">
            <div class="input-check">
                <input id="order-man" type="checkbox">
                <label for="order-man">Man</label>
            </div>
            <div class="input-check">
                <input id="order-woman" type="checkbox">
                <label for="order-woman">Woman</label>
            </div>
            <div class="input-check">
                <input id="order-nonbinary" type="checkbox">
                <label for="order-nonbinary">NonBinary</label>
            </div>
        </div>
    </div>

    <div class="form-item" input-req>
        <label class="form-item__title" for="order-music_genre">What is your favorite genre of music?</label>
        <div class="input-group-check__items" id="order-music_genre">
            <div class="input-check">
                <input id="order-rap" type="radio" name="genre" value="rap">
                <label for="order-rap">Rap</label>
            </div>
            <div class="input-check">
                <input id="order-pop" type="radio" name="genre" value="pop">
                <label for="order-pop">Pop</label>
            </div>
            <div class="input-check">
                <input id="order-rock" type="radio" name="genre" value="rock">
                <label for="order-rock">Rock</label>
            </div>
            <div class="input-check">
                <input id="order-classic" type="radio" name="genre" value="classic">
                <label for="order-classic">Classic</label>
            </div>
        </div>
    </div>

    <div class="form-item" input-req>
        <div class="input-single-check">
            <input id="order-mailing_list" type="checkbox">
            <label for="order-mailing_list">Получать интересные предложения на почту</label>
        </div>
    </div>

    <input type="submit" value="Отправить">

</form>
