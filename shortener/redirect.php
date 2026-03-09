<?php

$file = 'links.json';
$links = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// получаем код из URL
$code = trim($_SERVER['REQUEST_URI'], '/');

// 🔹 убираем префикс r/ если есть
if (str_starts_with($code, 'r/')) {
    $code = substr($code, 2); // удаляем первые 2 символа "r/"
}

if (!isset($links[$code])) {
    http_response_code(404);
    exit('Link not found');
}

$originalUrl = $links[$code];

// редирект через HTML с favicon и title
echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Redirecting...</title>
<link rel="icon" href="/images/favicon.ico" type="image/x-icon">
<meta http-equiv="refresh" content="0;url=' . htmlspecialchars($originalUrl) . '">
</head>
<body>
Redirecting...
</body>
</html>';
exit;