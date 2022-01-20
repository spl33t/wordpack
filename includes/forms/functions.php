<?php

function get_form_by_id($postID)
{
    $form_elements = carbon_get_post_meta($postID, 'form_elements');

    $form_result = '';

    foreach ($form_elements as $form_element) {
        //var_dump($form_element['is_require']);
        if ($form_element['_type'] == 'phone_input') {
            $form_result .= '<div class="input-field">
								<input 
								    class="form__input-phone'. ($form_element['is_require'] ? '_req' : '') .'" 
								    id="tel" 
								    name="tel" 
								    type="tel" required>
							    <label for="tel">Телефон</label>
							</div>';
        }
        if ($form_element['_type'] == 'name_input') {
            $form_result .= '<div class="input-field">
								<input 
								    class="form__input-name'. ($form_element['is_require'] ? '_req' : '') .'" 
								    id="name" 
								    name="name" 
								    type="text">
							    <label for="name">Имя</label>
							</div>';
        }
    }

    return '<form class="form-order">
				' . $form_result . '
				<textarea name="comment"></textarea>
				<textarea name="message"></textarea>
				<input type="submit" value="DYNAMIC">
			</form>';
}