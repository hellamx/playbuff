<?php 

namespace app\models\admin;

class Admin extends \app\models\AppModel
{
    public $fields = [];

    public static function getStat()
    {
        // Общее количество пользователей и количество новых пользователей за последнюю неделю
        $users = \R::count('user');
        $usersWeek = \R::count('user', 'YEAR(date_signup) = YEAR(NOW()) AND WEEK(date_signup) = WEEK(NOW())');
        
        // Общее количество товаров и количество новых товаров за последнюю неделю
        $products = \R::count('product');
        $productsWeek = \R::count('product', 'YEAR(date_add) = YEAR(NOW()) AND WEEK(date_add) = WEEK(NOW())');

        // Общее количество заказов за последнюю неделю
        $orders = \R::count('order');
        $ordersWeek = \R::count('order', 'YEAR(date) = YEAR(NOW()) AND WEEK(date) = WEEK(NOW())');

        // Общее количество товаров по акции
        $promotions = \R::count('product', 'discount > 0');

        // Запись в регистр
        \playbuff\App::$app::setProperty('admin.stats.users', $users);
        \playbuff\App::$app::setProperty('admin.stats.usersPastweek', $usersWeek);

        \playbuff\App::$app::setProperty('admin.stats.products', $products);
        \playbuff\App::$app::setProperty('admin.stats.productsPastweek', $productsWeek);

        \playbuff\App::$app::setProperty('admin.stats.orders', $orders);
        \playbuff\App::$app::setProperty('admin.stats.ordersPastWeek', $ordersWeek);

        \playbuff\App::$app::setProperty('admin.stats.promotions', $promotions);
    }

    public static function getGames($games)
    {
        $all = [];
        $titles = '';
        $gamesArr = explode(';', $games);
        foreach ($gamesArr as $k => $v) {
            $all[] = explode('-', $v, 2);
        }
        foreach ($all as $v) {
            $game_title = \R::findOne('product', 'WHERE id = ?', [$v[0]]);
            if(count($all) > 2) { 
                $titles .= $game_title['title'] . '<br>';
            } else {
                return $titles = $game_title['title'];
            }
        }
        return $titles;
    }

    public static function delete(string $table, int $id)
    {
        return \R::trash($table, $id);
    }

    public static function settingsLoad(array $data, array $fields)
    {
        $loaded = [];

        foreach($data as $k => $v) {
            if (isset($fields[$k])) {
                $loaded[$k] = dataClear($v);
            }
        }
        
        return $loaded;
    }

    public static function check(array $data)
    {
        foreach($data as $k => $v) {
            if (!$v and $k != 'status') {
                return false;
            }

            if ($k == 'time_cache' && !(int)$v) return false;
            if ($k == 'time_currency_cache' && !(int)$v) return false;
            if ($k == 'common' && !(int)$v) return false;
            if ($k == 'rare' && !(int)$v) return false;
            if ($k == 'legend' && !(int)$v) return false;
            if ($k == 'games_perpage' && !(int)$v) return false;
            if ($k == 'news_perpage' && !(int)$v) return false;
        }

        return true;
    }

    public static function getSettings()
    {
        $data = [
            'status' => null,
            'time_cache' => null,
            'time_cache_currency' => null,
            'api_key' => null,
            'games_perpage' => null,
            'news_perpage' => null,
            'common' => null,
            'rare' => null,
            'legend' => null
        ];

        $settings = \R::findOne('settings', 'id = 1');
        $boxes = \R::findAll('roulette');

        foreach($settings as $k => $v) {
            if ($k == 'id') continue;
            $data[$k] = $v;
        }

        foreach($boxes as $k => $v) {
            $data[$v['box']] = $v['price'];
        }

        return $data;
    }

    public static function getProducts($start, $perpage)
    {
        return \R::findAll("product", "ORDER BY id DESC LIMIT {$start}, $perpage");
    }

    public static function getUsers($start, $perpage)
    {
        return \R::findAll("user", "ORDER BY id DESC LIMIT {$start}, $perpage");
    }

    public static function getCategories()
    {
        return \R::findAll("categories", "ORDER BY id DESC");
    }

    public static function update(int $id, string $table, array $data)
    {
        $sth = \R::load($table, $id);
        foreach($data as $key => $field) {
            $sth->$key = $field;
        }
        return \R::store($sth);
    }
}


?>