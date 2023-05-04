<?php

use playbuff\Registry;

$settings = Registry::getProperty("admin.settings");

?>
<?php 
  if (isset($_SESSION['admin.alert'])) {
    echo $_SESSION['admin.alert'];
    unset($_SESSION['admin.alert']);
}
    ?>
<div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin">Общие настройки сайта</a>
      </div>
      </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/settings/save" id="adminSettingsForm" method="post">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Состояние сайта</label>
              <select name="status" class="form-control" id="exampleFormControlSelect1">
                <?php 
                if ($settings['status'] == '0') {
                  echo '<option selected value="0">PRODUCTION</option>';
                } else {
                  echo '<option selected value="1">РАЗРАБОТКА</option>';
                }
                ?>
                <option value="1">РАЗРАБОТКА</option>
                <option value="0">PRODUCTION</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Общее время кэширования (в секундах)</label>
              <input name="time_cache" value="<?= $settings['time_cache'] ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Время кэширования">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">API ключ coinapi.io</label>
              <input name="api_key" value="<?= $settings['api_key'] ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="API ключ">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Время кэширования для валюты (в секундах)</label>
              <input name="time_currency_cache" value="<?= $settings['time_cache_currency'] ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Время кэширования валюты">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Цена COMMON бокса (руб.)</label>
              <input name="common" value="<?= $settings['common'] ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Цена">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Цена RARE бокса (руб.)</label>
              <input name="rare" value="<?= $settings['rare'] ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Цена">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Цена LEGEND бокса (руб.)</label>
              <input name="legend" value="<?= $settings['legend'] ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Цена">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Количество игр на одной странице</label>
              <select name="games_perpage" class="form-control" id="exampleFormControlSelect1">
                <?= '<option selected value="' . $settings['games_perpage'] . '">' . $settings['games_perpage'] . '</option>'  ?>
                <option value="4">4</option>
                <option value="8">8</option>
                <option value="12">12</option>
                <option value="16">16</option>
                <option value="20">20</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Количество новостей на одной странице</label>
              <select name="news_perpage" class="form-control" id="exampleFormControlSelect1">
                <?= '<option selected value="' . $settings['news_perpage'] . '">' . $settings['news_perpage'] . '</option>'  ?>
                <option value="3">3</option>
                <option value="6">6</option>
                <option value="9">9</option>
              </select>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Сохранить изменения">
          </form>
        </div>
      </div>