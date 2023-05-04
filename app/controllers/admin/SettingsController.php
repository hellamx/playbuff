<?php 

namespace app\controllers\admin;

use app\models\admin\Admin;

class SettingsController extends AppController
{
    public $attributes = [
        'status' => '', 
        'time_cache' => '',
        'time_cache_currency' => '',
        'api_key' => '',
        'games_perpage' => '',
        'news_perpage' => '',
        'common' => '',
        'rare' => '',
        'legend' => ''
    ];

    public function saveAction()
    {

        if (!empty($_POST['submit']) && $this->isAjax()) {
            $loaded = Admin::settingsLoad($_POST, $this->attributes);

            if (Admin::check($loaded)) {
                $settings = \R::load('settings', 1);
                
                \R::exec('UPDATE roulette SET price = ? WHERE box = ?', [$loaded['common'], 'common']);
                \R::exec('UPDATE roulette SET price = ? WHERE box = ?', [$loaded['rare'], 'rare']);
                \R::exec('UPDATE roulette SET price = ? WHERE box = ?', [$loaded['legend'], 'legend']);

                foreach($loaded as $k => $v) {
                    if ($k == 'id' || $k == 'common' || $k == 'rare' || $k == 'legend') continue;
                    $settings->$k = $v;
                }

                if (\R::store($settings)) {
                    echo '<div class="alert alert-success" role="alert">
                            <strong>Настройки успешно сохранены</strong>
                          </div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                            <strong>Неккоректно заполнены поля</strong>
                          </div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        <strong>Неккоректно заполнены поля</strong>
                      </div>';
            }
        } else {
            throw new \Exception('Страница не найдена', 404);
        }

        die;
    }
}

?>