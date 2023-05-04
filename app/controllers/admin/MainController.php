<?php 

namespace app\controllers\admin;

use app\models\admin\Admin;

class MainController extends AppController
{
    public function indexAction() 
    {
        $this->setMeta('Административная панель | Playbuff');

        \playbuff\Registry::setProperty("admin.settings", Admin::getSettings());
    }
}

?>