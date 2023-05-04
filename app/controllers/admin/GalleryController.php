<?php 

namespace app\controllers\admin;
use app\models\admin\Admin;

class GalleryController extends AppController 
{
    public function indexAction()
    {
        $this->setMeta("Галерея");

        $total = \R::count("gallery");

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 9;
        $pagination = new \app\models\Pagination($page, $perpage, $total, true);

        $start = $pagination->getStart();
        
        \playbuff\App::$app::setProperty("admin.galleryPagination", $pagination);

        $gallery = \R::getAll("SELECT * FROM gallery ORDER BY id DESC LIMIT {$start}, $perpage");
        $this->set($gallery);

        if(isset($_GET['delete'])) {
            $delete_id = (int)dataClear($_GET['delete']);
            if (Admin::delete('gallery', $delete_id)) {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Фотография успешно удалена</strong>
                                            </div>';
            }
            redirect('/admin/gallery');
        }
    }

    public function addAction()
    {
        $this->setMeta("Добавление изображения");

        if (!empty($_POST)) {
            $game_id = dataClear($_POST['game_id']);
            $alt = dataClear($_POST['alt']);
            $file = $_FILES;

            $uploadDir = WWW . '/src/';
            $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['main_image']['name']));
            $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/webp", "image/x-png");

            if($_FILES['main_image']['size'] > 1048576){
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Максимальный размер файла - 1МБ</strong>
                                            </div>';
                redirect('/admin/gallery/add');
            }

            if($_FILES['main_image']['error']){
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Добавьте изображение</strong>
                                            </div>';
                redirect('/admin/gallery/add');
            }

            if(!in_array($_FILES['main_image']['type'], $types)){
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Допустимые расширения - .gif, .jpg/jpeg, .png</strong>
                                            </div>';
                redirect('/admin/gallery/add');
            }
            $new_name = md5(time()).".$ext";
            $uploadfile = $uploadDir.$new_name;

            move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadfile);
            \app\models\admin\Product::resize($uploadfile, $uploadfile, \playbuff\App::$app::getProperty('gallery_width'), \playbuff\App::$app::getProperty('gallery_height'), $ext);

            $img = \R::dispense('gallery');
            $img->game_id = $game_id;
            $img->src = $new_name;
            $img->alt = $alt;

            if (\R::store($img)) {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Изображение успешно добавлено</strong>
                                            </div>';
            } else {
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Неизвестная ошибка при сохранении</strong>
                                            </div>';
            }
            
            redirect('/admin/gallery/add');
            
        }

    }
}


?>