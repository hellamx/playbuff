<div class="main__cart">
						<div class="notifyField">
							<?php if(isset($_SESSION['alert'])): ?>
									<span><? echo $_SESSION['alert']; unset($_SESSION['alert']); ?></span>
								
							<?php endif; ?>
						</div>
						<h3 class="main__cart--title">Корзина товаров</h3>
                        <?php if (isset($_SESSION['cart']) and !empty($_SESSION['cart'])): ?>
                        <?php foreach($_SESSION['cart'] as $k => $v): ?>
						<div class="main__cart-wrapper">
							<div class="cart__content">
								<div class="cart__content--product">
									<img src="/src/<?= $_SESSION['cart'][$k]['img'] ?>" alt="<?= $_SESSION['cart'][$k]['title'] ?>">
									<div class="cart__content--desc">
										<h4 class="cart__content--name"><a href="/product/<?= $_SESSION['cart'][$k]['alias'] ?>"><?= $_SESSION['cart'][$k]['title'] ?></a></h4>
										<span class="cart__content--presence">Количество: <span id="qtyCounter"><?= $_SESSION['cart'][$k]['qty'] ?></span></span>
										<span class="cart__content--shop">Для <b><?= ucfirst($_SESSION['cart'][$k]['platform']) ?></b></span>
										<span class="cart__content--price">Сумма: <?= $_SESSION['cart'][$k]['price']*$_SESSION['cart'][$k]['qty'] . $_SESSION['cart.currency']['symbol'] ?></span>
									</div>
								</div>
								<div class="cart__content--nav">
									<button id="btnDeleteFromCart" data-platform="<?= $_SESSION['cart'][$k]['platform'] ?>" data-id="<?= $_SESSION['cart'][$k]['id'] ?>" class="cart__content--delete btnDeleteFromCartPage">Удалить из корзины</button>
								</div>
							</div>
						</div>
                        <?php endforeach; ?>
						<?php if(!isset($_SESSION['user']['promo']) && isset($_SESSION['user'])): ?>
						<form id="getPromocode" method="post" action="/cart/promocode">
							<input type="text" name="promocode" placeholder="Промокод">
							<input type="submit" value="Применить">
						</form>
						<?php endif; ?>
						<div class="offerData">
							<ul>
								<?php if(isset($_SESSION['user']['promo'])): ?>
								<li>Промокод: <span><?= $_SESSION['user']['promo'] ?>%</span></li>
								<?php else: ?>
								<li>Промокод: <span>нет</span></li>
								<?php endif; ?>
								<li>Общее количество товаров: <span><?= $_SESSION['cart.qty'] ?></span></li>
								<?php if(isset($_SESSION['user']['promo'])): ?>
								<li>Итоговая сумма: <span><s><?= $_SESSION['cart.oldsum'] . $_SESSION['cart.currency']['symbol'] ?></s> <?= $_SESSION['cart.sum'] . $_SESSION['cart.currency']['symbol'] ?></span></li>
								<?php else: ?>
								<li>Итоговая сумма: <span><?= $_SESSION['cart.sum'] . $_SESSION['cart.currency']['symbol'] ?></span></li>
								<?php endif; ?>
							</ul>
						</div>
						
						<?php if(isset($_SESSION['user'])): ?>
						<form id="payMethodForm" method="post" action="/cart/checkout">
							<label for="pay_method">Способ оплаты:</label>
							<select name="pay_method">
								<option value="balance">Баланс аккаунта</option>
								<option value="card">Карта или электронные кошельки</option>
								<option value="crypto">Криптовалюта</option>
							</select>
                        	<input type="submit" name="submit" id="btnGetOrder" value="Оформить заказ">
						</form>
    					<p style="margin-top:10px" class="signup__alert">*Может взиматься комиссия банком</p>
    					<p class="signup__alert">*При оплате в USDT итоговая сумма может измениться из-за волатильности курса</p>
                        <?php else: ?>
						<span id="orderAuth">Для оформления заказа необходимо <a href="/user/signup">зарегистрироваться</a></span>
						<?php endif; ?>	

						<?php else: ?>
                        <div class="main__cart-wrapper">
							<div class="cart__content">
								<div class="cart__content--product">
                                    <span>Корзина пуста</span>
								</div>
							</div>
						</div>
                        <?php endif; ?>
					</div>
				</section>