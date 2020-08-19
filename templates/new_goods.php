<h3>Новая коллекция</h3>
<div class="new_goods">
    <?php
    $new_goods_array = $page_content['new_goods'];
    foreach ($new_goods_array as $new_good): ?>
        <a class="new_goods_item" href="<?php echo DOMAIN ?>catalog/<?php echo GOODS_CATEGORY[$new_good['id_category']]."/".$new_good['id_goods'] ?>">
            <div class="name_goods"><?php echo $new_good['name_goods'] ?></div>
            <div class="price_goods"><?php echo $new_good['price_goods'] ?></div>
        </a>
    <?php endforeach ?>
</div>