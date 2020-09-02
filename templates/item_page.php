<div class="item">
    <div class="name_goods">Название: <?php echo $page_content['item'][0]['name_goods'] ?></div>
    <div class="price_goods">Цена: <?php echo $page_content['item'][0]['price_goods'] ?> р.</div>
    <div class="description_goods">Описание: <?php echo $page_content['item'][0]['description_goods'] ?></div>
    <div class="sale_good">Скидка: <?php echo $page_content['item'][0]['sale_goods'] ?>%</div>
    <input type="text" id="quantity" value="1">
    <input type="submit" onclick="add_basket(this)" value="В корзину" data-good_id = <?php echo $page_content['item'][0]['id_goods'] ?>>
</div>