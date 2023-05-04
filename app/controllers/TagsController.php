<?php 

namespace app\controllers;

class TagsController extends AppController
{
    public function viewAction()
    {
        $dataSql = htmlspecialchars(trim($this->route["alias"]));
        $tag_id = \R::getAll("SELECT * FROM `tags` WHERE `alias` = ?", [$dataSql]);
  
        if (!$tag_id) {
            throw new \Exception("Страница не найдена", 404);
        }
        
        \playbuff\App::$app::setProperty("tagTitle", $tag_id[0]["title"]);
        $this->setMeta("тег #" . $tag_id[0]['title'] . " | " . SITENAME);

        $games = [];
        foreach($tag_id as $k => $v) {
            $data = \R::findOne("product", "id = ?", [$v['game_id']]);
            $games[$k] = $data;
        }

        $this->set($games);
    }
}

?>