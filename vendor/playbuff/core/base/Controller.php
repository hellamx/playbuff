<?php

namespace playbuff\base;

class Controller 
{
    public $route;
    public $model;
    public $view;
    public $controller;
    public $prefix;
    public $layout;
    public $data = [];
    public $meta = ["title" => "", "description" => "", "keywords" => ""];

    public function __construct($route)
    {
        $this->route = $route;
        $this->model = $route["controller"];
        $this->view = $route["action"];
        $this->controller = $route["controller"];
        $this->prefix = $route["prefix"];

    }

    public function getView() {
        $viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObject->render($this->data);

    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function setMeta($title = "", $description = "", $keywords = "")
    {
        $this->meta["title"] = $title;
        $this->meta["description"] = $description;
        $this->meta["keywords"] = $keywords;
    }

    public function isAjax()
    {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest";
    }

    public function loadView($view, $vars = [])
    {
        extract($vars);
        require_once APP . "/views/{$this->prefix}{$this->controller}/{$view}.php";
        die;
    }

}

?>