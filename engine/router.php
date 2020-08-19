<?php
function get_page_content()
{
    $url_array = explode('/', $_SERVER['REQUEST_URI']);

    /*echo '<pre>';
    print_r($url_array);
    echo'</pre>';*/

    if ($url_array[5])
    {
        $page_content['templates'] = '../templates/item_page.php';
        $page_content['item'] = get_item($url_array[5]);
    }
    elseif ($url_array[4])
    {
        $page_content['templates'] = '../templates/category_page.php';
        $page_content['category_goods'] = get_category_items(array_search ($url_array[4], GOODS_CATEGORY));
    }
    else
    {
        switch ($url_array[3])
        {
            case '':
                $page_content['templates'] = '../templates/main_page.php';
                $page_content['new_goods'] = get_new_goods(6);
                $page_content['top_goods'] = get_top_goods(3);
                $page_content['sale_goods'] = get_sale_goods(3);
                break;
            case 'catalog':
                $page_content['templates'] = '../templates/catalog_page.php';
                $page_content['all_goods'] = get_all_goods();
                break;
            case 'information':
                $page_content['templates'] = '../templates/information_page.php';
                $page_content = ['info'];
                break;
            case 'contacts':
                $page_content['templates'] = '../templates/contacts_page.php';
                $page_content = ['contacts'];
                break;
        }
    }
    return $page_content;
}

function get_new_goods($quantity)
{
    $sql = "SELECT * FROM goods ORDER BY date_goods DESC LIMIT $quantity;";
    return dbQuery($sql);
}
function get_top_goods($quantity)
{
    $sql = "SELECT * FROM goods ORDER BY view_goods DESC LIMIT $quantity;";
    return dbQuery($sql);
}
function get_sale_goods($quantity)
{
    $sql = "SELECT * FROM goods WHERE sale_goods > 0 LIMIT $quantity;";
    return dbQuery($sql);
}
function get_all_goods()
{
    $sql = "SELECT * FROM goods ORDER BY date_goods DESC;";
    return dbQuery($sql);
}

function get_category_items($category)
{
    $sql = "SELECT * FROM goods WHERE id_category = $category;";
    return dbQuery($sql);
}

function get_item($id_good)
{
    $sql = "SELECT * FROM goods WHERE id_goods = $id_good;";
    return dbQuery($sql);
}