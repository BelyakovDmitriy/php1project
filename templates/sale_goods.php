<h3>Товары со скидкой</h3>
<div class="sale_goods">
    <?php
    $sale_goods_array = $page_content['sale_goods'];
    foreach ($sale_goods_array as $sale_good): ?>
        <a class="sale_goods_item" href="<?php echo DOMAIN ?>catalog/<?php echo GOODS_CATEGORY[$sale_good['id_category']]."/".$sale_good['id_goods'] ?>">
            <div class="name_goods"><?php echo $sale_good['name_goods'] ?></div>
            <div class="price_goods"><?php echo $sale_good['price_goods'] ?></div>
        </a>
    <?php endforeach ?>
</div>