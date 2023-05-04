<?php 

namespace app\controllers\admin;

use app\models\admin\Admin;

class NewsController extends AppController
{
    public function indexAction()
    {
        $this->setMeta("Страница новостей");

        // Получение заказов и пагинация

        $total = \R::count("news");

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 9;
        $pagination = new \app\models\Pagination($page, $perpage, $total, true);

        $start = $pagination->getStart();
        
        \playbuff\App::$app::setProperty("admin.newsPagination", $pagination);

        $news = \R::findAll("news", "ORDER BY id DESC LIMIT {$start}, $perpage");

        $this->set($news);

        if(isset($_GET['delete'])) {
            $delete_id = (int)dataClear($_GET['delete']);
            if (Admin::delete('news', $delete_id)) {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Новость успешно удалена</strong>
                                            </div>';
            }
            redirect('/admin/news');
        }
    }

    public function viewAction()
    {
        $this->setMeta('Просмотр новости');
        $news = \R::findOne("news", "id = ?", [$this->route['alias']]);
        \playbuff\Registry::setProperty('admin.editNews', $news);
    }

    public function updateAction()
    {
        if(empty($_POST)) throw new \Exception('Страница не найдена', 404);
        
        $title_content = dataClear($_POST['title_content']);
        $date = dataClear($_POST['date']);
        $content = dataClear($_POST['content']);
        $id = dataClear($_POST['id']);

        $news = \R::exec("UPDATE `news` SET `title_content` = ?, `content` = ?, `date` = ? WHERE `id` = ?", [$title_content, $content, $date, $id]);
        if ($news) {
            $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                            <strong>Данные успешно изменены</strong>
                                        </div>';
            redirect('/admin/news/' . $id);
        } else {
            $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                            <strong>Неизвестная ошибка при сохранении</strong>
                                        </div>';
            redirect('/admin/news/' . $id);
        }
    }
    
    public function addAction()
    {
        $this->setMeta('Добавление новости');

        if (!empty($_POST)) {
            $title_content = dataClear($_POST['title_content']);
            $content = dataClear($_POST['content']);
            $file = $_FILES;

            $uploadDir = WWW . '/src/';
            $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['main_image']['name']));
            $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/webp", "image/x-png");

            if($_FILES['main_image']['size'] > 1048576){
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Максимальный размер файла - 1МБ</strong>
                                            </div>';
                redirect('/admin/news/add');
            }

            if($_FILES['main_image']['error']){
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Добавьте изображение</strong>
                                            </div>';
                redirect('/admin/news/add');
            }

            if(!in_array($_FILES['main_image']['type'], $types)){
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Допустимые расширения - .gif, .jpg/jpeg, .png</strong>
                                            </div>';
                redirect('/admin/news/add');
            }
            $new_name = md5(time()).".$ext";
            $uploadfile = $uploadDir.$new_name;

            move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadfile);
            \app\models\admin\Product::resize($uploadfile, $uploadfile, \playbuff\App::$app::getProperty('gallery_width'), \playbuff\App::$app::getProperty('gallery_height'), $ext);

            $news = \R::dispense('news');
            $news->title_content = $title_content;
            $news->content = $content;
            $news->image = $new_name;
            $news->date = date("Y-m-d h:m:s");
            $news->alias = md5(rand(time()));

            if (\R::store($news)) {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Новость успешно добавлена</strong>
                                            </div>';
            } else {
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Неизвестная ошибка при сохранении</strong>
                                            </div>';
            }
            
            redirect('/admin/news');
            
        }

    }
}


?>