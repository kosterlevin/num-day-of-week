<?php
/**
 * Telegram Bot access token и URL.
 */
$access_token = '222935283:AAH6MzetVDZHHQ7IuECcUdgW3J6P4BC4kq4';
$api = 'https://api.telegram.org/bot' . $access_token;

/**
 * Задаём основные переменные.
 */
$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$first_name = $output['message']['chat']['first_name'];
$message = $output['message']['text'];

/**
 * Emoji для лучшего визуального оформления.
 */
$emoji = array(
  'preload' => json_decode('"\uD83D\uDE03"'), // Улыбочка.
  'weather' => array(
    'clear' => json_decode('"\u2600"'), // Солнце.
    'clouds' => json_decode('"\u2601"'), // Облака.
    'rain' => json_decode('"\u2614"'), // Дождь.
    'snow' => json_decode('"\u2744"'), // Снег.
  ),
);

/**
 * Получаем команды от пользователя.
 */
switch($message) {
  case '/privet':
    // Отправляем приветственный текст.
    $preload_text = 'Одну секунду, ' . $first_name . ' ' . $emoji['preload'] . ' Я уточняю, что могу для вас сделать..';
    sendMessage($chat_id, $preload_text);
    // Отправка ответа пользователю Telegram.
    $wait_text = 'Сейчас-сейчас!! ';
    sendMessage($chat_id, $wait_text);
    $welcom_text = 'О, рад вас видеть,' . $first_name . '!' ;
    sendMessage($chat_id, $weather_text);
    break;
  default:
    break;
}

/**
 * Функция отправки сообщения sendMessage().
 */
function sendMessage($chat_id, $message) {
  file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message));
}