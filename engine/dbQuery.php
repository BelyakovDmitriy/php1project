<?php
function dbQuery($sql) {
    $link = connect_DB();
    $result = mysqli_query($link, $sql);

    if ($result === false || $result === true) $dbAnswer = $result;
    else {
        $dbAnswer = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $dbAnswer[] = $row;
        }
    }

    mysqli_close($link);
    return $dbAnswer;
}
function connect_DB()
{
    $link = mysqli_connect(HOST, USER, PASS, DB) or die('Ошибка подключения к БД');
    mysqli_query($link, 'SET NAMES utf8');
    return $link;
}