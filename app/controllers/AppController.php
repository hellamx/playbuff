<?php

namespace app\controllers;

use app\models\AppModel;
use playbuff\App;
use app\widgets\currency\Currency;
use app\widgets\categories\Categories;
use Exception;

class AppController extends \playbuff\base\Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel;

        // Получение курса валют с API, обновление и кэширование
        App::$app->setProperty("currencies", Currency::getCurrencies());
        App::$app->setProperty("currency", Currency::getCurrency(App::$app->getProperty("currencies")));
        
        try {
            Currency::updateExchangeRate();
        } catch(Exception $e) {
           echo "Нет обновлений по курсу валют ({$e})";
        }
        
        // Создание виджета категорий и кэширование
        new Categories();
        
        $hitsCacheKey = "hits_slider";

        if (App::$cache::get($hitsCacheKey)) {
            App::$app::setProperty("hits", App::$cache::get($hitsCacheKey));
        } else {
            $hits = \R::find("product", "hit = '1' ORDER BY `id` DESC LIMIT 5");
            App::$cache::set($hitsCacheKey, $hits);
            App::$app::setProperty("hits", $hits);
        }

        // Получение и запись в регистр тегов 
        App::$app::setProperty("tags", \R::findAll('tags'));
    }
}

?>