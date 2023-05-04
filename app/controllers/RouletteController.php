<?php 

namespace app\controllers;

use playbuff\App;

class RouletteController extends AppController
{
    public function indexAction()
    {
        $this->setMeta("Испытай удачу | " . SITENAME);
        App::$app::setProperty("canonical", PATH . '/roulette');

        if(!isset($_SESSION['user'])) {
            $_SESSION['alert'] = '<span 
                                    style="padding: 10px 15px; font-size:14px; margin: 0 0 20px 0" class="alert error">
                                    Раздел доступен только авторизованным пользователям
                                  </span>';
            
            redirect('/');
        }
    }

    public static function getOnePrice(string $view)
    {
        return \R::getRow("SELECT price FROM roulette WHERE box = ?", [$view])['price'];
    }

    /**
     * Получить цену лут-бокса
    */
    public function getPriceAction()
    {
        if($this->isAjax() && !empty($_POST['box'])) {
            
            $box = dataClear($_POST['box']);
            $boxes = \R::findOne('roulette', 'box = ?', [$box]);

            if($boxes) {
                echo $boxes->price;
            } else {
                throw new \Exception('Ошибка сервера', 500);
            }
        } else {
            throw new \Exception('Страница не найдена', 404);
        }
        die;
    }

    public function playAction()
    {
        if ($this->isAjax() && !empty($_POST['box'])) {

            $output = ['response' => true, 'games' => null, 'winner' => null, 'price' => null, 'winnerTitle' => null]; // Возвращаемые данные в js файл

            $box = dataClear($_POST['box']);
            $boxes = \R::findOne('roulette', 'box = ?', [$box]);

            $output['price'] = $boxes->price;
            
            $countGames = \R::count('product');

            if ($boxes && $_SESSION['user']['balance'] >= $boxes->price) {
                
                $_SESSION['user']['balance'] = $_SESSION['user']['balance'] - $boxes->price;
                \R::exec('UPDATE user SET balance = ? WHERE id = ?', [$_SESSION['user']['balance'], $_SESSION['user']['id']]); // меняем баланс

                switch($box) {
                    case 'common':
        
                        $start = \R::getAll('SELECT id, title, price, main_image FROM product ORDER BY price LIMIT 3');
                        $output['games'][0] = $start[rand(0, 2)];
                        $output['games'][1] = $start[rand(0, 2)];
                        $output['games'][2] = $start[rand(0, 2)];

                        $middle = \R::getAll("SELECT id, title, price, main_image FROM product ORDER BY price");
                        $output['games'][3] = $middle[rand(3, $countGames - 2)];
                        $output['games'][4] = $middle[rand(3, $countGames - 2)];
                        $output['games'][5] = $middle[$countGames - 1];

                        $random = rand(0, 100);

                        switch($random) {
                            case  ($random <= 70):
                                $output['winner'] = $output['games'][rand(0, 2)]['id'];
                                break;
                            case ($random > 70 && $random < 95):
                                $output['winner'] = $output['games'][rand(3, 5)]['id'];
                                break;
                            case ($random >= 95):
                                $output['winner'] = $output['games'][5]['id'];
                                break;
                        }

                        break;

                    case 'rare':

                        $start = \R::getAll('SELECT id, title, price, main_image FROM product ORDER BY price LIMIT 2');
                        $output['games'][0] = $start[rand(0, 1)];
                        $output['games'][1] = $start[rand(0, 1)];

                        $middle = \R::getAll("SELECT id, title, price, main_image FROM product ORDER BY price");
                        $output['games'][2] = $middle[rand(2, $countGames - 2)];
                        $output['games'][3] = $middle[rand(2, $countGames - 2)];
                        $output['games'][4] = $middle[rand(2, $countGames - 2)];
                        $output['games'][5] = $middle[$countGames - 1];

                        $random = rand(0, 100);

                        switch($random) {
                            case  ($random <= 60):
                                $output['winner'] = $output['games'][rand(0, 1)]['id'];
                                break;
                            case ($random > 60 && $random < 90):
                                $output['winner'] = $output['games'][rand(2, 4)]['id'];
                                break;
                            case ($random >= 90):
                                $output['winner'] = $output['games'][5]['id'];
                                break;
                        }

                        break;
                    case 'legend':
 
                        $start = \R::getAll('SELECT id, title, price, main_image FROM product ORDER BY price LIMIT 2');
                        $output['games'][0] = $start[0];
                        $output['games'][1] = $start[1];

                        $middle = \R::getAll("SELECT id, title, price, main_image FROM product ORDER BY price");
                        $output['games'][2] = $middle[rand(2, $countGames - 2)];
                        $output['games'][3] = $middle[rand(2, $countGames - 2)];

                        $end = \R::getAll("SELECT id, title, price, main_image FROM product ORDER BY price DESC LIMIT 3");
                        $output['games'][4] = $end[rand(0, 2)];
                        $output['games'][5] = $end[rand(0, 2)];

                        $random = rand(0, 100);

                        switch($random) {
                            case  ($random <= 55):
                                $output['winner'] = $output['games'][rand(0, 1)]['id'];
                                break;
                            case ($random > 55 && $random < 85):
                                $output['winner'] = $output['games'][rand(2, 3)]['id'];
                                break;
                            case ($random >= 85):
                                $output['winner'] = $output['games'][rand(4, 5)]['id'];
                                break;
                        }

                        break;
                }
                
                $gameMail = \R::findOne('product', 'id = ?', [$output['winner']]);
                $dataMail = \R::findOne('game_keys', 'game_id = ?', [$output['winner']]);
                $html = 'Ваш ключ из рулетки: ' . $dataMail->game_key . '<br>Игра: <b>' . $gameMail->title . '</b>';

                $output['winnerTitle'] = $gameMail->title;

                \app\models\Order::sendMailOrder($_SESSION['user']['id'], $_SESSION['user']['email'], $html);
            } else {
                $output['response'] = false;
            }

            header('Content-Type: aplication/json; charset=utf-8');
            echo json_encode($output);

        } else {
            throw new \Exception('Страница не найдена', 404);
        }

        die;
    }
}

?>