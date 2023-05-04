<?php 

namespace app\controllers\admin;

use app\models\admin\Admin;

class ProductController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Все товары | Playbuff');

        // Получение заказов и пагинация

        $total = \R::count("product");

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 9;
        $pagination = new \app\models\Pagination($page, $perpage, $total, true);

        $start = $pagination->getStart();
        
        \playbuff\App::$app::setProperty("admin.productPagination", $pagination);

        $this->set(Admin::getProducts($start, $perpage));
    }

    public function addAction()
    {
        $this->setMeta('Добавление товара');

        if (!empty($_POST)) {
            $product = new \app\models\admin\Product;
            $data = $_POST;
            
            $file = $_FILES;

            $uploadDir = WWW . '/src/';
            $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['main_image']['name']));
            $types = array("image/gif", "image/png", "image/jpeg", "image/webp", "image/pjpeg", "image/x-png");

            if($_FILES['main_image']['size'] > 1048576){
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Максимальный размер файла - 1МБ</strong>
                                            </div>';
                redirect('/admin/products/add');
            }

            if($_FILES['main_image']['error']){
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Добавьте изображение</strong>
                                            </div>';
                redirect('/admin/products/add');
            }

            if(!in_array($_FILES['main_image']['type'], $types)){
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Допустимые расширения - .gif, .jpg/jpeg, .png</strong>
                                            </div>';
                redirect('/admin/products/add');
            }
            $new_name = md5(time()).".$ext";
            $uploadfile = $uploadDir.$new_name;

            move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadfile);
            \app\models\admin\Product::resize($uploadfile, $uploadfile, \playbuff\App::$app::getProperty('img_width'), \playbuff\App::$app::getProperty('img_height'), $ext);
            
            $product->load($data);
            $product->attributes['main_image'] = $new_name;

            $errors = $product->valid($product->attributes);
            if ($errors) {
                $_SESSION['admin.alert'] = '<div class="alert alert-danger">';
                foreach($errors as $key => $value) {
                    $_SESSION['admin.alert'] .= '<strong>' . $value . '</strong><br>';
                }
                $_SESSION['admin.alert'] .= '</div>';

                redirect('/admin/products/add');
            }

            if ($id = $product->save('product')) {
                $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Товар успешно добавлен</strong>
                                            </div>';
            } else {
                $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Неизвестная ошибка при сохранении</strong>
                                            </div>';
            }
            
            redirect('/admin/products/add');
            
        }
    }

    public function viewAction()
    {
        $this->setMeta('Просмотр товара');
        $product = \R::findOne("product", "alias = ?", [$this->route['alias']]);
        \playbuff\Registry::setProperty('admin.editProduct', $product);
        
    }

    public function editAction() 
    {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $keywords = $_POST['keywords'];
        $description = $_POST['description'];
        $hit = $_POST['hit'];
        $alias = $_POST['alias'];
        $release_date = $_POST['release_date'];

        if(\R::exec("UPDATE product SET `title` = ?, `content` = ?, `price` = ?, `discount` = ?, `keywords` = ?, `description` = ?, hit = ?, release_date = ? WHERE alias = ?", [$title, $content, $price, $discount, $keywords, $description, $hit, $release_date, $alias])) {
            $_SESSION['admin.alert'] = '<div class="alert alert-success" role="alert">
                                                <strong>Успешно</strong>
                                            </div>';
            redirect('/admin/product/' . $alias);
        }

        $_SESSION['admin.alert'] = '<div class="alert alert-danger" role="alert">
                                                <strong>Неизвестная ошибка при сохранении</strong>
                                            </div>';
        redirect('/admin/product/' . $alias);
    }

}

?>