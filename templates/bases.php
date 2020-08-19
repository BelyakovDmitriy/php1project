<?php
require_once 'head.php';
require 'header.php';
?>

<div class="main">
    <div class = 'main_left'>
        Поле регистрации<br>
        <?php require 'auth.php' ?>
    </div>
    <div class="main_right">
        <?php require $page_content['templates'] ?>
    </div>
</div>

<?php require 'footer.php';