<?php

// указывает на корень сайта
$root_replaced = str_replace("\\", "/", dirname(__DIR__));
define("ROOT", $root_replaced);

// указывает на публичную папку
define("WWW", ROOT . "/public");

// название сайта
define("SITENAME", "PlayBuff.ru");

// указывает на папку с приложением
define("APP", ROOT . "/app");

// указывает на папку с ядром приложения
define("CORE", ROOT . "/vendor/playbuff/core");

// указывает на папку с библиотеками
define("LIBS", ROOT . "/vendor/playbuff/core/libs");

// указывает на папку с кэшем
define("CACHE", ROOT . "/tmp/cache");

// указывает на папку с конфигурацией
define("CONFIG", ROOT . "/config");

// название шаблона сайта
define("LAYOUT", "default");

// директория сайта
$app_path = "http://{$_SERVER["HTTP_HOST"]}{$_SERVER["PHP_SELF"]}";
$app_path = preg_replace("#[^/]+$#", "", $app_path);
$app_path = str_replace("/public/", "", $app_path);

define("PATH", $app_path);

// путь к админке сайта
define("ADMIN", PATH . "/admin");

// подключение автозагрузчика
require_once ROOT . "/vendor/autoload.php";

// Получение базовых настроек сайта из бд
new \app\models\AppModel();
$settings = \R::findOne('settings', 'id = 1');

// api key for coinapi.io
$api_key = $settings->api_key;
define("API_KEY", $api_key);

// в каком режиме работает приложение
// 1 - разработка, 0 - продакшн
$status = $settings->status;
define("DEBUG", $status);

// Общее время кэширования
$time_cache = $settings->time_cache;
define("TIME_CACHE", $time_cache);

// Время кэширования валют
$time_currency_cache = $settings->time_cache_currency;
define("TIME_CURRENCY_CACHE", $time_currency_cache);

// Количество игр на одной странице
$games_perpage = $settings->games_perpage;
define("GAMES_PERPAGE", $games_perpage);

// Количество новостей на одной странице
$news_perpage = $settings->news_perpage;
define("NEWS_PERPAGE", $news_perpage);


// Устанавливаем язык для валидатора
use Valitron\Validator as V;
V::langDir(ROOT . "/vendor/vlucas/valitron/lang");
V::lang("ru");

?>