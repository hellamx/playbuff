<?php 

namespace app\widgets\tags;

class tags 
{
    public static function getHtml($id)
    {
        $tags = \R::getAll("SELECT * FROM tags WHERE game_id = ?", [$id]);
        
        if ($tags) {

            $html = "<ul class='product__info--tags'>";
            foreach ($tags as $k => $v) {
                $html .= "<li><a href='/tags/" . $v['alias'] . "'>" . $v["title"] . "</a></li>";
            }
            $html .= "</ul>";

            return $html;
        }

        return false;
    }
}

?>