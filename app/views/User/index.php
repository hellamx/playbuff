<?php 
use playbuff\Registry;
$orders = Registry::getProperty('user.orders');
?>
<div class="main__userAccount">
    <h3 class="username"><?= ucfirst($_SESSION['user']['login']) ?></h3>
    <ul class="listUserdata">
        <li><img src="/icons/user-user.svg" alt="id">Ваш ID: <span> <?= $_SESSION['user']['id'] ?></span></li>
        <li><img src="/icons/user-email.svg" alt="id">Ваш E-mail: <span> <?= $_SESSION['user']['email'] ?></span></li>
        <li><img src="/icons/user-wallet.svg" alt="id">Баланс: <span> <?= $_SESSION['user']['balance'] ?> руб.</span></li>
        <li><a id="userLogoutBtn" href="/user/logout">Выход</a></li>
    </ul>
    <button id="main__userAccount--editBtn">Редактировать</button>
    <div class="userFormWrap">
        <form id="main__userAccountForm" method="post" action="/user/update">
            <input type="text" value="<?= $_SESSION['user']['email'] ?>" placeholder="Новый Email">
            <input type="submit" name="submit" value="Сохранить изменения">
        </form>
    </div>
    <div class="main__userAccount--orders">
        <h3>Последние покупки</h3>
        <?php if($orders[0]): ?>
        <?php foreach($orders[0] as $k => $v): ?>
        <ul class="accountOrders--wrap">
            <li>Номер заказа <span>#<?= $v['id'] ?></span></li>
            <li>Дата: <span><?= $v['date'] ?></span></li>
            <li>Позиции:
                <ul>
                    <?php foreach($orders['titles'][$k] as $key => $value): ?>
                        <li><?= $value ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php if($v['promocode'] != 'нет'): ?>
            <li>Промокод: <span><?= $v['promocode'] ?>%</span></li>
            <?php else: ?>
            <li>Промокод: <span>нет</span></li>
            <?php endif; ?>
            <li>Сумма: <span><?= str_replace(':', ' ', $v['sum']) ?></span></li>
        </ul>
        <?php endforeach; ?>
        <?php else: ?>
        <p>Вы еще не совершали покупки</p>
        <?php endif; ?>
    </div>
</div>
</section>