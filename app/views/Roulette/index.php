<div class="roulette">
    <form action="#" method="post" id="rouletteForm">
        <label for="selectBox">Выберите бокс:</label>
        <select name="selectBox" id="selectBox">
            <option checked value="common">Common box</option>
            <option value="rare">Rare box</option>
            <option value="legend">Legend box</option>
        </select>
    </form>
    <div class="roulette_wrapper">
        <div id="r-item-0" class="item">
            <img src="/src/1.webp" alt="#">
        </div>
        <div id="r-item-1" class="item">
            <img src="/src/1.webp" alt="#">
        </div>
        <div id="r-item-2" class="item">
            <img src="/src/2.webp" alt="#">
        </div>
        <div id="r-item-3" class="item">
            <img src="/src/3.webp" alt="#">
        </div>
        <div id="r-item-4" class="item">
            <img src="/src/4.webp" alt="#">
        </div>
        <div id="r-item-5" class="item">
            <img src="/src/5.webp" alt="#">
        </div>
        <div class="Rloader"></div>
        <div class="Rpreloader">
            <img src="/icons/preloader.svg" alt="Loading">    
        </div>
        <i class='Rloader-lock'></i>
        <div class="roulette--nav">
            <button id="runRoulette">Запустить</button>
            <p>Стоимость <?= \app\controllers\RouletteController::getOnePrice("common") ?> руб.</p>
        </div>
    </div>
</div>
</section>
<div class="blind"></div>