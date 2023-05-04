<?php

namespace playbuff\base;

class View 
{
    public $route;
    public $model;
    public $view;
    public $controller;
    public $prefix;
    public $layout;
    public $data = [];
    public $meta = [];

    public function __construct($route, $layout = "", $view = "", $meta)
    {
        $this->route = $route;
        $this->controller = $route["controller"];
        $this->view = $view;
        $this->model = $route["controller"];
        $this->prefix = $route["prefix"];
        $this->meta = $meta;

        if ($layout === false) {
            $this->layout = false;
        } else {
            if ($layout) {
                $this->layout = $layout;
            } else {
                $this->layout = LAYOUT;
            }
        }
    }

    public function render($data) 
    {
        $viewPath = APP . "/views/" . str_replace('\\', '/', $this->prefix) . "/" . "{$this->controller}/{$this->view}.php";
        
        if (is_file($viewPath)) {
            
            
            $meta = self::getMeta();
            ob_start();
            
            require_once $viewPath;
            $content = ob_get_clean();

        } else {
            throw new \Exception("Не найден view: {$viewPath}", 500);
        }

        if ($this->layout !== false) {
            $layoutPath = APP . "/views/layouts/{$this->layout}.php";
            
            if(is_file($layoutPath)) {
                require_once $layoutPath;
            } else {
                throw new \Exception("Не найден layout: {$layoutPath}");
            }
        }

    }

    public function getMeta() 
    {
        $output = "<title>{$this->meta['title']}</title>" . PHP_EOL;
        if(!empty($this->meta['keywords'])) $output .= "\t\t<meta name='keywords' content='{$this->meta['keywords']}'>" . PHP_EOL;
        if(!empty($this->meta['description'])) $output .= "\t\t<meta name='description' content='{$this->meta['description']}'>" . PHP_EOL;

        return $output;
    }
}

?>