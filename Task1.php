<?php
if (isset($_GET['size'])) {
    $size = $_GET['size'];
    setcookie('font_size', $size, time() + 86400, '/');
    header("Location: Task1.php"); 
    exit();
}

$fontSize = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : '16px';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зміна розміру шрифту</title>
    <style>
        body {
            font-size: <?php echo htmlspecialchars($fontSize); ?>;
        }
    </style>
</head>
<body>
    <h1>Виберіть розмір шрифту</h1>
    <a href="?size=24px">Великий шрифт</a> |
    <a href="?size=16px">Середній шрифт</a> |
    <a href="?size=12px">Маленький шрифт</a>

    <p>Цей текст змінює свій розмір в залежності від вибраного варіанту.</p>

    <br>
<button onclick="window.location.href='Lab3.php' ">На головну</button>

</body>
</html>
