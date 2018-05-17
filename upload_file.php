<?php

// Путь загрузки
$path = 'i/';

// Обработка запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
 // Загрузка файла и вывод сообщения
 if (!@copy($_FILES['photo']['tmp_name'], $path . $_FILES['photo']['name']))
  echo 'Что-то пошло не так';
 else
  header('Location : /frame');
}

?>


