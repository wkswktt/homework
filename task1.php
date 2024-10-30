<?php
// Функция генерации анонса
function generateExcerpt($articleText, $articleUrl) {
    $excerpt = mb_substr($articleText, 0, 250, 'UTF-8');
    if (mb_substr($excerpt, -1, 1, 'UTF-8') !== ' ') {
        $excerpt = mb_substr($excerpt, 0, mb_strrpos($excerpt, ' ', 0, 'UTF-8'), 'UTF-8');
    }
    $excerpt .= '...';
    $linkText = 'Читать далее';
    $excerpt .= ' <a href="' . htmlspecialchars($articleUrl) . '">' . $linkText . '</a>';
    return $excerpt;
}

// Функция для загрузки списка статей
function getArticles() {
    return [
        "article1.txt" => "Преимущества утренней зарядки",
        "article2.txt" => "Как выбрать идеальное место для отпуска",
        "article3.txt" => "Советы по уходу за комнатными растениями",
    ];
}
?>
