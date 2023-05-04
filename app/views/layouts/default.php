<?php 
use playbuff\Registry;
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
        <?= $meta ?>
		<?php if(!empty(Registry::getProperty("canonical"))): ?>
		<link rel="canonical" href="<?= Registry::getProperty("canonical") ?>" />
		<?php endif; ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
   		<link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    	<link rel="stylesheet" href="/css/style.css">
    	<link rel="stylesheet" href="/css/mobile.css">
	</head>
	<body>	
		<div class="wrapper">
			<header class="header">
				<div class="header__container">
					<div class="header__logo">
						<a href="/">PlayBuff . ru</a>
					</div>
					<nav class="header__nav">
						<button onclick="hamburger_nav(1)" id="header__nav--mobile">Меню</button>
						<ul id="header__nav--mobile_version">
							<li><a href="/">Главная</a></li>
							<li><a href="/games">Все игры</a></li>
							<li><a href="/promotions">Акции</a></li>
							<li><a href="/roulette">Рулетка</a></li>
							<li><a href="/news">Новости</a></li>
							<li><a onclick="hamburger_nav(2)" id="closeBtn" href="#">Закрыть меню</a></li>
						</ul>
						<ul id="header__nav--response">
							<li><a href="/">Главная</a></li>
							<li><a href="/games">Все игры</a></li>
							<li><a href="/promotions">Акции</a></li>
							<li><a href="/roulette">Рулетка</a></li>
							<li><a href="/news">Новости</a></li>
						</ul>
					</nav>
				</div>
			</header>
			<?php 
			if(isset($_SESSION['alert'])){ 
				echo $_SESSION['alert'];
				unset($_SESSION['alert']);	
			}
			?>
			<main class="main">
				<?php if ($this->controller == "Product"): ?>

				<?php echo Registry::getProperty("breadCrumbs") ?>
				
				<?php endif; ?>
				<section class="main__view">
					<button onclick="showCategories()" id="main__view--navbtn">Категории</button>
					<div id="main__navbar--mobile" style="min-width:200px" class="main__navbar">
						<ul>
							<li id="main__navbar--title">Категории</li>
							<?php
							if (!empty(Registry::getProperty("categories"))) {
								foreach (Registry::getProperty("categories") as $category) {
									echo "<li><a href=/categories/" . $category["alias"] . ">" . $category["title"] . "</a></li>";
								}
							} else {
								echo "Категории отсутствуют";
							}
							?>
						</ul>
						<ul id="main__navbar--user">
							<?php if(empty($_SESSION['user'])): ?>
								<li><a href="/user/login">Авторизация</a></li>
								<li><a href="/user/signup">Регистрация</a></li>
							<?php else: ?>
								<li style="font-size: 14px; color: #747474"><?= ucfirst($_SESSION['user']['login']) ?></li>
								<li style="font-size: 14px; color: #747474">Баланс: <span id="user--balance"><?= $_SESSION['user']['balance'] ?></span> руб.</li>
								<li><a href="/user">Аккаунт</a></li>
								<li><a href="/user/getbalance">Пополнить баланс</a></li>
							<?php endif; ?>

							<?php if (isset($_SESSION['cart.qty'])): ?>
							<li><a href="/cart">Корзина <span data-counter="<?= $_SESSION['cart.qty'] ?>" id="cartCounter">(<?= $_SESSION['cart.qty'] ?>)</span></a></li>
							<?php else: ?>
								<li><a href="/cart">Корзина <span data-counter="0" id="cartCounter">(0)</span></a></li>
							<?php endif; ?>
							<div class="currency_widget">
								<form action="/currency/change" method="post">
									<select name="currencyChange" id="currency">
										<?php 
											new \app\widgets\currency\Currency();
										?>
									</select>
									<input type="submit" value="Изменить">
								</form>
								<p class="currency__value">1 usdt = <b><?= Registry::getProperty("currencyExchange") ?></b> рублей <br> (Binance P2P)</p>
							</div>
						</ul>
					</div>
					
				<?= $content ?>
				<section class="main__howWorks">
					<h3 class="main__howWorks--title titles">Как мы работаем</h3>
					<div class="main__howWorks--wrapper">
						<div class="howWorks--info">
							<img src="/icons/works-1.svg" alt="works-ico">
							<span>Выбираете игру и игровой интернет-магазин</span>
						</div>
						<div class="howWorks--arrow">
							<img src="/icons/arrow.svg" alt="arrow">
						</div>
						<div class="howWorks--info">
							<img src="/icons/works-2.svg" alt="works-ico">
							<span>Указываете свой E-mail адрес и оплачиваете</span>
						</div>
						<div class="howWorks--arrow">
							<img src="/icons/arrow.svg" alt="arrow">
						</div>
						<div class="howWorks--info">
							<img src="/icons/works-3.svg" alt="works-ico">
							<span>После подтверждения оплаты к вам на почту будет отправлено письмо с ключом активации игры</span>
						</div>
					</div>
				</section>
				<section class="main__payments">
					<h3 class="main__payments--title titles">Способы оплаты</h3>
					<div class="main__payments--wrapper">
						<img class="payments--ms" src="/icons/mastercard.svg" alt="Mastercard">
						<img class="payments--vs" src="/icons/visa.svg" alt="Visa">
						<img class="payments--btc" src="/icons/bitcoin.svg" alt="Bitcoin">
						<img class="payments--usdt" src="/icons/tether.svg" alt="Tether">
						<img class="payments--qiwi" src="/icons/qiwi.svg" alt="Qiwi">
					</div>
				</section>
			</main>
			<footer class="footer">
				<div class="footer__wrapper">
					<h6 class="footer__copyright">&copy; PlayBuff.ru &mdash; <?= date("Y") ?></h6>
					<span class="footer__mail">support@playbuff.ru</span>
				</div>
			</footer>
		</div>
		<div class="modalErrors"></div>
		<div class="modalCart" id="cartModal">
			<a href="/cart/show" onclick="displayCart(); return false;" id="btnShowCartModal"><span>Корзина товаров</span><img src="/icons/cart.svg" alt="Корзина товаров"></a>
		</div>
		<div class="preloader">
			<img src="/icons/preloader.svg" alt="Preloader">
		</div>
		<script>
			var path = "<?= PATH ?>";
		</script>
		<script src="/js/jquery-3.6.3.min.js"></script>

		<?php if ($this->controller == "Product"): ?>
		<script src='/js/gallery.js'></script>		
		<?php elseif($this->controller != "Cart" && $this->controller != "Roulette"): ?>
		<script src='/js/slider.js'></script>
		<?php endif; ?>
		<?php if($this->controller == 'Roulette'): ?>
		<script src="/js/roulette.js"></script>
		<?php endif; ?>
		<script src="/js/typeahead.js"></script>
		<script src="/js/nav.js"></script>
		<script src="/js/main.js"></script>
	</body>

</html>