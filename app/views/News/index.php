<?php 
require_once ROOT . '/app/views/mainSlider.php';

use playbuff\App;
?>
<section class="main__news">
	<h3 style="margin-top: 40px" class="main__news--mainTitle titles">Новости игровой индустрии</h3>
    <?php if(isset($data)): ?>
        <div class="main__news--wrapper">
        <?php foreach($data as $v): ?>
                <div class="main__news--card">
                    <a href="/news/<?= $v['alias'] ?>"><img src="/src/<?= $v['image'] ?>" alt="<?= $v['title_content'] ?>"></a>
                    <h4 class="main__news--title"><a href="/news/<?= $v['alias'] ?>"><?= $v['title_content'] ?></a></h4>
                        <div class="main__news--newInfo">
                            <span class="main__news--date"><?= $v['date'] ?></span>
                            <span class="main__news--views"><img src="./icons/eye.svg" alt="visits"><?= $v['visits'] ?></span>
                        </div>
                </div>
        <?php endforeach; ?>
        </div>
        
        <?php if(App::$app::getProperty("newsPagination")): ?>
            <div class="main__games--pagination">
                <ul>
                    <?= App::$app::getProperty("newsPagination") ?>
                </ul>
            </div>
        <?php endif ?>

    <?php else: ?>
    <h4>Новостей нет</h4>
    <?php endif;?>
</section>