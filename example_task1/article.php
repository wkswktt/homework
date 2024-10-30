<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Полная статья</title>
</head>
<body>
    <a href="index.php">Вернуться к списку статей</a>
    <hr>
    <?php
    // Проверяем, был ли передан параметр file
    if (isset($_GET['file'])) {
        $filename = "articles/" . basename($_GET['file']);

        // Проверяем, существует ли файл
        if (file_exists($filename)) {
            $articleContent = file_get_contents($filename);
            echo "<h1>Полная версия статьи</h1>";
            echo "<p>" . nl2br(htmlspecialchars($articleContent)) . "</p>";
        } else {
            echo "<p>Статья не найдена.</p>";
        }
    } else {
        echo "<p>Файл не указан.</p>";
    }
    ?>
</body>
</html>
