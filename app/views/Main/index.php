<?php 
use app\widgets\discount\Discount;
use app\widgets\product\Product;
use playbuff\Registry;

require_once ROOT . '/app/views/mainSlider.php';
require_once ROOT. '/app/views/searchForm.php';
?>
					
				<section class="main__roulette">
					<h3 class="main__roulette--title titles">Испытай удачу</h3>
					<p class="main__roulette--desc">Выбери один из вариантов рулетки и испытай свою удачу. <br>
					<span>Гарантированные призы от 300 рублей</span></p>
					<div class="main_roulette--boxes">
						<div class="main_roulette--common" id="main_rBox">
							<h4 class="roulette-title commonBx">Common box</h4>
							<img src="./img/loot-box-common.png" width="150" height="150" alt="Common box">
							<p class="boxes--desc">
								Игры от 299 рублей <br>
								<span>Небольшой шанс на выпадение
								дорогостоящей игры</span>
							</p>
							<span class="boxes--price">499 руб.</span>
							<a class="boxes--playBtn" href="/roulette">Играть</a>
						</div>
						<div class="main_roulette--rare" id="main_rBox rareBx">
							<div class="roulette-title rareBx">
								<h4 class="roulette-title--modifier">Legend box</h4>
							</div>
							<img src="./img/loot-box-legend.png" width="150" height="150" alt="Rare box">
							<p class="boxes--desc">
								Игры от 999 рублей <br>
								<span>Высокий шанс на выпадение
								дорогостоящей игры</span>
							</p>
							<span class="boxes--price boxes--price_legend">1299 руб.</span>
							<a class="boxes--playBtn boxes--playBtn_legend" href="/roulette">Играть</a>
						</div>
						<div class="main_roulette--legend" id="main_rBox">
							<h4 class="roulette-title legendBx">Rare box</h4>
							<img src="./img/loot-box-rare.png" width="150" height="150" alt="Rare box">
							<p class="boxes--desc">
								Игры от 699 рублей <br>
								<span>Средний шанс на выпадение
								дорогостоящей игры</span>
							</p>
							<span class="boxes--price">899 руб.</span>
							<a class="boxes--playBtn" href="/roulette">Играть</a>
						</div>
					</div>
				</section>
				<section class="main__games">
					<h3 class="main__games--title titles">Последние релизы</h3>
					<div class="main__games--wrapper">
						<?php
						if (Registry::getProperty("mainPageGames")) {
							foreach (Registry::getProperty("mainPageGames") as $products) {
						
								$price = round($currency['value'] * $products['price'], 2);

								echo "<div class='main__games--card'>
								<a href='/product/". $products['alias'] ."' id='hrefImg'><img class='card--img' src='/src/". $products['main_image'] ."' alt='". $products['keywords'] ."'></a>
								<a href='/product/". $products['alias'] ."' class='card--title'>". $products['title'] ."</a>
								<span class='card--shops'>" . Product::getHtml($products['id'], "platforms") . "</span>
								<span class='card-presence'>" . Product::getHtml($products['id'], "presence", 1) . "</span>
								<span class='card--price'>". Discount::getHtml($price, $products['discount'], $currency['symbol'], $currency['code'], 16). "</span>
								<a class='card--btn' href='/product/". $products['alias'] ."'>Купить</a>
							</div>";	
							}
						}
						?>
					</div>
					<a class="main__games--fullBtn" href="/games">Смотреть полный каталог</a>
				</section>
				<section class="main__news">
					<h3 class="main__news--mainTitle titles">Новости игровой индустрии</h3>
					<div class="main__news--wrapper">
						<?php foreach (Registry::getProperty("main_page_news") as $v): ?>
						<div class="main__news--card">
							<a href="/news/<?= $v['alias'] ?>"><img src="/src/<?= $v['image'] ?>" alt="<?= $v['title_content'] ?>"></a>
							<h4 class="main__news--title"><a href="/news/<?= $v['alias'] ?>"><?= $v['title_content'] ?></a></h4>
							<div class="main__news--newInfo">
								<span class="main__news--date"><?= $v['date'] ?></span>
								<span class="main__news--views"><img src="./icons/eye.svg" alt="visits"><?= $v['visits'] ?></span>
							</div>
						</div>
						<?php endforeach ?>
					</div>
					<a class="main__news--readmoreBtn" href="/news">Смотреть все</a>
				</section>