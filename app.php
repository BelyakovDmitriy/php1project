<?php
session_start();
require_once 'config/config.php';
require_once 'engine/dbQuery.php';
require_once 'engine/authentication.php';
require_once 'engine/router.php';
require_once 'engine/basket.php';

$auth = auth();

$page_content = get_page_content();         //Получаем содержимое страницы

$basket = get_basket();

if ($_POST['id_good'])                      //Добавляем товар в карзину
    add_good_basket();

/*
echo "<pre>";
echo 'session<br>';
print_r($_SESSION);
//echo 'post<br>';
//print_r($_POST);
echo 'cookie<br>';
print_r($_COOKIE);
echo 'basket<br>';
print_r($basket);
echo "</pre>";
*/
require_once 'templates/bases.php';