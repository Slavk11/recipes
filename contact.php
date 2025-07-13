<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Если попытка захода не через POST — возвращаем на форму
    header('Location: contact.html');
    exit;
}

// Читаем и очищаем данные
$name    = htmlspecialchars(trim($_POST['name']));
$email   = htmlspecialchars(trim($_POST['email']));
$message = htmlspecialchars(trim($_POST['message']));

// Валидация
if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$message) {
    echo 'Пожалуйста, заполните форму правильно.';
    exit;
}

// Параметры письма
$to      = 'slavk11@inbox.ru';
$subject = 'Новое сообщение с сайта «Кулинарные рецепты»';
$body    = "Имя: $name\nEmail: $email\n\nСообщение:\n$message";
$headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=utf-8";

// Отправляем
if (mail($to, $subject, $body, $headers)) {
    echo 'Спасибо! Ваше сообщение отправлено.';
} else {
    echo 'Ошибка при отправке. Попробуйте позже.';
}
?>
