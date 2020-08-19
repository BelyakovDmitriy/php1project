<?php
session_start();
require_once 'config/config.php';
require_once 'engine/dbQuery.php';
require_once 'engine/authentication.php';
require_once 'engine/router.php';
require_once 'engine/basket.php';

$auth = auth();                             //Проверка аутентификации пользователя

$page_content = get_page_content();         //Получаем содержимое страницы


/*echo '<pre>';
print_r($_GET);
//print_r($url_array);
//print_r($page_content);
echo'</pre>';*/

require_once 'templates/bases.php';