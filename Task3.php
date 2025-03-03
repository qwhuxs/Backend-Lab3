<?php
$filename = "comments.txt";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    
    if ($name && $comment) {
        $entry = "$name|$comment" . PHP_EOL;
        file_put_contents($filename, $entry, FILE_APPEND);
    }
}

$comments = file_exists($filename) ? file($filename, FILE_IGNORE_NEW_LINES) : [];
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Коментарі</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Залиште коментар</h2>
        <form method="post">
            <label>Ім’я: <input type="text" name="name" required></label><br><br>
            <label>Коментар:<br> <textarea name="comment" required></textarea></label><br><br>
            <button type="submit">Надіслати</button>
        </form>

        <h2>Список коментарів</h2>
        <table>
            <tr>
                <th>Ім’я</th>
                <th>Коментар</th>
            </tr>
            <?php foreach ($comments as $entry): ?>
                <?php list($user, $text) = explode('|', $entry, 2); ?>
                <tr>
                    <td><?php echo htmlspecialchars($user); ?></td>
                    <td><?php echo htmlspecialchars($text); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <br>
    <button onclick="window.location.href='Lab3.php'">На головну</button>

</body>
</html>
