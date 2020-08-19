<?php
//------------------------------------------//Конфигурация БД
define('HOST', 'localhost');
define('USER', 'dmitriy');
define('PASS', 'dmitriy');
define('DB', 'lesson8');

define('DOMAIN', 'http://geekbrains/php1/lesson8/');

define('GOODS_CATEGORY', ['t-shirt', 'trousers', 'cardigan', 'cap']);
//------------------------------------------//Функция защиты от пользовательских атак
function security($value)
{
    return mysqli_real_escape_string(connect_DB(), $value);
}
//------------------------------------------//Функция шифрования
function crypto($value)
{
    return password_hash($value, PASSWORD_BCRYPT, ['cost' => 9,]);
}