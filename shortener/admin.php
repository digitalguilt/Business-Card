<?php
 
// Файл со ссылками
$file = 'links.json';
if (!file_exists($file)) {
    file_put_contents($file, '{}');
}

$links = json_decode(file_get_contents($file), true);

// Удаление ссылки
if (isset($_GET['delete'])) {
    $code = $_GET['delete'];
    if (isset($links[$code])) {
        unset($links[$code]);
        file_put_contents($file, json_encode($links, JSON_PRETTY_PRINT));
    }
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Shortener Admin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 2rem; }
        table { border-collapse: collapse; width: 100%; margin-top: 1rem; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a.button { background-color: #e74c3c; color: white; padding: 4px 8px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <h2>Link Shortener Admin</h2>
    <table>
        <tr>
            <th>Короткая ссылка</th>
            <th>Длинная ссылка</th>
            <th>Действие</th>
        </tr>
        <?php foreach($links as $code => $url): ?>
        <tr>
            <td><a href="/r/<?php echo htmlspecialchars($code); ?>" target="_blank">/r/<?php echo htmlspecialchars($code); ?></a></td>
            <td><a href="<?php echo htmlspecialchars($url); ?>" target="_blank"><?php echo htmlspecialchars($url); ?></a></td>
            <td><a class="button" href="?delete=<?php echo urlencode($code); ?>" onclick="return confirm('Удалить эту ссылку?')">Удалить</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>