<?php

namespace playbuff;

class ErrorHandler 
{
    public function __construct()
    {
        error_reporting(0);
     
        if (DEBUG == 1) {
            error_reporting(-1);
        }
     
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError("Исключение", $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($message = "", $file = "", $line = "")
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$message}, 
                                              \n Файл ошибки: {$file},
                                              \n Строка ошибки: {$line} 
                                              \n ------------------- \n",
                                              3,
                                              ROOT . "/tmp/errors.log");
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $response = "404")
    {
        http_response_code($response);

        if ($response == "404" && !DEBUG) {
            require_once WWW . "/errors/404.php";
            die;
        }

        if (!DEBUG) {
            require_once WWW . "/errors/prod.php";
        } else {
            require_once WWW . "/errors/dev.php";
        }

        die;
    }
}

?>