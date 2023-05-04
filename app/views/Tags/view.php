<?php 
    use app\widgets\product\Product;
    use app\widgets\discount\Discount;
    require_once ROOT . '/app/views/mainSlider.php';

?>
<section style="margin-top: 40px" class="main__games">
					<h3 class="main__games--title titles">тег #<?= \playbuff\App::$app::getProperty("tagTitle") ?></h3>
					<div class="main__games--wrapper">
						<?php
                        if ($data){
							foreach ($data as $k => $v) {

								$price = round($currency['value'] * $v['price'], 2);

								echo "<div class='main__games--card'>
								<a href='/product/". $v['alias'] ."' id='hrefImg'><img class='card--img' src='/src/". $v['main_image'] ."' alt='". $v['keywords'] ."'></a>
								<a href='/product/". $v['alias'] ."' class='card--title'>". $v['title'] ."</a>
								<span class='card--shops'>" . Product::getHtml($v['id'], "platforms") . "</span>
								<span class='card-presence'>" . Product::getHtml($v['id'], "presence", 1) . "</span>
								<span class='card--price'>". Discount::getHtml($price, $v['discount'], $currency['symbol'], $currency['code'], 20). "</span>
								<a class='card--btn' href='/product/". $v['alias'] ."'>Купить</a>
							</div>";	
							}
                        } else {
                            echo "<h3>Каталог пуст</h3>";
                        }
					
						?>
					</div>
				</section>