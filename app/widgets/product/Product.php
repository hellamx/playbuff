<?php 

namespace app\widgets\product;

class Product 
{

    public static $id;
    public static $platforms;
    public static $steam = 0;
    public static $origin = 0;
    
    public static function checkPlatforms($id) 
    {
        
        self::$steam = \R::count("game_keys", "game_id = ? AND platform = ?", [$id, "steam"]);
        self::$origin = \R::count("game_keys", "game_id = ? AND platform = ?", [$id, "origin"]);

        if (self::$steam > 0 && self::$origin > 0) {
            self::$platforms = "<span id='platformIco'><img id='platformIcon' alt='steam' width='20' height='20' src='/icons/steam.svg'> Steam</span>
            <span id='platformIco'><img id='platformIcon' alt='origin' width='20' height='20' src='/icons/origin.svg'> Origin</span>";
            return true;
        }

        if (self::$steam > 0) {
            self::$platforms = "<span id='platformIco'><img alt='steam' id='platformIcon' width='20' height='20' src='/icons/steam.svg'> Steam</span>";
            return true;
        }

        if (self::$origin > 0) {
            self::$platforms = "<span id='platformIco'><img alt='origin' id='platformIcon' width='20' height='20' src='/icons/origin.svg'> Origin</span>";
            return true;
        }

        return false;
    }

    public static function getHtml($id, $typeOfReply = "platforms", $html = 0)
    {
        self::$id = $id;

        if ($typeOfReply == "platforms") {
            
            if (self::checkPlatforms(self::$id)) {
                return self::$platforms;
            } else {
                return "Временно недоступно";
            }

        } elseif ($typeOfReply == "presence") {
            
            if (self::checkPlatforms(self::$id)) {
                $count = self::$steam + self::$origin;

                if ($count > 0 && $count <= 6) {

                    if ($html) return "<span style='color: #ff781f;'>Осталось мало</span>";
                    return "Осталось мало";
                
                } elseif ($count > 6) {
                    
                    if ($html) return "<span style='color: #37B20B;'>В наличии</span>";
                    return "В наличии";
                
                }
            } else {

                if ($html) return "<span style='color: red'>Товар закончился</span>";
                return "Товар закончился";
            }

        } else {
            return "unkown type of reply";
        }
    }

}




?>