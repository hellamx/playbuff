<?php 

namespace app\widgets\categories;
use playbuff\App;

class Categories 
{
    protected $cacheKey = "categories_nav";

    public function __construct() 
    {
        if(App::$cache::get($this->cacheKey)) {
            
            self::save("categories", App::$cache::get($this->cacheKey));

        } else {
        
            $categories = \R::findAll('categories');
            App::$cache::set($this->cacheKey, $categories);
            self::save("categories", $categories);

        }
    }

    public static function save($name, $data)
    {
        App::$app::setProperty($name, $data);
    }

}

?>