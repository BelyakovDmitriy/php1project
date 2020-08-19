<?php
function clear_bascet()
{
    setcookie('basket', '', time() - 3600 * 24 * 7);
    unset($_SESSION['basket']);
}