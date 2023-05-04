<?php

namespace app\controllers;

use app\models\Order;
use app\models\Cart;

class CartController extends AppController 
{
    public function indexAction()
    {
        $this->setMeta("Корзина товаров | " . SITENAME);
    }

    /**
     * Добавление в корзину
    */
    public function addAction()
    {

        $getId = htmlspecialchars(trim((int)$_GET['id']));
        $getQty = htmlspecialchars(trim((int)$_GET['qty']));
        $getPlatform = htmlspecialchars(trim($_GET['platform']));

        $id = !empty($getId) ? $getId : null;
        $qty = !empty($getQty) ? $getQty : null;
        $platform = !empty($getPlatform) ? (string)$getPlatform : null;

        $mod = null;

        if($id) {
            if($platform && $qty) {
                $mod = \R::count("game_keys", "game_id = ? AND platform = ?", [$id, $platform]);
                if ($mod >= $qty) {

                    $product = \R::findOne('product', 'id = ?', [$id]);

                    if ($product) {

                        $cart = new Cart();
                        $cart->addToCart($product, $qty, $platform);
                        
                        if($this->isAjax()) {
                            $this->loadView('cart_modal');
                        }
                        redirect();
                    
                    } else {
                        echo '<span id="modal--error">Ошибка, такого товара не существует</span>';
                    }

                } else {
                    echo '<span id="modal--error">Ошибка, товара нет</span>';
                    die;
                }
            } else {
                echo '<span id="modal--error">Неверно указаны данные</span>';
                die;
            }
        }

    }

    /**
     * Показ корзины
    */
    public function showAction()
    {
        if($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    /**
     * Удаление одного товара из корзины
    */
    public function deleteAction()
    {
        $getId = htmlspecialchars(trim((int)$_GET['id']));
        $getPlatform = htmlspecialchars(trim($_GET['platform']));

        if($getId && $getPlatform) {
            if (isset($_SESSION['cart'][$getId . "-" . $getPlatform])) {

                $_SESSION['cart.qty'] = $_SESSION['cart.qty'] - $_SESSION['cart'][$getId . "-" . $getPlatform]['qty'];
                $_SESSION['cart.sum'] = $_SESSION['cart.sum'] - $_SESSION['cart'][$getId . "-" . $getPlatform]['qty'] * $_SESSION['cart'][$getId . "-" . $getPlatform]['price'];
                unset($_SESSION['cart'][$getId . "-" . $getPlatform]);

                if ($_SESSION['cart.qty'] == 0) $_SESSION['cart.sum'] = 0;

                if($this->isAjax()) {
                    $this->loadView('cart_modal');
                }
            }
        }
        
        redirect();
    }

    /**
     * Полная очистка корзины
    */
    public function wipeAction()
    {
        $_SESSION['cart.qty'] = 0;
        $_SESSION['cart.sum'] = 0;
        unset($_SESSION['cart']);
        unset($_SESSION['cart.currency']);

        if($this->isAjax()) {
            $this->loadView('cart_modal');
        }

        redirect();
    }

    /**
     * Произведение оплаты
    */
    public function checkoutAction()
    {
        if(empty($_POST['submit'])) throw new \Exception('Страница не найдена', 404);

        $order = ['products' => '']; // Массив с данными заказа
        $payMethods = ['balance', 'card', 'crypto']; // Доступные методы для оплаты

        if(!isset($_SESSION['user'])): redirect("/user/signup"); endif;
        if(!isset($_SESSION['cart'])): throw new \Exception("Страница не найдена", 404); endif;

        foreach($_SESSION['cart'] as $k => $v) {
            $order["products"] .=  $k . "-" . $v['qty'] . ";";
        }

        $cur = \playbuff\App::$app::getProperty("currency");

        $order['user_id'] = $_SESSION['user']['id'];
        $order['user_email'] = $_SESSION['user']['email'];
        $order['date'] = date("Y-m-d H:i:s");
        $order['sum'] = $_SESSION['cart.sum'] . ":" . $cur['code'];
        
        // Проверка метода платежа, если такого не существует, то по умолчанию "balance"
        if (in_array($_POST['pay_method'], $payMethods)) {
            $order['pay_method'] = dataClear($_POST['pay_method']);
        } else {
            $order['pay_method'] = 'balance';
        }

        // Проверка наличия товара, сохранение заказа и отправка письма
        if (Cart::payPresence($order['products'])) {

            $sumToPay = $_SESSION['cart.sum'];
            if($_SESSION['cart.currency']['base'] == '0') { // перерасчет, если доллары
                $sumToPay = round($_SESSION['cart.sum'] * (1 / $_SESSION['cart.currency']['value']), 2);
            }

            if ($_SESSION['user']['balance'] < $sumToPay) {
                $_SESSION['alert'] = "<span class='error'>Недостаточно средств</span>";
                redirect('/cart');
            }
            
            $order_id = Order::saveOrder($order); // Возвращает id добавленной записи или false
            $keys = Order::getProducts($order['products']);

            if (isset($_SESSION['user']['promo'])) {
                unset($_SESSION['user']['promo']); // Удаление промокода
                unset($_SESSION['cart.oldsum']);
            }
            Order::deleteSales($keys); // Удаление купленных товаров из базы данных

            $html = Order::getMailHtml($keys); // Получение html-кода для письма
            if (Order::sendMailOrder($order_id, $order['user_email'], $html)) { // Отправка письма

                $_SESSION['user']['balance'] = $_SESSION['user']['balance'] - $sumToPay;
                \R::exec('UPDATE user SET balance = ? WHERE id = ?', [$_SESSION['user']['balance'], $_SESSION['user']['id']]);

                unset($_SESSION['cart']);
                unset($_SESSION['cart.qty']);
                unset($_SESSION['cart.sum']);
                $_SESSION['alert'] = "<span class='success'>Успешно<br>Проверьте вашу почту</span>";
                redirect('/cart');
            } else {
                $_SESSION['alert'] = "<span class='error'>Не удалось отправить письмо</span>";
                redirect('/cart');
            }
        }

        die;
    }

    
    /**
     * Добавление промокода
    */
    public function promocodeAction()
    {
        if ($this->isAjax()) {
            
            if(!empty($_POST['promocode']) && mb_strlen($_POST['promocode']) > 4) {
                
                $pcode = dataClear($_POST['promocode']);
                
                $isAvailable = \R::findOne("promocodes", "WHERE promocode = ?", [$pcode]);
                
                if ($isAvailable && $isAvailable->available > 0) {
                    
                    $isAvailable->available = $isAvailable->available - 1;
                    \R::store($isAvailable);

                    $_SESSION['cart.oldsum'] = $_SESSION['cart.sum'];
                    $_SESSION['cart.sum'] = $_SESSION['cart.sum'] - ($_SESSION['cart.sum'] * ($isAvailable->bonus / 100));
                    $_SESSION['user']['promo'] = $isAvailable->bonus;

                    echo "Успешно";

                } else {
                    echo "Ошибка";
                }

            } else {
                echo "Ошибка";
            }

        } else {
            throw new \Exception("Страница не найдена", 404);
        }

        die;
    }
}

?>