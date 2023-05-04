<div class="modalCart--wrapper fadeCart">
    <div class="modalCart--title_main">
        <span>Корзина товаров</span>
    </div>
<div class="modalCart--products">
<?php if(!empty($_SESSION['cart'])): ?>
    <div class="cartItems">
    <?php foreach ($_SESSION['cart'] as $k => $v): ?>
    <div class="modalCart--productItem">
        <div class="modalCart--image">
            <img src="/src/<?= $v['img'] ?>" alt="<?= $v['title'] ?>">
        </div>
        <div class="modalCart--info">
            <h1 class="modalCart--title"><a href="/product/<?= $v['alias'] ?>"><?= $v['title'] ?></a></h1>
            <ul>
                <li>Платформа: <?= ucfirst($v['platform']) ?></li>
                <li>Количество: <?= $v['qty'] ?></li>
                <li>Цена: <?= $v['price'] ?><?= $_SESSION['cart.currency']['symbol'] ?></li>
                <li><a id="btnDeleteFromCart" data-platform="<?= $v['platform'] ?>" data-id="<?= $v['id'] ?>" href="#!">Удалить из корзины</a></li>
            </ul>
        </div>            
    </div>
    <?php endforeach; ?>
    </div>
<?php else: ?>
<h3 id="emptyCart" data-res="empty">Корзина пуста</h3>
<?php endif; ?>

<?php 
    if (empty($_SESSION['cart.qty'])): $_SESSION['cart.qty'] = 0; endif;
    if (empty($_SESSION['cart.sum'])): $_SESSION['cart.sum'] = 0; endif;
    if (empty($_SESSION['cart.currency']['symbol'])) : $_SESSION['cart.currency']['symbol'] = ''; endif;
?>
    <div class="modalCart--general">
        <ul>
            <?php if(isset($_SESSION['user']['promo'])): ?>
            <li>Промокод: <span>-<?= $_SESSION['user']['promo'] ?>%</span></li>
            <?php else: ?>
            <li>Промокод: <span>нет</span></li>
            <?php endif; ?>
            <li>Товаров в корзине: <span class="cart-qty"><?= $_SESSION['cart.qty'] ?></span></li>
            <li>Итого: <span class="cart-sum"><?= $_SESSION['cart.sum'] ?><?= $_SESSION['cart.currency']['symbol'] ?></span></li>
        </ul>
    </div>
    <div class="modalCart--controls">
        <?php if ($_SESSION['cart.qty'] > 0): ?>
        <a href="/cart">Оформить заказ</a>
        <a id="btnCartClean" href="#!">Очистить</a>
        <?php endif; ?>
        <a id="btnCartHide" href="#!">Закрыть</a>
    </div>
</div>
</div>