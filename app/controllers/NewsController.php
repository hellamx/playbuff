<?php 
    namespace app\controllers;

    use playbuff\App;
    use app\models\Pagination;

    class NewsController extends AppController
    {
        public function indexAction()
        {
            $this->setMeta("Новости игровой индустрии | " . SITENAME);

            // pagination 

            $total = \R::count("news");

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $pagination = new Pagination($page, NEWS_PERPAGE, $total);

            $start = $pagination->getStart();
            
            App::$app::setProperty("newsPagination", $pagination);

            $news = \R::findAll("news", "ORDER BY id DESC LIMIT {$start}, " . NEWS_PERPAGE);
            $this->set($news);
        }

        public function viewAction() 
        {
            $alias = dataClear($this->route["alias"]);
            $article = \R::findOne("news", "alias = ?", [$alias]);
            $recents = \R::findAll("news", "ORDER BY id DESC LIMIT 3"); 

            if ($article) {
                $this->setMeta($article['title_content'] . " | " . SITENAME, 
                            $article['content'], 
                            $article['title_content'] . ", Игры, Steam, Origin, Игровые ключи");

                App::$app::setProperty("articleInfo", $article);

                if ($recents): App::$app::setProperty("recentNews", $recents); endif;

                $counter = \R::load('news', $article['id']);
                $counter->visits = $article['visits'] + 1; 
                \R::store($counter);
            
            } else {
                throw new \Exception("Страница не найдена", 404);
            }
        }
    }

?>