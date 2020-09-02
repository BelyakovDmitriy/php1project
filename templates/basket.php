<h3>Корзина</h3>
<div class="basket">
    <?php
    foreach ($basket as $good): ?>
        <div class="goods">
            <div class="name_goods"><?php echo $good['name_goods'] ?></div>
            <div class="price_goods"><?php echo $good['price_goods'] ?></div>
            <div class="quantity"><?php echo $good['quantity'] ?></div>
        </div>
    <?php endforeach ?>
</div>