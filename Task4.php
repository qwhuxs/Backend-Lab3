<?php
$uploadDir = 'uploads/'; 
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $targetFile = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileType, $allowedTypes) && $file['size'] > 0) {
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $message = "<p style='color: green;'>Файл успішно завантажено!</p>";
        } else {
            $message = "<p style='color: red;'>Помилка при завантаженні файлу.</p>";
        }
    } else {
        $message = "<p style='color: red;'>Неприпустимий формат файлу або файл порожній.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завантаження зображень</title>
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
        input[type='file'] {
            margin: 10px 0;
        }
        button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
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
        <h2>Форма завантаження зображень</h2>
        <?php echo $message; ?>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/*" required><br>
            <button type="submit">Завантажити</button>
        </form>
    </div>

    <br>
    <button onclick="window.location.href='Lab3.php'">На головну</button>

</body>
</html>
