<?php
function add_good_basket()
{
    $id_good_security = security($_POST['id_good']);
    $quantity_security = security($_POST['quantity']);

    if (isset($_COOKIE['basket'][$id_good_security]))
    {
        $quantity = security($_COOKIE['basket'][$id_good_security]) + $quantity_security;
        setcookie("basket[$id_good_security]", $quantity, time() + 3600 * 24 * 7, '/php1/lesson8/');
    }
    else
        setcookie("basket[$id_good_security]", $quantity_security, time() + 3600 * 24 * 7, '/php1/lesson8/');


    /*if ($auth)
    {
        //$id_user = $_SESSION['id_user'];

        //$sql = "INSERT INTO basket(id_goods, qantity, id_user, `date`) VALUES ($id_good_security, $quantity_security, $id_user, now());";
        //dbQuery($sql);
    }

    //return get_basket_user($id_user);
*/

}

function get_basket()
{
    $basket = [];
    foreach ($_COOKIE['basket'] as $key => $value)
    {
        //echo $key.', '.$value.'<br>';
        $sql = "SELECT name_goods, price_goods FROM goods WHERE id_goods = $key";
        $goods = dbQuery($sql);
        $name_goods = $goods[0]['name_goods'];
        $price_goods = $goods[0]['price_goods'];

        $basket[$key]['name_goods'] = $name_goods;
        $basket[$key]['price_goods'] = $price_goods;
        $basket[$key]['quantity'] = $value;
    }

    return $basket;
}

function clear_bascet()
{
    setcookie('basket', '', time() - 3600 * 24 * 7);
    unset($_SESSION['basket']);
}