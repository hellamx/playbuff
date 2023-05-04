<?php 

namespace app\models;

class Product extends AppModel 
{
    public function setRecentlyViewed($id)
    {
        $all = $this->getAllRecentlyViewed();

        if (!$all) {
            setcookie("recentlyViewed", $id, time() + 3600 * 24, "/");
        } else {
            $all = explode(".", $all);
            if(!in_array($id, $all)) {
                
                $all[] = $id;
                $all = implode(".", $all);
                setcookie("recentlyViewed", $all, time() + 3600 * 24, "/");
                
            }
        }

    }

    public function getRecentlyViewed()
    {
        if(!empty($_COOKIE["recentlyViewed"])) {
            $all = $_COOKIE["recentlyViewed"];
            $all = explode(".", $all);

            return array_slice($all, -4);
        }

        return false;
    }

    public function getAllRecentlyViewed()
    {
        if (!empty($_COOKIE['recentlyViewed'])) {
            return $_COOKIE['recentlyViewed'];
        }
        
        return false;

    }

}

?>