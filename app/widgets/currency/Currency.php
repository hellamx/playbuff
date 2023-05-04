<?php 

namespace app\widgets\currency;
use playbuff\App;

class Currency 
{
    protected $template;
    protected $currencies;
    protected $currency;

    public function __construct()
    {
        $this->template = __DIR__ . "/currency_template/currency.php";
        $this->run();
    }

    protected function run ()
    {
        $this->currencies = App::$app->getProperty("currencies");
        $this->currency = App::$app->getProperty("currency");

        echo $this->getHtml();
    }

    public static function getCurrencies()
    {
        return \R::getAssoc("SELECT `code`, `title`, `symbol`, `base`, `value` FROM `currency` ORDER BY `base` DESC");
    }

    public static function getCurrency ($currencies) 
    {
        if (isset($_COOKIE["currency"]) and array_key_exists($_COOKIE["currency"], $currencies)) {
            $key = $_COOKIE["currency"];
        } else {
            $key  = key($currencies);
        }

        $currency = $currencies[$key];
        $currency["code"] = $key;

        return $currency;
    }

    public static function updateExchangeRate() 
    {
        $currencyCacheKey = "currencyExchange";

        if (App::$cache::get($currencyCacheKey)) {
            App::$app::setProperty("currencyExchange", App::$cache::get($currencyCacheKey));
        } else {
            $asset_id_base = 'USDT';
            $asset_id_quote = 'RUB';

            $capi = new \CoinAPI(API_KEY);
            $value = $capi->GetExchangeRate($asset_id_base, $asset_id_quote);
            $value = round($value->rate, 2);
            App::$cache::set($currencyCacheKey, $value, TIME_CURRENCY_CACHE);
            App::$app::setProperty("currencyExchange", $value);

            $new_value = 1 / $value;
            $sql = "UPDATE `currency` SET value = $new_value WHERE `code` = 'USD'";
            \R::exec($sql);
        }
    }

    protected function getHtml() 
    {
        ob_start();
        require_once $this->template;
        return ob_get_clean();
    }
}

?>