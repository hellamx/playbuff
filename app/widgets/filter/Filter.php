<?php 

namespace app\widgets\Filter;

class Filter
{
    public $categories;
    public $selectCategory;
    public $price;
    public $tpl;
    public $filter;

    public function __construct()
    {
        $this->tpl = __DIR__ . "/filter_tpl.php";
        $this->run();
		
    }

    protected function run()
    {
        $this->categories = $this->getCategories();
        
        $this->price = isset($_GET['price']) ? dataClear($_GET['price']) : null;
        $this->selectCategory = isset($_GET['category']) ? dataClear($_GET['category']) : null;
        $this->filter = isset($_GET['filter']) ? dataClear($_GET['filter']) : null;
    
        echo $this->getHtml();
    }

    public static function getMaxPrice()
    {
        return \R::findOne("product", "ORDER BY price DESC LIMIT 1");
    }

    public static function getMinPrice()
    {
        return \R::findOne("product", "ORDER BY price LIMIT 1");
    }

    protected function getHtml()
    {
        ob_start();
        
        require_once $this->tpl;

        return ob_get_clean();
    }

    protected function getCategories()
    {
        return \R::getAssoc("SELECT * FROM categories"); 
    }
}

?>