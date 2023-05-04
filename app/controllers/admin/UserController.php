<?php 

namespace app\controllers\admin;

use app\models\admin\Admin;
use playbuff\App;

class UserController extends AppController 
{
    public function indexAction()
    {
        $this->setMeta('Все пользователи | Playbuff');

        // Получение заказов и пагинация

        $total = \R::count("user");

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 6;
        $pagination = new \app\models\Pagination($page, $perpage, $total, true);

        $start = $pagination->getStart();
        
        \playbuff\App::$app::setProperty("admin.userPagination", $pagination);

        $this->set(Admin::getUsers($start, $perpage));
    }

    public function viewAction()
    {
        if(empty($this->route['alias']) || !(\R::findOne('user', 'id = ?', [dataClear($this->route['alias'])]))) { 
            throw new \Exception('Страница не найдена', 404);
        }
        
        $user = \R::findOne('user', 'id = ?', [dataClear($this->route['alias'])]);
        $this->setMeta('Пользователь ' . $user->login . ' | Playbuff');

        App::$app::setProperty('admin.userprofile', $user);
    }

    public function saveAction()
    {
        if ($this->isAjax() && $_POST) {
            
            $id = (int)dataClear($_POST['id']);
            $ban = (int)dataClear($_POST['ban']);
            $login = dataClear($_POST['login']);
            $email = dataClear($_POST['email']);
            $balance = (int)dataClear($_POST['balance']);
            $role = (int)dataClear($_POST['role']);

            $fields = [0, 1];
            if (mb_strlen($login) < 4 || mb_strlen($email) < 4) {
                die('<div class="alert alert-danger" role="alert">
                            <strong>Неккоректно заполнены поля</strong>
                          </div>');
            }
            
            if (!in_array($ban, $fields) || !in_array($role, $fields)) {
                die('<div class="alert alert-danger" role="alert">
                            <strong>Неккоректно заполнены поля</strong>
                          </div>');
            }

            $data = [
                'ban' => $ban,
                'login' => $login, 
                'email' => $email, 
                'balance' => $balance, 
                'role' => $role
            ];

            if (Admin::update($id, 'user', $data)) {
                die('<div class="alert alert-success" role="alert">
                            <strong>Данные успешно изменены</strong>
                          </div>');
            } else {
                die('<div class="alert alert-danger" role="alert">
                            <strong>Неизвестная ошибка при сохранении</strong>
                          </div>');
            }

        } else {
            throw new \Exception('Страница не найдена', 404);
        }
    }

    public function deleteAction()
    {
        if (isset($_GET['id']) && (\R::findOne('user', 'id = ?', [dataClear($_GET['id'])]))) {
            Admin::delete('user', (int)dataClear($_GET['id']));
            $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Пользователь успешно удален</strong>
                                            </div>';
            redirect('/admin/user');
        } else {
            throw new \Exception('Страница не найдена', 404);
        }
    }
}


?>