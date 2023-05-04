<?php 

namespace app\widgets\discount;

class Discount 
{

    public static function checkDiscount($id, $discount)
    {
        if ($discount > 0) {
            return true;
        }
        return false;
    }

    public static function getHtml($mainPrice, $discount, $symbol, $code = "RUB", $fontSize = 16)
    {
        if ($discount > 0) {

            $price = round($mainPrice - ($mainPrice * ($discount / 100)), 2);

            if ($code == "RUB") {
                $price = floor($price);
            }

            $html =  "<span style='font-size: {$fontSize}' 
            class='main__slider--price'><s>" . $mainPrice . $symbol . "</s> 
            " . $price . $symbol . "<b id='priceDiscount'> - " . $discount. "%</b></span>";
            return $html;
        } else {
            return "<span style='font-size: {$fontSize}' class='main__slider--price'>" . $mainPrice . $symbol . "</span>";
        }
    }
}

?>