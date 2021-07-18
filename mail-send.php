<?php


$errors = [];
$data = [];

//Проверка заполнено ли скрытые поля
if (!empty($_POST['comment']) || !empty($_POST['message'])) {
	$errors['spam'] = 'Spam protected.';
}

//Проверка обязательного поля
if (trim(empty($_POST['phone']))) {
	$errors['phone'] = 'Phone is required.';
}

//Формирование заголовка сообщения
function title_mail()
{
	if (!empty($_POST['name'])) {
		return 'Заявка от ' . $_POST['name'] . ' | ' . get_bloginfo();
	} else {
		return 'Заявка от клиента | ' . get_bloginfo();
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

	$body = title_mail();

	if (trim(!empty($_POST['name']))) {
		$body .= '<p><strong>Имя:</strong> ' . $_POST['name'] . '</p>';
	}
	if (trim(!empty($_POST['phone']))) {
		$body .= '<p><strong>Телефон:</strong> ' . $_POST['phone'] . '</p>';
	}

	$from = get_option('admin_email');
	$to = 'spl33t@ya.ru';
	$subject =  title_mail();
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		''.get_bloginfo() .' <'.$from.'>'
	);

	wp_mail($to, $subject, $body, $headers);
}

echo json_encode($data);