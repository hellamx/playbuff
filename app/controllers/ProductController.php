<?php 

namespace app\controllers;

class ProductController extends AppController
{

    public function viewAction()
    {
        $alias = dataClear($this->route["alias"]);
        $product = \R::findOne("product", "alias = ?", [$alias]);

        if ($product) {
            $this->setMeta($product['title'] . " | " . SITENAME, 
                           $product['description'], 
                           $product['keywords'] . ", Игры, Steam, Origin, Игровые ключи");

            \playbuff\App::$app::setProperty("gameInfo", $product);
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
        //debug($product);

        // рекомендации
        $related = \R::getAll("SELECT * FROM reference 
                               JOIN product ON product.id = reference.related_id 
                               WHERE reference.product_id = ? 
                               ORDER BY product.id DESC 
                               LIMIT 4", [$product['id']]);

        $this->set($related);

        // секция просмотренных недавно товаров

        $p_model = new \app\models\Product();
        $p_model->setRecentlyViewed($product['id']);

        $viewed = $p_model->getRecentlyViewed();
        $r_viewed = null;

        if ($viewed) {
            $r_viewed = \R::find('product', 'id IN (' . \R::genSlots($viewed) . ') LIMIT 4', $viewed);
        }
        
        \playbuff\App::$app::setProperty("recentlyProducts", $r_viewed);

        // хлебные крошки

        $breadCrumbs = \app\models\Breadcrumbs::getCrumbs($product["category_id"], $product["title"], $this->route);
        \playbuff\App::$app::setProperty("breadCrumbs", $breadCrumbs);
    }

}

?>