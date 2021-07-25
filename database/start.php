<?php
$config = include 'database/config.php';
//подключила два класса
include 'database/QueryBuilder.php';
include 'database/Connection.php';

//вытащила пдо с помощью ф-ии этого класса
//$pdo = Connection::make();

//создала новый объект на основе класса QB
return new QueryBuilder(
	Connection::make($config['database']));

?>