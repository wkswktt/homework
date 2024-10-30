<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список статей</title>
</head>
<body>
    <h1>Список статей</h1>
    <?php
    // Подключение файла с функциями
    include 'functions.php';

    // Получение списка статей
    $articles = getArticles();

    // Вывод списка статей
    foreach ($articles as $filename => $title) {
        // Чтение содержимого статьи
        $articleContent = file_get_contents("articles/" . $filename);
        $articleUrl = "article.php?file=" . urlencode($filename);

        // Генерация анонса
        $excerpt = generateExcerpt($articleContent, $articleUrl);

        // Вывод статьи
        echo "<h2>" . htmlspecialchars($title) . "</h2>";
        echo "<p>" . $excerpt . "</p>";
    }
    ?>
</body>
</html>
