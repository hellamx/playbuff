<?php

namespace playbuff;

class Db 
{
    use TSingletone;

    protected function __construct() 
    {
        $db = require_once CONFIG . "/db.php";
        require_once LIBS . "/rb.php";

        \R::setup($db['dsn'], $db['user'], $db['password']);
        \R::freeze(true);

        if (!\R::testConnection()) {
            throw new \Exception("Не удалось установить соединение с базой данных", 500);
        }
    }
}

?>