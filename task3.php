<?php
function detectShape($width, $height, $matrix) {
    $top = $height;
    $bottom = 0;
    $left = $width;
    $right = 0;

    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            if ($matrix[$y][$x] == 1) {     // Если ячейка является частью фигуры (1)
                // Обновляем границы фигуры
                if ($y < $top) $top = $y;          // Верхняя граница
                if ($y > $bottom) $bottom = $y;    // Нижняя граница
                if ($x < $left) $left = $x;        // Левая граница
                if ($x > $right) $right = $x;      // Правая граница
            }
        }
    }

    $figWidth = $right - $left + 1;    // Ширина фигуры
    $figHeight = $bottom - $top + 1;   // Высота фигуры

    // Если ширина и высота примерно равны, проверяем на квадрат или круг(отличаются не больше чем на 1)
    if (abs($figWidth - $figHeight) <= 1) {  // Проверка: фигура почти квадратная
        // Проверка на квадрат: у квадрата все пиксели вдоль границ равны 1
        for ($y = $top; $y <= $bottom; $y++) {   // Проверяем левую и правую границы
            if ($matrix[$y][$left] != 1 || $matrix[$y][$right] != 1) {
                return "circle";  // Если хотя бы одна граница нарушена, это круг
            }
        }
        for ($x = $left; $x <= $right; $x++) {   // Проверяем верхнюю и нижнюю границы
            if ($matrix[$top][$x] != 1 || $matrix[$bottom][$x] != 1) {
                return "circle";  // Если хотя бы одна граница нарушена, это круг
            }
        }
        return "square";  // Если все границы соблюдены, фигура — квадрат
    } else {
        // Иначе это треугольник
        return "triangle";
    }
}

echo "Введите ширину изображения: ";
$width = (int)trim(fgets(STDIN));

echo "Введите высоту изображения: ";
$height = (int)trim(fgets(STDIN));

$matrix = [];
echo "Введите строки изображения (по $width чисел, разделённых пробелом):\n";
for ($i = 0; $i < $height; $i++) {
    $line = trim(fgets(STDIN));                     
    $matrix[] = array_map('intval', explode(' ', $line));  // Преобразуем строку в массив чисел
}

$result = detectShape($width, $height, $matrix);
echo "Фигура: $result\n";
?>
