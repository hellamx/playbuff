<?php

namespace app\controllers\admin;

use app\models\admin\Admin;

class KeysController extends AppController
{
    public function indexAction()
    {
        $this->setMeta("Игровые ключи");

        $total = \R::count("game_keys");

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 9;
        $pagination = new \app\models\Pagination($page, $perpage, $total, true);

        $start = $pagination->getStart();
        
        \playbuff\App::$app::setProperty("admin.keysPagination", $pagination);

        $keys = \R::getAll("SELECT game_keys.id as k_id, game_keys.platform as k_platform, game_keys.game_key as k_key, product.title, product.id FROM game_keys INNER JOIN product ON game_keys.game_id = product.id
        ORDER BY game_keys.id DESC LIMIT {$start}, $perpage");
        $this->set($keys);

        if(isset($_GET['delete'])) {
            $delete_id = (int)dataClear($_GET['delete']);
            if (Admin::delete('game_keys', $delete_id)) {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Ключ успешно удален</strong>
                                            </div>';
            }
            redirect('/admin/keys');
        }
    }

    public function addAction()
    {
        $this->setMeta("Добавить ключ");
        $keys = \R::getAll("SELECT id, title FROM product");
        
        $this->set($keys);

        if($_POST) {
            $game_id = dataClear($_POST['id']);
            $platform = dataClear($_POST['platform']);
            $key = dataClear($_POST['key']);

            if (mb_strlen($key) < 5) {
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Некорректный ключ</strong>
                                            </div>';
                redirect('/admin/keys/add');
            } 

            if(\R::exec("INSERT INTO game_keys (game_id, platform, game_key) VALUES (?, ?, ?)", [$game_id, $platform, $key])) {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Ключ успешно добавлен</strong>
                                            </div>';
                redirect('/admin/keys/add');
            } else {
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Неизвестная ошибка при сохранении</strong>
                                            </div>';
                redirect('/admin/keys/add');
            }
        }
    }

}


?>