<h3>Популярные товары</h3>
<div class="top_goods">
    <?php
    $top_goods_array = $page_content['top_goods'];
    foreach ($top_goods_array as $top_good): ?>
        <a class="top_goods_item" href="<?php echo DOMAIN ?>catalog/<?php echo GOODS_CATEGORY[$top_good['id_category']]."/".$top_good['id_goods'] ?>">
            <div class="name_goods"><?php echo $top_good['name_goods'] ?></div>
            <div class="price_goods"><?php echo $top_good['price_goods'] ?></div>
        </a>
    <?php endforeach ?>
</div>