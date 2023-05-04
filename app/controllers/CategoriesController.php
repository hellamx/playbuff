<?php 

namespace app\controllers;

class CategoriesController extends AppController
{
    public function indexAction()
    {
        redirect("/");
    }

    public function viewAction()
    {
        $category_id = \R::getAll("SELECT * FROM `categories` WHERE `alias` = ?", [$this->route["alias"]]);

        if (!$category_id) {
            throw new \Exception("Страница не найдена", 404);
        }
        
        \playbuff\App::$app::setProperty("categoryTitle", $category_id[0]["title"]);
        $this->setMeta("Раздел " . mb_strtolower($category_id[0]['title']) . " | " . SITENAME, 
                           $category_id[0]['description'], 
                           $category_id[0]['keywords'] . ", Игры, Steam, Origin, Игровые ключи");

        $games = \R::getAll("SELECT * FROM product WHERE `category_id` = ? ORDER BY `id` DESC", [$category_id[0]["id"]]);

        $this->set($games);
    }
}


?>