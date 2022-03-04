<?php

$errors = [];
$data = [];


//Проверка заполнено ли скрытые поля
if (!empty($_POST['comment']) || !empty($_POST['message'])) {
    $errors['spam'] = 'Spam protected.';
}

//Проверка обязательного поля
/*if (trim(empty($_POST['phone']))) {
	$errors['phone'] = 'Phone is required.';
}*/

//Формирование заголовка сообщения
function title_mail() {
    if (!empty($_POST['name'])) {
        return 'Заявка от ' . $_POST['name'] . ' | ' . get_bloginfo();
    } else {
        return 'Заявка от клиента | ' . get_bloginfo();
    }
}

//Формирование заголовка сообщения
function title_body_mail() {
    if (!empty($_POST['name'])) {
        return '<h1> Заявка от ' . $_POST['name'] . ' | ' . get_bloginfo() . ' </h1>';
    } else {
        return '<h1> Заявка от клиента | ' . get_bloginfo() . ' </h1>';
    }
}


if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';

    $path = preg_replace('/wp-content(?!.*wp-content).*/', '', __DIR__);
    require($path . 'wp-load.php');

    //Формирование тела сообщения
    $mail_body = title_body_mail();

    foreach ($_POST as $key => $value) {
        if (trim(!empty($value))) {
            if ($key == 'page') {
                $mail_body .= '<p><strong>Страница: </strong>  ' . $value . '  </p>';
            } elseif ($key == 'pageUrl') {
                $mail_body .= '<p><strong>Ссылка: </strong>  ' . $value . '  </p>';
            } else {
                $mail_body .= '<p><strong> ' . $key . ': </strong>  ' . $value . '  </p>';
            }
        } else {
            $mail_body .= '<p><strong> ' . $key . ': </strong>  -  </p>';
        }
    }

    //Получатель письма
    if (carbon_get_theme_option('site-email')) {
        $mailto = carbon_get_theme_option('site-email');
        if (carbon_get_theme_option('site-email-lead')) {
            $mailto = carbon_get_theme_option('site-email-lead');
        }
    } else {
        $mailto = 'spl33t@ya.ru';
    }

    $from = get_option('admin_email');
    $to = $mailto;
    $subject = title_mail();
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        '' . get_bloginfo() . ' <' . $from . '>'
    );

    // Send message to mail
    wp_mail($to, $subject, $mail_body, $headers);

    /*
    * Support Telegram-bot, sending order in to chat
    * Tutorial code https://blog.maxgraph.ru/kak-otpravlyat-zayavku-s-sajta-v-telegram/
    */
    if (carbon_get_theme_option('telegram_bot_token')) {
        $telegram_bot_token = carbon_get_theme_option('telegram_bot_token');
    } else {
        $telegram_bot_token = "5159584141:AAEpR0FXGz6EIw2B-ujTJ-uuPjfrsMTPKi8";
    }

    if (carbon_get_theme_option('telegram_chatID')) {
        $telegram_chatID = carbon_get_theme_option('telegram_chat_id');
    } else {
        $telegram_chatID = "-780012763";
    }

    $telegram_message = '';

    //Telegram message
    foreach ($_POST as $key => $value) {
        if (trim(!empty($value))) {
            if ($key == 'page') {
                $telegram_message .= "<b>Страница:</b> {$value} %0A";
            } elseif ($key == 'pageUrl') {
                $telegram_message .= "<b>Ссылка:</b> {$value} %0A";
            } else {
                $telegram_message .= "<b>{$key}:</b> {$value} %0A";
            }
        } else {
            $telegram_message .= "<b>{$key}:</b> - %0A";
        }
    }

    $sendToTelegram = fopen("https://api.telegram.org/bot{$telegram_bot_token}/sendMessage?chat_id={$telegram_chatID}&parse_mode=html&text={$telegram_message}", "r");

}

echo json_encode($data);
