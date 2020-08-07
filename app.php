<?php
session_start();
require_once 'config/config.php';
require_once 'engine/dbQuery.php';
require_once 'engine/authentication.php';

$auth = auth();                             //Проверка аутентификации пользователя

$url_array = explode('/', $_SERVER['REQUEST_URI']);

echo '<pre>';
print_r($url_array);
echo'</pre>';

require_once 'templates/bases.php';