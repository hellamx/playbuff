<?php 

namespace app\controllers;

use playbuff\Registry;
use app\models\User;

class UserController extends AppController 
{


    public function indexAction()
    {
        $this->layout = 'user';

        if (!isset($_SESSION['user'])) throw new \Exception('Страница не найдена', 404);

        $this->setMeta("Аккаунт пользователя | " . SITENAME);

        $orders = User::getUserOrders();
        $title = [];
        foreach($orders as $k => $v) {
            $arrGames = explode(';', $v['products'], -1);
            foreach($arrGames as $key => $value) {
                $game = (explode('-', $value))[0];
                $title[$k][] = \R::findOne('product', 'WHERE id = ?', [$game])->title;
            }
        }

        Registry::setProperty('user.orders',[User::getUserOrders(), 'titles' => $title]);
    }

    /**
     * Регистрация пользователя
    */
    public function signupAction()
    {
        if(isset($_SESSION['user'])): redirect("/"); endif;

        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);

            if (@!$user->validate($data) || !$user->uniqueField()) {

                if($this->isAjax()) {
                    echo "<div id='errorDisplay'>" . $user->getErrors() . "</div>";
                    die;
                }

                $_SESSION["errors"] = $user->getErrors();
            } else {
                
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                $user->attributes['login'] = mb_strtolower($user->attributes['login']);
                $user->attributes['email'] = mb_strtolower($user->attributes['email']);

                if ($user->save("user")){

                    if($this->isAjax()) {
                        echo "<div id='successDisplay'>Регистрация успешна</div>";
                        die;
                    }

                    $_SESSION['success'] = "Регистрация успешна";
                } else {
                    $_SESSION['errors'] = "Произошла неизвестная ошибка";
                }
            }

            redirect("/user/signup");
        }

        $this->setMeta("Регистрация нового пользователя | " . SITENAME, "Регистрация нового пользователя", "Playbuff.ru, Игровые ключи");
    }

    /**
     * Авторизация пользователя
    */
    public function loginAction()
    {
        if(isset($_SESSION['user'])): redirect("/"); endif;


        $this->setMeta("Авторизация пользователя | " . SITENAME, "Авторизация пользователя", "Playbuff.ru, Игровые ключи");

        if(!empty($_POST)) {
            
            if($this->isAjax()) {
                if (empty($_POST['login'])): echo "<div id='errorDisplay'>Логин должен содержать не менее 4 символов</div>"; die; endif;
                if (empty($_POST['password'])): echo "<div id='errorDisplay'>Пароль должен содержать не менее 6 символов</div>"; die; endif;
            }

            if (User::isBanned(dataClear($_POST['login']))) die("<div id='errorDisplay'>Ваш аккаунт заблокирован</div>");

            $user = new User();

            if ($user->login()) {
                if($this->isAjax()) {
                    echo "<div id='successDisplay'>Авторизация успешна <br> Вы будете перенаправлены через 3 сек.</div>";
                    die;
                }

                $_SESSION['success'] = "Успешно";
            } else {
                if($this->isAjax()) {
                    echo "<div id='errorDisplay'>Логин или пароль введены неверно</div>";
                    die;
                }

                $_SESSION['errors'] = "Логин или пароль введены неверно";
            }

            redirect("/user/login");
        }
    }

    /**
     * Выход из аккаунта
    */
    public function logoutAction()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            redirect("/");
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }

    /**
     * Изменение пароля
    */
    public function authAction() {
        if(isset($_SESSION['user'])): redirect("/"); endif;

        if($this->isAjax()) {

            if (!empty($_POST)) {
                if (mb_strlen($_POST['password']) < 6): echo "<div id='errorDisplay'>Пароль должен быть не менее 6 символов</div>"; die; endif;
                if (mb_strlen($_POST['password_repeat']) < 6): echo "<div id='errorDisplay'>Пароль должен быть не менее 6 символов</div>"; die; endif;
                if ($_POST['password_repeat'] != $_POST['password']): echo "<div id='errorDisplay'>Пароли не совпадают</div>"; die; endif;
                
                $user_id = $_SESSION['user_reset'];
                $new_password = password_hash(dataClear($_POST['password']), PASSWORD_DEFAULT);

                $query = \R::exec("UPDATE user SET password = ? WHERE id = ?", [$new_password, $user_id]);
                if ($query) {
                    \R::exec("DELETE FROM password_reset WHERE user_id = ?", [$user_id]);
                    echo "<div id='successDisplay'>Пароль успешно изменен</div>";
                }

                unset($_SESSION['user_id']);
                die;
            }
        }
        
        if (isset($_GET['key']) && !$this->isAjax()) {
            $key = dataClear($_GET['key']);
            $db = \R::findOne('password_reset', "WHERE hash_key = ?", [$key]);
            
            if ($db && $db->expiration_date > time()) {
                $this->setMeta("Изменение пароля | " . SITENAME);
                $_SESSION['user_reset'] =  $db->user_id;

            } else {
                throw new \Exception("Страница не существует", 404);
            }
        } else {
            if(!$this->isAjax()) {
                throw new \Exception("Страница не суещствует", 404);
            }
        }
    }

    /**
     * Сброс пароля и отправка письма со ссылкой-ключом
    */
    public function resetAction()
    {
        if(isset($_SESSION['user'])): redirect("/"); endif;

        if ($_POST and !isset($_GET['key'])) {
            $email = dataClear($_POST['email']);
            if (mb_strlen($email) < 4) {
                echo "<div id='errorDisplay'>Некорректно указан Email</div>";
                die;
            }

            $data = \R::findOne("user", "WHERE email = ?", [$email]);
            if ($data) {

                $create_date = time();
                $expiration_date = time() + 3600;
                $key = hash("sha256", rand(1, 1000));
                $user_id = $data->id;

                
                \R::exec("DELETE FROM password_reset WHERE user_id = ?", [$user_id]);
                $link = PATH . '/user/auth?key=' . $key;

                $query = \R::exec("INSERT INTO password_reset (create_date, expiration_date, hash_key, user_id) VALUES (?, ?, ?, ?)", [$create_date, $expiration_date, $key, $user_id]);
                if ($query) {
                    
                    $mailer = \playbuff\base\Model::sendMail($email, 
                    Registry::getProperty("smtp_login"),
                    Registry::getProperty("smtp_password"),
                    Registry::getProperty("smtp_host"),
                    "Ссылка для сброса пароля",
                    $link);

                    if ($mailer) {
                        echo "<div id='successDisplay'>Ссылка на сброс пароля отправлена на указанный E-mail <br> Действительна 1 час</div>";
                    } else {
                        echo "<div id='errorDisplay'>Не удалось отправить письмо</div>";

                    }

                    die;
                }

            } else {
                echo "<div id='errorDisplay'>Аккаунт с данным Email не существует</div>";
                die;
            }
        }

    }

    /**
     * Редактирование аккаунта 
    */
    public function updateAction()
    {
        if($this->isAjax()) {
            if (!empty($_POST['mail']) && mb_strlen($_POST['mail']) > 4) {
                
                $email = dataClear($_POST['mail']);
                if (!\R::findOne('user', 'WHERE email = ?', [$email])) {
                    \R::exec('UPDATE user SET email = ? WHERE id = ?', [$email, $_SESSION['user']['id']]);
                    echo "<span class='alert success fade'>E-mail адрес успешно изменен</span>";
                    $_SESSION['user']['email'] = $email;
                } else {
                    echo "<span class='alert error fade'>E-mail уже используется</span>";
                }
   
            } else {
                echo "<span class='alert error fade'>Неверно указан E-mail</span>";
            }
        } else {
            throw new \Exception('Страница не найдена', 404);
        }
        
        die;
    }

    /**
     * Пополнение баланса
    */
    public function getbalanceAction()
    {
        if(!isset($_SESSION['user'])) throw new \Exception('Страница не найдена', 404);

        $this->layout = 'user';
        $this->setMeta("Пополнение баланса | " . SITENAME);


        if ($this->isAjax()) {
            if(!empty($_POST['balance']) && (int)$_POST['balance']) {
                $balance = (int)dataClear($_POST['balance']);
                $method = dataClear($_POST['method']);
                $methods = ['card', 'crypto'];
                
                if (!in_array($method, $methods) || $method != 'card') {
                    exit("<span class='alert error fade'>Данный метод оплаты сейчас недоступен</span>");
                }

                $currentBalance = \R::findOne('user', 'id = ?', [$_SESSION['user']['id']])->balance;

                if (\R::exec('UPDATE user SET balance = ? WHERE id = ?', [$currentBalance + $balance, $_SESSION['user']['id']])) {
                    $_SESSION['user']['balance'] = $currentBalance + $balance;
                    echo "<span class='alert success fade'>Баланс успешно пополнен.<br>Обновление через 2 сек.</span>";
                } else {
                    echo "<span class='alert error fade'>Неизвестная ошибка</span>";
                }

            } else {
                echo "<span class='alert error fade'>Неверно указана сумма</span>";
            }

            die;
        }

    }
}

?>