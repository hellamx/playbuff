<?php 

namespace app\models;

class User extends AppModel 
{
    public $attributes = [
        "login" => "",
        "password" => "",
        "email" => ""
    ];

    public $rules = [
        "required" => ["login", "password", "email"],
        "email" => ["email"],
        "lengthMin" => [["password", 6], ["login", 4]]
    ];

    public function uniqueField()
    {
        $user = \R::findOne('user', 'WHERE login = ? OR email = ?', [$this->attributes['login'], $this->attributes['email']]);

        if ($user) {
            if($user->login == mb_strtolower($this->attributes['login'])): $this->errors['unique'][] = "Указанный логин уже занят";
            endif;
            
            if($user->email == mb_strtolower($this->attributes['email'])): $this->errors['unique'][] = "E-mail уже зарегистрирован";
            endif;
            
            return false;
        }

        return true;
    }

    public function login($isAdmin = false)
    {
        $login = !empty(dataClear($_POST['login'])) ? dataClear($_POST['login']) : null;
        $password = !empty(dataClear($_POST['password'])) ? dataClear($_POST['password']) : null;
    
        if($login && $password) {
            if ($isAdmin) {
                $user = \R::findOne("user", "WHERE login = ? and role = ?", [$login, 1]);
            } else {
                $user = \R::findOne("user", "WHERE login = ?", [$login]);
            }

            if ($user) {
                if (password_verify($password, $user->password)) {                    
                    foreach($user as $k => $v) {
                        if($k != "password") {
                            $_SESSION['user'][$k] = $v;
                        }
                    }

                    return true;
                }
            }
        }
        
        return false;
    }

    public static function isBanned($login) 
    {
        $user = \R::findOne('user', 'login = ?', [$login]);
        if ($user->ban == 1) return true;
    }

    public static function isAdmin()
    {
        if ($_SESSION['user']['role'] == 1) return true;
        return false;
    }

    public static function getUserOrders()
    {
        return \R::findAll('order', 'WHERE user_id = ? ORDER BY id DESC LIMIT 3', [$_SESSION['user']['id']]);
    }
}

?>