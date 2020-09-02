<?php
require_once 'head.php';
require 'header.php';
?>

<div class="main">
    <div class = 'main_left'>
        Поле регистрации<br>
        <?php require 'auth.php' ?><br>
        <form action="" method="post">
            <input type="submit" name="basket" value="Корзина">
        </form>
    </div>
    <div class="main_right">
        <?php require $page_content['templates'] ?>
        <?php require 'basket.php' ?>
    </div>
</div>

<?php require 'footer.php';