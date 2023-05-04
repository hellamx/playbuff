<?php 

namespace app\controllers;

use app\models\Cart;

class CurrencyController extends AppController
{
    public function changeAction()
    {

        if (!empty($_POST["currencyChange"])) {
            $currency = trim(htmlspecialchars($_POST["currencyChange"]));
            $currencies = \playbuff\App::$app::getProperty("currencies");

            if (array_key_exists($currency, $currencies)) {
                setcookie("currency", $currency, time() + 3600 * 24 * 7, "/");
                Cart::reCalc($currencies[$currency]);
            }
            
        } else {
            $currency = null;
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}

?>