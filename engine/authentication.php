<?php
function auth()
{
    $auth = false;
//------------------------------------------//Нажата кнопка "Выйти"
    if ($_POST['submit_authentication_exit'])
        user_exit();
    elseif ($_SESSION['id_user_session'] != '')
    {
        if (is_auth($_SESSION['id_user_session']))
            $auth = true;
    } elseif ($_COOKIE['id_user_session'] != '')
    {
        if (is_auth($_COOKIE['id_user_session']))
            $auth = true;
    } elseif ($_POST['submit_authentication'])
    {
        if (authentication($_POST['login'], $_POST['password']))
            $auth = true;
    } elseif ($_POST['registration'])
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
    unset($_SESSION['id_user_session']);

    //setcookie('id_user_session', '', time() - 3600 * 24 * 2);
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

        start_user_session($id_user);

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
//------------------------------------------//Функция аутентификации пользователя через сессии или куки
function is_auth($id_user_session)
{
    $id_user_session_security = security($id_user_session);

    $sql = "SELECT id_users, user_agent FROM users_auth WHERE id_users_session = '$id_user_session_security';";
    $user_data = dbQuery($sql);

    $user_agent_db = $user_data[0]['user_agent'];
    $user_agent_security = $_SERVER['HTTP_USER_AGENT'];

    if (password_verify($user_agent_security, $user_agent_db))
    {
        return true;
    } else
    {
        user_exit();
        return false;
    }
}
//------------------------------------------//Функция аутентификации пользователя через форму
function authentication($login, $password)
{
    $login_security = security($login);
    $password_security = security($password);
    unset($_POST['login']);
    unset($_POST['password']);

    $sql = "SELECT id_users, password FROM users WHERE users = '$login_security';";
    $user_data = dbQuery($sql);

    $password_bd = $user_data[0]['password'];
    $id_user_bd = $user_data[0]['id_users'];

    if ($id_user_bd == '')
    {
        echo 'Такой пользователь не зарегистрирован';
    } else
    {
        if (password_verify($password_security, $password_bd))
        {
            $id_user_session_crypto = start_user_session($id_user_bd);

            if ($_POST['remember_me'])
            {
                setcookie('id_user_session', $id_user_session_crypto, time() + 3600 * 24 * 2);
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

    $_SESSION['id_user'] = $id_user;
    $_SESSION['id_user_session'] = $id_user_session_crypto;
    $user_agent_security_crypto = crypto(security($_SERVER['HTTP_USER_AGENT']));

    $sql = "INSERT INTO users_auth (id_users, id_users_session, user_agent, date) VALUES ('$id_user', '$id_user_session_crypto', '$user_agent_security_crypto', CURDATE())";
    dbQuery($sql);

    return $id_user_session_crypto;
}
function update_user_session($id_user_session)
{
    $id_user_session_new = crypto(microtime().rand(100, 10000000000));

    $_SESSION['id_user_session'] = $id_user_session_new;

    $sql = "UPDATE users_auth SET id_users_session = $id_user_session_new, date = CURDATE() WHERE id_users_session = $id_user_session;";
    dbQuery($sql);

    if (security($_COOKIE['id_user_session'] == $id_user_session))
    {
        setcookie('id_user_session', $id_user_session_new, time() + 3600 * 24 * 2);
    }
}