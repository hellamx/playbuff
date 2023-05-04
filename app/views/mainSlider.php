<?php 
use app\widgets\discount\Discount;
use app\widgets\product\Product;
use playbuff\Registry;
?>
<div class="main__slider">
	<div class="main__slider--pgame">
		<div class="slide">
			<?php
				if (!empty(Registry::getProperty("hits"))) {
					$currency = \playbuff\App::$app->getProperty("currency");
										
                    foreach (Registry::getProperty("hits") as $hits) {

						$price = round($currency['value'] * $hits['price'], 2);

						echo "<div class='slide-content fade'>
							    <div class='slide-img'>
									<a href='/product/". $hits['alias'] ."'><img src='/src/". $hits['main_image'] ."' width='270' alt='". $hits['description'] ."'></a>
								</div>
								<div class='slide-name'>
									<h3 id='hitTag'><img src='/icons/heart.svg' alt='popular' width='24' height='24'><b>Популярное</b></h3>
									<a class='main__slider--gameName' href='/product/". $hits['alias'] ."'>". $hits['title'] ."</a>
									<p>". $hits['content'] ."</p>
									<a href='/product/". $hits['alias'] ."' class='main__slider--descLink'>Читать описание</a>
									<span class='main__slider--stores'>". Product::getHtml($hits['id'], "platforms") ."</span></span>
									<b>". Product::getHtml($hits['id'], "presence", 1) ."</b>
									<span class='main__slider--price'>". Discount::getHtml($price, $hits['discount'], $currency['symbol'], $currency['code'], 20, "Актуальная цена"). " </span>
									<div class='slider--controlls'>
										<a id='sliderControls' class='main__slider--card next' onclick='swapSlide(-1)' href='#!'>&#10094</a>
										<a class='main__slider--buy buyBtn' href='/product/". $hits['alias'] ."'>Купить</a>
										<a id='sliderControls' class='main__slider--card next' onclick='swapSlide(+1)' href='#!'>&#10095</a>
									</div>
								</div>
							</div>";
					}
				} else {
					echo "Популярных продуктов не найдено";
				}
								
				?>
		</div>
	</div>
</div>
</section>