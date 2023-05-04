<?php 

namespace app\controllers\admin;

use app\models\admin\Admin;
use playbuff\App;

class CategoryController extends AppController 
{
    public function indexAction()
    {
        $this->setMeta("Все категории");
        $this->set(Admin::getCategories());
    }

    public function addAction()
    {
        $this->setMeta("Добавление категории");

        if ($_POST) {
            
            if (mb_strlen(dataClear($_POST['title'])) < 4 &&
                mb_strlen(dataClear($_POST['keywords'])) < 4 &&
                mb_strlen(dataClear($_POST['description'])) < 4 &&
                mb_strlen(dataClear($_POST['alias'])) < 4) {
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Некорректно заполнены поля. Длина каждого поля не менее 4 символов</strong>
                                            </div>';
                redirect('/admin/category/add');
            }

            $data = [
                'title' => dataClear($_POST['title']),
                'keywords' => dataClear($_POST['keywords']),
                'description' => dataClear($_POST['description']),
                'alias' => dataClear($_POST['alias'])
            ];

            $sth = \R::dispense('categories');
            foreach($data as $k => $v) {
                $sth->$k = $v;
            }
            if (\R::store($sth)) {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Категория успешно добавлена</strong>
                                            </div>';
                redirect('/admin/category/add');
            } else {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Ошибка при сохранении</strong>
                                            </div>';
                redirect('/admin/category/add');
            }



        }
    }

    public function viewAction()
    {
        if(!empty($this->route['alias']) && (\R::findOne('categories', 'id = ?', [dataClear($this->route['alias'])]))) {
            
            App::$app::setProperty('admin.categoryView', \R::findOne('categories', 'id = ?', [dataClear($this->route['alias'])]));

        } else {
            throw new \Exception('Страница не найдена', 404);            
        }
    }

    public function saveAction()
    {
        if ($this->isAjax() && $_POST) {
            
            $id = (int)dataClear($_POST['id']);
            $title = dataClear($_POST['title']);
            $keywords = dataClear($_POST['keywords']);
            $description = dataClear($_POST['description']);
            $alias = dataClear($_POST['alias']);

            $data = [
                'id' => $id,
                'title' => $title, 
                'keywords' => $keywords, 
                'description' => $description, 
                'alias' => $alias
            ];

            foreach($data as $key => $value) {
                if ($key == 'id') continue;

                if (mb_strlen($value) < 4) {
                    die('<div class="alert alert-danger" role="alert">
                            <strong>Длина каждого поля должна быть больше 4 символов</strong>
                          </div>');
                }
            }

            if (Admin::update($id, 'categories', $data)) {
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
}

?>