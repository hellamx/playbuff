<?php use playbuff\Registry; ?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= $meta ?>
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
			<main class="main">
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
								<li style="font-size: 14px; color: #747474">Баланс: <?= $_SESSION['user']['balance'] ?> руб.</li>
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
			</main>
			<footer class="footer">
				<div class="footer__wrapper">
					<h6 class="footer__copyright">&copy; PlayBuff.ru &mdash; <?= date("Y") ?></h6>
					<span class="footer__mail">support@playbuff.ru</span>
				</div>
			</footer>
		</div>
		<script src="/js/jquery-3.6.3.min.js"></script>
		<script>
			var path = "<?= PATH ?>";
		</script>
		<?php if($this->route['action'] == "signup"): ?>
		<script src="/js/signup.js"></script>
		<?php else: ?>
		<script src="/js/login.js"></script>
		<?php endif; ?>
		<script src="/js/nav.js"></script>
	</body>
</html>