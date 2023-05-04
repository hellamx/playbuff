<?php

use playbuff\Router;

// административные пользовательские правила
Router::add("^admin/news/add/?$", ["controller" => "News", "action" => "add", "prefix" => "admin"]);
Router::add("^admin/news/update/?$", ["controller" => "News", "action" => "update", "prefix" => "admin"]);
Router::add("^admin/news/(?P<alias>[a-z0-9-]+)/?$", ["controller" => "News", "action" => "view", "prefix" => "admin"]);
Router::add("^admin/product/edit/?$", ["controller" => "Product", "action" => "edit", "prefix" => "admin"]);
Router::add("^admin/products/(?P<alias>[a-z0-9-]+)/?$", ["controller" => "Product", "action" => "add", "prefix" => "admin"]);
Router::add("^admin/product/(?P<alias>[a-z0-9-]+)/?$", ["controller" => "Product", "action" => "view", "prefix" => "admin"]);
Router::add("^admin/user/(?P<alias>[0-9-]+)/?$", ["controller" => "User", "action" => "view", "prefix" => "admin"]);
Router::add("^admin/category/(?P<alias>[0-9-]+)/?$", ["controller" => "Category", "action" => "view", "prefix" => "admin"]);

// пользовательские правила
Router::add("^news/(?P<alias>[a-z0-9-]+)/?$", ["controller" => "News", "action" => "view"]);
Router::add("^product/(?P<alias>[a-z0-9-]+)/?$", ["controller" => "Product", "action" => "view"]);
Router::add("^categories/(?P<alias>[a-z0-9-]+)/?$", ["controller" => "Categories", "action" => "view"]);
Router::add("^tags/(?P<alias>[a-z0-9-]+)/?$", ["controller" => "Tags", "action" => "view"]);

// шаблоны по умолчанию для административной части приложения
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

// шаблоны по умолчанию для пользовательской части приложения
Router::add("^$", ["controller" => "Main", "action" => "index"]);
Router::add("^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$");

?>