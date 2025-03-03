<?php
session_start();

// Обробка форми авторизації
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($login === 'Admin' && $password === 'password') {
        $_SESSION['user'] = 'Admin';
    } else {
        $error = 'Невірний логін або пароль!';
    }
}

// Обробка виходу
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: Task2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизація</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label, input, button {
            margin: 5px;
        }
        button {
            padding: 5px 10px;
            background-color:rgb(119, 119, 119);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['user'])): ?>
            <h2>Добрий день, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
            <a href="?logout=true">Вийти</a>
        <?php else: ?>
            <h2>Форма авторизації</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="post">
                <label>Логін: <input type="text" name="login" required></label><br>
                <label>Пароль: <input type="password" name="password" required></label><br>
                <button type="submit">Увійти</button>
            </form>
        <?php endif; ?>
    </div>
    <br>
    <button onclick="window.location.href='Lab3.php'">На головну</button>
</body>
</html>