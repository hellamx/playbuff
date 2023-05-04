<?php

namespace app\controllers;

use app\models\Pagination;
use playbuff\App;

class GamesController extends AppController
{
    public function indexAction()
    {
        $this->setMeta("Каталог игр | " . SITENAME);
        App::$app::setProperty("canonical", PATH . '/games');

        // filters

        $filter = "id";
        $category = false;
        $price = false;
        $sort = 'ASC';

        $filter_validate = ['max', 'min'];
        $category_validate = \R::getCol("SELECT id FROM categories");
        
        $sql_part = '';
        
        if (!empty($_GET['filter']) or !empty($_GET['category']) or !empty($_GET['price'])) {
            if (isset($_GET['filter']) && in_array($_GET['filter'], $filter_validate)) $filter = dataClear($_GET['filter']);
            if (isset($_GET['category']) && in_array($_GET['category'], $category_validate)) $category = dataClear($_GET['category']);
            if (isset($_GET['price'])) $price = (int)dataClear($_GET['price']);

            if (!$price) throw new \Exception("Страница не найдена", 404);
        }

        if ($filter == 'id') $sort = "DESC";
        if ($filter == 'min' or $filter == 'max') {
            if ($filter == 'min') {
                $sort = 'ASC';
            } else {
                $sort = 'DESC';
            }
            $filter = 'price';
        }

        if ($category) $sql_part .= "WHERE category_id = {$category} ";
        if ($category && $price) $sql_part .= "AND price >= {$price} ";
        if (!$category && $price) $sql_part .= "WHERE price >= {$price} ";

        $sql_part .= "ORDER BY {$filter} {$sort}";

        // pagination 

        $total = \R::count("product", "{$sql_part}");

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Pagination($page, GAMES_PERPAGE, $total);

        $start = $pagination->getStart();
        
        App::$app::setProperty("gamesPagination", $pagination);

        // sql sort
        $products = \R::findAll("product", "$sql_part LIMIT {$start}, " . GAMES_PERPAGE);

        if ($this->isAjax()) {
            $this->loadView('filter', compact('products', 'total', 'pagination', 'perpage'));
            die;
        }

        $this->set($products);


    }
}

?>