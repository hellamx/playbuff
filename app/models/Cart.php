<?php 

namespace app\models;

class Cart extends AppModel 
{

    /**
     * Добавление товара в корзину
    */
    public function addToCart($product, $qty = 1, $platform)
    {
        $_SESSION['cart.currency'] = \playbuff\App::$app::getProperty("currency");

        $id = $product->id . '-' . $platform;
        $title = "{$product->title}";
        $price = $product->price;

        $finalPrice = round((1 - ($product->discount) / 100) * ($price * $_SESSION['cart.currency']['value']), 2);

        if (isset($_SESSION['cart'][$id])) {

            $qtyInDB = \R::count("game_keys", "game_id = ? AND platform = ?", [$product->id, $platform]);

            $currentValue = ($_SESSION['cart'][$id]['qty']);
            $value = $currentValue + $qty;

            if ($value <= $qtyInDB) {
                $_SESSION['cart'][$id]['qty'] += $qty;
            } else {
                echo '<span id="modal--error">Нет нужного количества товара</span>';
                die;
            }

        } else {
            $_SESSION['cart'][$id] = [
                'id' => $product->id,
                'qty' => $qty,
                'title' => $title,
                'alias' => $product->alias,
                'price' => $finalPrice,
                'img' => $product['main_image'],
                'platform' => $platform
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] += $qty : $qty;
        
        if (isset($_SESSION['cart.sum']) and $_SESSION['cart.sum']) {
            $_SESSION['cart.sum'] = $_SESSION['cart.sum'] + $finalPrice;
        } else {
            $_SESSION['cart.sum'] = $finalPrice;
        }
    }

    /**
     * Перерасчет корзины в выбранную валюту
    */
    public static function reCalc(array $currency)
    {

        $_SESSION['cart.currency'] = $currency;
        $_SESSION['cart.sum'] = 0;
        foreach ($_SESSION['cart'] as $k => $v) {
            $product = \R::findOne("product", " id = ?", [$_SESSION['cart'][$k]['id']]);
            $finalPrice = round((1 - ($product->discount) / 100) * ($product['price'] * $_SESSION['cart.currency']['value']), 2);

            $_SESSION['cart'][$k]['price'] = $finalPrice;
            $_SESSION['cart.sum'] = $_SESSION['cart.sum'] + $finalPrice * $_SESSION['cart'][$k]['qty'];
        }
        
    }

    /**
     * Проверка наличия нужного товара в базе данных
    */
    public static function payPresence(string $products)
    {
        
        $product = explode(";", $products);
        array_pop($product);

        foreach($product as $v) {
            $check[] = explode("-", $v);
        }

        foreach($check as $v) {
            $qty = \R::count("game_keys", "game_id = ? AND platform = ?", [$v[0], $v[1]]);
            if (!$qty) return false;
        }

        return true;
    }
}

?>