<?php

namespace app\widgets\gallery;

class Gallery 
{
    public static function getPhotos($id)
    {
        $photos = \R::findAll("gallery", "WHERE `game_id` = ?", [$id]);

        return $photos;
    }
}

?>