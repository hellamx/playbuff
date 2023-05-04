<?php 

namespace app\controllers\admin;

use app\models\admin\Admin;

class OrderController extends AppController 
{
    public function indexAction()
    {
        $this->setMeta("Страница заказов");

        // Получение заказов и пагинация

        $total = \R::count("order");

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 9;
        $pagination = new \app\models\Pagination($page, $perpage, $total, true);

        $start = $pagination->getStart();
        
        \playbuff\App::$app::setProperty("admin.ordersPagination", $pagination);

        $orders = \R::findAll("order", "ORDER BY id DESC LIMIT {$start}, $perpage");

        $this->set($orders);

        if(isset($_GET['delete'])) {
            $delete_id = (int)dataClear($_GET['delete']);
            if (Admin::delete('order', $delete_id)) {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Запись успешно удалена</strong>
                                            </div>';
            }
            redirect('/admin/order');
        }
    }

}

?>