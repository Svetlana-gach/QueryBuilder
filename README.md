Прописываем в файле Config данные своей БД для работы с ней

Подключаем файл "start.php"

Пример использования :
<?php
$db = include 'database/start.php';

//получаем всё из БД
$posts = $db -> get_all('posts');


//с помощью массива GET удаляем строку из БД
$id = $_GET['id'];
$db->delete('posts', $id);
