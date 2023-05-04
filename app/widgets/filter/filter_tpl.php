<?php use app\widgets\filter\Filter; ?>
<div class="filters">
			<form action="#">
				<div class="filter-item">
					<label for="filter-price">Цена:</label>
					<select name="priceSort" id="filter-price">
						<?php if(isset($_GET['filter']) && ($_GET['filter'] == 'max' || $_GET['filter'] == 'min')): ?>
							<?php if($_GET['filter'] == 'max') echo '<option disabled selected value="max">По убыванию</option>'; ?>
							<?php if($_GET['filter'] == 'min') echo '<option disabled selected value="min">По возрастанию</option>'; ?>
						<?php else: ?>
						<option disabled selected value="none">Не выбрано</option>
						<?php endif; ?>
						<option value="min">По возрастанию</option>
						<option value="max">По убыванию</option>
					</select>
				</div>
				<div class="filter-item">
					<label for="filter-range">Ценовой диапазон:</label>
					<div class="filter-range">
						<div class="range-wrap">
							<?php 
								$current_range = Filter::getMinPrice()['price'];
								if (isset($_GET['price']) && $_GET['price'] != 'false') $current_range = dataClear($_GET['price']);
 							?>
							<span class="minRange"><?= Filter::getMinPrice()['price']; ?> р.</span>
							<input id="range" type="range" min="<?= Filter::getMinPrice()['price']; ?>" max="<?= Filter::getMaxPrice()['price']; ?>" step="1" value="<?= $current_range ?>"> 
							<span class="maxRange"><?= Filter::getMaxPrice()['price']; ?> р.</span>
						</div>
						<input type="text" name="price" id="price-current" placeholder="Цена" value="<?= $current_range ?>">
					</div>
				</div>
				<div class="filter-item">
					<label for="filter-category">Категория: </label>
					<select name="category" id="filter-category">
						<?php if (isset($_GET['category']) && $_GET['category'] != 'false'): ?>
							<option value="all">Все категории</option>
							<?php
							foreach (\playbuff\App::$app::getProperty("categories") as $v) {
								if ($v['id'] == $_GET['category']) echo '<option selected value="' . $v['id'] . '">' . $v['title'] . '</option>';
							}
							?>
						<?php else: ?>
						<option selected value="false">Не выбрано</option>
						<?php endif; ?>

						<?php foreach(\playbuff\App::$app::getProperty("categories") as $v): ?>
							<option value="<?= $v['id'] ?>"><?= $v['title'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</form>
		</div>