<?php 

namespace app\models;

class Pagination 
{
    public $currentPage;
    public $perpage;
    public $totalItems;
    public $totalCountPages;
    public $uri;
    public $isAdmin;

    public function __construct($page, $perpage, $total, $isAdmin = false)
    {
        $this->perpage = $perpage;
        $this->totalItems = $total;
        $this->totalCountPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
        $this->isAdmin = $isAdmin;
    }

    public function __toString()
    {
        if ($this->isAdmin) {
            return $this->getAdminHtml();     
        }
        return $this->getHtml();
    }

    public function getAdminHtml() {
        $back = null; // ссылка НАЗАД
        $forward = null; // ссылка ВПЕРЕД
        $startpage = null; // ссылка В НАЧАЛО
        $endpage = null; // ссылка В КОНЕЦ
        $page2left = null; // вторая страница слева
        $page1left = null; // первая страница слева
        $page2right = null; // вторая страница справа
        $page1right = null; // первая страница справа

        if( $this->currentPage > 1 ){
            $back = "<li class='page-item'>
                        <a class='page-link' href='{$this->uri}page=" .($this->currentPage - 1). "' tabindex='-1'>
                        <i class='fas fa-angle-left'></i>
                        <span class='sr-only'>Previous</span>
                        </a>
                    </li>";
        }
        if( $this->currentPage < $this->totalCountPages ){
            $forward = "<li class='page-item'>
                            <a class='page-link' href='{$this->uri}page=" .($this->currentPage + 1). "'>
                            <i class='fas fa-angle-right'></i>
                            <span class='sr-only'>Next</span>
                            </a>
                        </li>";
        }
        if( $this->currentPage > 3 ){
            $startpage = "<li class='page-item'>
                            <a class='page-link' href='{$this->uri}page=1'>1</a>
                          </li>";
        }
        if( $this->currentPage < ($this->totalCountPages - 2) ){
            $endpage = "<li class='page-item'>
                            <a class='page-link' href='{$this->uri}page={$this->totalCountPages}'>{$this->totalCountPages}</a>
                        </li>";
        }
        if( $this->currentPage - 2 > 0 ){
            $page2left = "<li class='page-item'>
                            <a class='page-link' href='{$this->uri}page=" .($this->currentPage-2). "'>" .($this->currentPage - 2). "</a>
                          </li>";
        }
        if( $this->currentPage - 1 > 0 ){
            $page1left = "<li class='page-item'>
                            <a class='page-link' href='{$this->uri}page=" .($this->currentPage-1). "'>" .($this->currentPage-1). "</a>
                          </li>";
        }
        if( $this->currentPage + 1 <= $this->totalCountPages ){
            $page1right = "<li class='page-item'>
                            <a class='page-link' href='{$this->uri}page=" .($this->currentPage + 1). "'>" .($this->currentPage+1). "</a>
                          </li>";
        }
        if( $this->currentPage + 2 <= $this->totalCountPages ){
            $page2right = "<li class='page-item'>
                            <a class='page-link' href='{$this->uri}page=" .($this->currentPage + 2). "'>" .($this->currentPage + 2). "</a>
                          </li>";
        }

        return $startpage.$back.$page2left.$page1left.'<li class="page-item active"><a class="page-link" href="#">'.$this->currentPage.'</a></li>'.$page1right.$page2right.$forward.$endpage;
    
    }

    public function getHtml() {
        $back = null; // ссылка НАЗАД
        $forward = null; // ссылка ВПЕРЕД
        $startpage = null; // ссылка В НАЧАЛО
        $endpage = null; // ссылка В КОНЕЦ
        $page2left = null; // вторая страница слева
        $page1left = null; // первая страница слева
        $page2right = null; // вторая страница справа
        $page1right = null; // первая страница справа

        if( $this->currentPage > 1 ){
            $back = "<li><a href='{$this->uri}page=" .($this->currentPage - 1). "'>&lt;</a></li>";
        }
        if( $this->currentPage < $this->totalCountPages ){
            $forward = "<li><a href='{$this->uri}page=" .($this->currentPage + 1). "'>&gt;</a></li>";
        }
        if( $this->currentPage > 3 ){
            $startpage = "<li><a href='{$this->uri}page=1'>&laquo;</a></li>";
        }
        if( $this->currentPage < ($this->totalCountPages - 2) ){
            $endpage = "<li><a href='{$this->uri}page={$this->totalCountPages}'>&raquo;</a></li>";
        }
        if( $this->currentPage - 2 > 0 ){
            $page2left = "<li><a href='{$this->uri}page=" .($this->currentPage-2). "'>" .($this->currentPage - 2). "</a></li>";
        }
        if( $this->currentPage - 1 > 0 ){
            $page1left = "<li><a href='{$this->uri}page=" .($this->currentPage-1). "'>" .($this->currentPage-1). "</a></li>";
        }
        if( $this->currentPage + 1 <= $this->totalCountPages ){
            $page1right = "<li><a href='{$this->uri}page=" .($this->currentPage + 1). "'>" .($this->currentPage+1). "</a></li>";
        }
        if( $this->currentPage + 2 <= $this->totalCountPages ){
            $page2right = "<li><a href='{$this->uri}page=" .($this->currentPage + 2). "'>" .($this->currentPage + 2). "</a></li>";
        }

        return $startpage.$back.$page2left.$page1left.'<li class="pagination--active"><a>'.$this->currentPage.'</a></li>'.$page1right.$page2right.$forward.$endpage;
    }

    public function getCountPages()
    {
        $verify = ceil($this->totalItems / $this->perpage);

        if ($verify) {
            return $verify;
        }

        return 1;
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) $page = 1; // если номер страницы не устраивает условию, то приравниваем 1

        if ($page > $this->totalCountPages) $page = $this->totalCountPages; // если указана страница бОльшая чем количество имеющихся страниц, то присваиваем ей макс. колво стр.

        return $page;

    }

    public function getStart() // вычисление числа с какой записи нужно взять данные (LIMIT n, k)
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        preg_match_all("#(filter=[\w]+)&(category=[\w]+)&(price=[\w]+)#", $url, $matches);

        if (count($matches[0]) > 1) {
            $url = preg_replace("#(filter=[\w]+&)(category=[\w]+&)(price=[\w]+&)#", "", $url, 1);
        }

        $url = explode("?", $url);
         
        $uri = $url[0] . "?";
        if (isset($url[1]) && $url[1] != "") {
            $params = explode("&", $url[1]);

            foreach($params as $param){
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
            }
        }
        return urldecode($uri);
    }
}

?>