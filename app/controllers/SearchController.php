<?php

namespace app\controllers;

use playbuff\App;

class SearchController extends AppController 
{
    public function indexAction()
    {
        $this->setMeta("Результаты поиска | " . SITENAME);
        if (!empty(dataClear($_GET['s'])) && isset($_GET['s'])) {
            $query = dataClear($_GET['s']);
        } else {
            $query = null;
        }

        $userQuery = dataClear($_GET['s']);

        if($query) {
            $products = \R::find('product', "title LIKE ?", ["%{$query}%"]);
            $this->set($products);
        }
        
        App::$app::setProperty("searchQuery", $userQuery);
    }

    public function resultsAction()
    {
        if($this->isAjax()) {
            $query = !empty(dataClear($_GET['query'])) ? dataClear($_GET['query']) : null;
            if ($query) {
                $products = \R::getAll("SELECT id, title FROM product WHERE title LIKE ? LIMIT 5", ["%{$query}%"]);
                echo json_encode($products);
            }
        }

        die;
    }
}


?>