<?php 

namespace app\models;

class Breadcrumbs 
{
    public static function getCrumbs($category_id, $name = "", $routes)
    {
        $categories = \playbuff\App::$app::getProperty("categories");
        $html = self::getParts($categories, $category_id, $routes, $name);

        return $html;
    }

    public static function getParts($categories, $id, $routes, $name)
    {
        if(!$id) return false;

        $breadcrumbs = [];
        $breadcrumbs["Главная"] = "";
        $breadcrumbs["Категории"] = "categories";

        if (isset($categories[$id])) {
            $breadcrumbs[$categories[$id]['title']] = $breadcrumbs["Категории"] . "/" . $categories[$id]['alias'];
        }

        $breadcrumbs[$name] = 'product/' . $routes['alias'];

        $re = "<div class='breadcrumbs'><ul>";

        $delimiter = " / ";
        $arrLen = count($breadcrumbs);
        $i = 0;
        foreach ($breadcrumbs as $k => $v) {
            $i++;
            if ($i == $arrLen) $delimiter = "";
            $re .= "<li><a href='/" . $breadcrumbs[$k] . "'>". $k . $delimiter ."</li>";
        }

        $re .= "</ul></div>";

        return $re;
    }
}

?>