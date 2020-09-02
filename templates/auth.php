<?php if ($auth): ?>
    <form action="" method="post">
        <input type="submit" name="submit_authentication_exit" value="Выйти">
    </form>
<?php else: ?>
    <form action="" method="post">
        <label for="login">Логин</label><br>
        <input type="text" name="login"><br>
        <label for="password">Пароль</label><br>
        <input type="password" name="password"><br>
        <label for="remember_me">Запомнить меня</label>
        <input type="checkbox" name="remember_me"><br>
        <input type="submit" name="submit_authentication" value="Войти"><br>
        <input type="submit" name="registration" value="Зарегистрироваться">
    </form>
<?php endif; ?>