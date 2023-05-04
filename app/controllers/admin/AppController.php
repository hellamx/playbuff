<?php 

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\User;
use app\models\admin\Admin;

class AppController extends \playbuff\base\Controller 
{
    public $layout = 'admin';
    
    public function __construct($route)
    {
        parent::__construct($route);
        if(!isset($_SESSION['user']) || !User::isAdmin()) throw new \Exception("Страница не найдена", 404); 

        new AppModel();
        
        Admin::getStat();
    }
}


?>