<?php
function auth()
{
    $auth = false;
    if (!isset($_SESSION['id_user_session']))           //  если нет переменной сессии в сессии (открытие сайта)
    {
        $_SESSION['id_user_session'] = '';              //  создаем пустую переменную сессии
        if (isset($_COOKIE['id_user_session']))         //  смотрим есть ли кука с переменной сессии
        {
            if (is_auth_cookie($_COOKIE['id_user_session']))   //  если кука есть и подходящая
            {
                setcookie('id_user_session', $_SESSION['id_user_session'], time() + 3600 * 24 * 2, '/php1/lesson8/'); //  обнвляем куку
                $auth = true;
            }
        } elseif (is_auth_form())                       //  смотрим есть ли попытка аутентификации через форму
            $auth = true;
    } elseif (isset($_POST['submit_authentication_exit']))  //  если не первый вход на сайт - смотрим нажата ли кнопка Выйти
        user_exit();
    elseif ($_SESSION['id_user_session'] == '')         //  переменная сессии пуста (аутентификации нет)
    {
        if (is_auth_form())                             //  смотрим есть ли попытка аутентификации через форму
            $auth = true;
    } elseif (is_auth_session())    //  пробуем аутентифицироваться через сессию
        $auth = true;
    return $auth;
}
function is_auth_form()
{
    $auth = false;
    if ($_POST['submit_authentication'])                                //  Нажата кнопка "Войти"
    {
        if (authentication($_POST['login'], $_POST['password']))
            $auth = true;
    } elseif ($_POST['registration'])                               //  Нажата кнопка "Зарегистрироваться"
    {
        if (user_registration($_POST['login'], $_POST['password']))
            $auth = true;
    }
    return $auth;
}
//------------------------------------------//Функция выхода и удаления переменных сессии и кук
function user_exit()
{
    $id_user_session = $_SESSION['id_user_session'];
    $sql = "DELETE FROM users_auth WHERE id_users_session = '$id_user_session';";
    dbQuery($sql);

    unset($_SESSION['id_user']);
    $_SESSION['id_user_session'] = '';
    unset($_SESSION['user_agent_security']);
    unset($_SESSION['basket']);

    setcookie('id_user_session', 'false', time() - 3600 * 24 * 2, '/php1/lesson8/');
    unset($_COOKIE['id_user_session']);
}
//------------------------------------------//Функция регистрации нового пользователя
function user_registration($login, $password)
{
    if ($login == '' || $password == '')    //Если поля логина и/или пароля пустые
    {
        echo 'Заполните поля';
        return false;
    }

    $login_security = security($login);
    $password_security_crypto = crypto(security($password));

    if (!double_login($login_security))              //Проверка на занятость логина
    {
        $id_user = time().rand(1, 100000);

        $sql = "INSERT INTO users (id_users, users, password) VALUES ('$id_user', '$login_security', '$password_security_crypto');";
        dbQuery($sql);

        start_user_session($id_user);               //Создание пользовательской сессии в базе

        echo 'Регистрация успешна';
        return true;
    } else
    {
        echo 'Такой логин уже существует';
        return false;
    }
}
//------------------------------------------//Функция проверки на занятость логина
function double_login($login_security)
{
    $sql = "SELECT users FROM users;";
    $login_db_array = dbQuery($sql);

    foreach ($login_db_array as $key => $value)
    {
        if ($login_db_array[$key]['users'] == $login_security)
        {
            return true;
        }
    }
    return false;
}
//------------------------------------------//Функция аутентификации пользователя через куки
function is_auth_cookie($id_user_session)
{
    $id_user_session_security = security($id_user_session);

    $sql = "SELECT id_users, user_agent FROM users_auth WHERE id_users_session = '$id_user_session_security';";
    $user_data = dbQuery($sql);

    $user_agent_db = $user_data[0]['user_agent'];
    //$id_user_db = $user_data[0]['id_users'];

    $_SESSION['user_agent_security'] = security($_SERVER['HTTP_USER_AGENT']);

    if (password_verify($_SESSION['user_agent_security'], $user_agent_db))
    {
        //$_SESSION['id_user'] = $id_user_db;
        $_SESSION['id_user_session'] = $id_user_session_security;
        return true;
    } else
    {
        user_exit();
        return false;
    }
}
//------------------------------------------//Функция аутентификации пользователя через сессиию
function is_auth_session()
{
    $auth = false;
    if ($_SESSION['user_agent_security'] == security($_SERVER['HTTP_USER_AGENT']))
        $auth = true;
    return $auth;
}
//------------------------------------------//Функция аутентификации пользователя через форму
function authentication($login, $password)
{
    $login_security = security($login);
    $password_security = security($password);

    $sql = "SELECT id_users, password FROM users WHERE users = '$login_security';";
    $user_data = dbQuery($sql);

    $password_db = $user_data[0]['password'];
    $id_user_db = $user_data[0]['id_users'];

    if ($id_user_db == '')
    {
        echo 'Такой пользователь не зарегистрирован';
    } else
    {
        if (password_verify($password_security, $password_db))
        {
            $id_user_session_crypto = start_user_session($id_user_db);
            //$_SESSION['id_user'] = $id_user_db;

            if ($_POST['remember_me'])
            {
                setcookie('id_user_session', $id_user_session_crypto, time() + 3600 * 24 * 2, '/php1/lesson8/');
            }
            return true;
        } else
        {
            echo 'Введен неверный пароль';
        }
    }
    return false;
}
function start_user_session($id_user)
{
    $id_user_session_crypto = crypto(microtime().rand(1, 100000));

    //$_SESSION['id_user'] = $id_user;
    $_SESSION['id_user_session'] = $id_user_session_crypto;
    $_SESSION['user_agent_security'] = security($_SERVER['HTTP_USER_AGENT']);
    $user_agent_security_crypto = crypto(security($_SERVER['HTTP_USER_AGENT']));

    $sql = "INSERT INTO users_auth (id_users, id_users_session, user_agent, date) VALUES ('$id_user', '$id_user_session_crypto', '$user_agent_security_crypto', CURDATE())";
    dbQuery($sql);

    return $id_user_session_crypto;
}