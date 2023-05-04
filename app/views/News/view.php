<?php
use playbuff\Registry;
$data = Registry::getProperty("articleInfo");
?>

<div class="main__product--info">
    <img id="articlePageImg" src="/src/<?= $data['image'] ?>" alt="<?= $data['title_content'] ?>">
	<h1 class="news__info--title"><?= $data['title_content'] ?></h1>
	<p class="product__info--desc">
		<?= $data['content'] ?>
	</p>
	<div class="page__news--newInfo">
		<span class="main__news--date"><?= $data['date'] ?></span>
		<span class="main__news--views"><img src="/icons/eye.svg" alt="visits"><?= $data['visits'] ?></span>
	</div>
    <a id="articleBackBtn" href="/">На главную страницу</a>
	<?php if(Registry::getProperty("recentNews")): ?>
	<div class="page__news--recents">
		<h4 class="page__news--title">Смотрите также: </h4>
		<ul>
			<?php foreach(Registry::getProperty("recentNews") as $k => $v): ?>
			<li><a href="/news/<?= $v['alias'] ?>"><?= $v['title_content'] ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
</div>
</section>