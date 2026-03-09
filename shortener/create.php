<?php

if (!isset($_POST['url'])) {
    die('No URL');
}

$url = trim($_POST['url']);

if (!filter_var($url, FILTER_VALIDATE_URL)) {
    die('Invalid URL');
}

$file = 'links.json';

$links = file_exists($file)
    ? json_decode(file_get_contents($file), true)
    : [];

// 🔹 Генерация случайного 6-символьного кода
$code = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

// сохраняем URL с кодом
$links[$code] = $url;
file_put_contents($file, json_encode($links, JSON_PRETTY_PRINT));

// формируем публичную ссылку с префиксом /r/
$shortLink = '/r/' . $code;
echo "Short link: <a href=\"$shortLink\">$shortLink</a>";