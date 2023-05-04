<?php

namespace app\controllers;

use playbuff\App;

class MainController extends AppController
{
    public function indexAction ()
    {

        $this->setMeta(SITENAME . " - интернет магазин игровых ключей", 
                      SITENAME . " - интернет магазин игровых ключей для Steam и Origin", 
                      "Игры, Steam, Origin, Игровые ключи");

        App::$app::setProperty("canonical", PATH);

        // получаем последние N продуктов

        $products = \R::find("product", "ORDER BY `id` DESC LIMIT 4");
        App::$app::setProperty("mainPageGames", $products);

        // получаем и кэшируем последние 6 новостей

        $newsCacheKey = "main_page_news";

        if (App::$cache::get($newsCacheKey)) {
            App::$app::setProperty("main_page_news", App::$cache::get($newsCacheKey));
        } else {
            $news = \R::find("news", "ORDER BY `id` DESC LIMIT 6");
            App::$cache::set($newsCacheKey, $news, 300);
            App::$app::setProperty("main_page_news", $news);
        }
    }
}

?>