<?php 

namespace app\models;

use playbuff\Registry;

class Order extends AppModel
{
    public static function saveOrder($data)
    {
        $order = \R::dispense('order');

        $order->user_id = $data['user_id'];
        $order->date = $data['date'];
        $order->sum = $data['sum'];
        $order->products = $data['products'];
        $order->user_email = $data['user_email'];
        $order->pay_method = $data['pay_method'];
        $order->sum = $data['sum'];
        
        if(isset($_SESSION['user']['promo'])) $order->promocode = $_SESSION['user']['promo'];

        $order_id = \R::store($order);
        return $order_id;
    }

    public static function getProducts($products)
    {
        $keys = [];
        $key_assoc = [];

        $product = explode(";", $products);
        array_pop($product);

        foreach($product as $v) {
            $check[] = explode("-", $v);
        }

        foreach($check as $v) {
            $keys = \R::find("game_keys", "game_id = ? AND platform = ? ORDER BY id DESC LIMIT " . $v[2], [$v[0], $v[1]]);
            
            foreach($keys as $key => $val) {
                $key_assoc[$key]['id'] = $val['id'];
                $key_assoc[$key]['game_id'] = $val['game_id'];
                $key_assoc[$key]['platform'] = $val['platform'];
                $key_assoc[$key]['key'] = $val['game_key'];
            }
        }

        return $key_assoc;
    }

    public static function deleteSales($keys)
    {

    }

    public static function getMailHtml($keys)
    {
        $html = '<b>Ваши товары: </b>';
            foreach ($keys as $k => $v) {
                $html .= '<ul>';
                $game = \R::getAll("SELECT title FROM product WHERE id = ?", [$v['game_id']]);
                    $html .= '<li>Игра: <b>' . ucfirst($game[0]['title']) . '</li>';
                    $html .= '<li>Платформа: <b>' . ucfirst($v['platform']) . '</li>';
                    $html .= '<li>Игровой ключ: <b>' . $v['key'] . '</li>';
                $html .= '</ul>';
            }
        return $html;
    }


    public static function sendMailOrder($order_id, $user_email, $html)
    {
        return $mailer = \playbuff\base\Model::sendMail($user_email, 
                    Registry::getProperty("smtp_login"),
                    Registry::getProperty("smtp_password"),
                    Registry::getProperty("smtp_host"),
                    "Ваш заказ #" . $order_id,
                    $html);
    
    }
}

?>