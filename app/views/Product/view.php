<?php 
use playbuff\App;
use app\widgets\discount\Discount;
use app\widgets\gallery\Gallery;
use app\widgets\product\Product;
use app\widgets\tags\Tags;
use playbuff\Registry;

$currency = App::$app->getProperty("currency");
$product = App::$app::getProperty("gameInfo");

$price = round($currency['value'] * $product['price'], 2);
$photos = Gallery::getPhotos($product['id']);


Tags::getHtml($product["id"]);



?>
<div class="main__slider">
	<h3 class="product__slide--title">Галерея</h3>
	<div class="main__product--wrapper">
	<?php if ($photos): ?>
		<div class="product__slide">
			<?php 
			foreach ($photos as $value) {
			echo "<div class='product__slide--content fade'>
					<img id='gallery-img' src='/src/". $value['src'] ."' onclick='swapSlide(-1)' alt='" . $value['alt'] . "'>
					</div>";
			}
			?>
		</div>
		<div class="slider-dots">
			<?php
			$i = 1;
			foreach ($photos as $value) {
				echo "<img src='/src/". $value['src'] . "' class='preload--sliderImg' onclick='currentSlide({$i})' alt='" . $value['alt'] . "'>";
				$i++;
			}
			?>
		</div>
	<?php endif; ?>
	<?php if (!$photos) { echo "<h4>Фотографии отсутствуют</h4>"; } ?>
	</div>
	<div class="main__product--info">
		<h1 class="product__info--title"><?= $product["title"] ?></h1>
		<?= Tags::getHtml($product["id"]) ?>
		<p class="product__info--release">Дата выхода: <b><?= $product["release_date"] ?></b></p>
		<p class="product__info--desc">
			<?= $product["content"] ?>
		</p>
		<span class="product__info--presence"><b><?= Product::getHtml($product['id'], "platforms") ?></b></span>
		<span class="product__info--shops"><b><?= Product::getHtml($product['id'], "presence", 1) ?></b></span>
		<?php if(Product::checkPlatforms($product['id'])): ?>
			<div class="productOptions">
				<div class="quantity">
					<label for="quantity">Количество:</label>
					<input type="number" size="4" value="1" name="quantity" min="1" step="1">
				</div>
				<div class="quantity platformSelect">
					<label for="platformSelect">Платформа:</label>
					<select name="platformSelect">
						<option value="steam">Steam</option>
						<option value="origin">Origin</option>
					</select>
				</div>
			</div>
		<?php endif; ?>
		<?php if(Product::checkPlatforms($product['id'])): ?>
		<span class="product__info--price"><?= Discount::getHtml($price, $product['discount'], $currency['symbol'], $currency['code'], 20) ?></span>
		<a class="product__info--btn add-to-cart" data-id=<?= $product['id'] ?> href="/cart/add?=<?= $product['id']?>">Добавить в корзину</a>
		<?php else: ?>
		<span class="product__info--price"><?= Discount::getHtml($price, $product['discount'], $currency['symbol'], $currency['code'], 20) ?></span>
		<form id="waitlist" action="#">
			<input type="text" name="waitlist-email" placeholder="E-mail">
			<input class="product__info--btn"  type="submit" name="waitlist-submit" value="Уведомить о поступлении">
		</form>
		<?php endif; ?>
	</div>
</div>
</section>
<?php require_once ROOT. '/app/views/searchForm.php' ?>

<?php if($data): ?>

<section class="main__games main__recommendations">
	<h3 class="main__games--title titles title--recomm">Рекомендуем</h3>
	<div class="main__games--wrapper">
		<?php 
		foreach($data as $value) {
			$price = round($currency['value'] * $value['price'], 2);
			echo "<div class='main__games--card'>
					<a href='/product/" . $value['alias'] . "' id='hrefImg'><img class='card--img' src='/src/" . $value['main_image'] . "' alt='Grand Theft Auto 5'></a>
					<a href='/product/" . $value['alias'] . "' class='card--title'>" . $value['title'] . "</a>
					<span class='card--shops'>" . Product::getHtml($value['id'], "platforms") . "</span>
					<span class='card-presence presence--many'>" . Product::getHtml($value['id'], "presence", 1) . "</span>
					<span class='card--price'>" . Discount::getHtml($price, $value['discount'], $currency['symbol'], $currency['code'], 20) . "</span>
					<a  class='card--btn' href='/product/" . $value['alias'] . "'>Подробнее</a>
				</div>";
		}
		?>
	</div>
</section>

<?php endif; ?>

<?php if (Registry::getProperty("recentlyProducts") != null): ?>
<section class="main__games main__recommendations">
	<h3 class="main__games--title titles recentlyViewedTitle">Недавно просмотренные</h3>
	<div class="main__games--wrapper">
		<?php 
			foreach(Registry::getProperty("recentlyProducts") as $value) {
				$price = round($currency['value'] * $value['price'], 2);
				echo "<div class='main__games--card'>
					<a href='/product/" . $value['alias'] . "' id='hrefImg'><img class='card--img' src='/src/" . $value['main_image'] . "' alt='" . $value['title'] . "'></a>
					<a href='/product/" . $value['alias'] . "' class='card--title'>" . $value['title'] . "</a>
					<span class='card--shops'>" . Product::getHtml($value['id'], "platforms") . "</span>
					<span class='card-presence presence--many'>" . Product::getHtml($value['id'], "presence", 1) . "</span>
					<span class='card--price'>" . Discount::getHtml($price, $value['discount'], $currency['symbol'], $currency['code']) . "</span>
					<a  class='card--btn' href='/product/" . $value['alias'] . "'>Подробнее</a>
				</div>";
			}
		?>
	</div>
</section>
<?php endif; ?>
<?php //debug($_SESSION) ?>