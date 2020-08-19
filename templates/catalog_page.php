<?php require 'category_menu.php'?>
<div class="all_goods">
    <?php
    $all_goods_array = $page_content['all_goods'];
    foreach ($all_goods_array as $all_good): ?>
        <a class="all_goods_item" href="<?php echo DOMAIN ?>catalog/<?php echo GOODS_CATEGORY[$all_good['id_category']]."/".$all_good['id_goods'] ?>">
            <div class="name_goods"><?php echo $all_good['name_goods'] ?></div>
            <div class="price_goods"><?php echo $all_good['price_goods'] ?></div>
        </a>
    <?php endforeach ?>
</div>