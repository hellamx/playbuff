<?php

use playbuff\App;
use app\widgets\product\Product;
use app\widgets\discount\Discount;

?>
<div class="main__games--wrapper">
			<?php
            $currency = \app\widgets\currency\Currency::getCurrency(App::$app->getProperty("currencies"));
            if ($products){
				foreach ($products as $k => $v) {
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
					<?php if($pagination && $total > GAMES_PERPAGE): ?>
					<div class="main__games--pagination">
						<ul>
							<?= $pagination ?>
						</ul>
					</div>
					<?php endif ?>