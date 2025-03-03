<?php
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if ($login && $password) {
        $userDir = "users/$login";
        
        if (is_dir($userDir)) {
            function deleteFolder($folder) {
                foreach (scandir($folder) as $file) {
                    if ($file === '.' || $file === '..') continue;
                    $filePath = "$folder/$file";
                    if (is_dir($filePath)) {
                        deleteFolder($filePath);
                    } else {
                        unlink($filePath);
                    }
                }
                rmdir($folder);
            }
            
            deleteFolder($userDir);
            $message = "<p style='color: green;'>Папку користувача успішно видалено!</p>";
        } else {
            $message = "<p style='color: red;'>Помилка: Папка користувача не знайдена!</p>";
        }
    } else {
        $message = "<p style='color: red;'>Будь ласка, заповніть всі поля!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видалення папки користувача</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        input {
            margin: 10px 0;
            padding: 5px;
            width: 200px;
        }
        button {
            padding: 10px;
            background-color: #FF0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #CC0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Видалення папки користувача</h2>
        <?php echo $message; ?>
        <form method="post">
            <input type="text" name="login" placeholder="Логін" required><br>
            <input type="password" name="password" placeholder="Пароль" required><br>
            <button type="submit">Видалити</button>
        </form>
    </div>
    <br>
    <button onclick="window.location.href='Lab3.php'">На головну</button>
</body>
</html>
