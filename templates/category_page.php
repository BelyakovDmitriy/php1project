<?php require 'category_menu.php' ?>
<div class="category_goods">
    <?php
    $category_goods_array = $page_content['category_goods'];
    foreach ($category_goods_array as $category_good): ?>
        <div class="category_goods_item">
            <div class="name_goods"><?php echo $category_good['name_goods'] ?></div>
            <div class="price_goods"><?php echo $category_good['price_goods'] ?></div>
        </div>
    <?php endforeach ?>
</div>