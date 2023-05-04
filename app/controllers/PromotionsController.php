<?php 

namespace app\controllers;

use playbuff\App;

class PromotionsController extends AppController
{
    public function indexAction()
    {
        $this->setMeta("Игры со скидкой | " . SITENAME);
        App::$app::setProperty("canonical", PATH . '/promotions');

        $games = \R::getAll("SELECT * FROM `product` WHERE `discount` > 0");
        $this->set($games);

    }
}

?>