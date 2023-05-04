<?php

use playbuff\Registry;

$user = Registry::getProperty("admin.userprofile");

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
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin/gallery/add">Добавление изображения</a>
      </div>
      </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/gallery/add" enctype="multipart/form-data" method="post">
            <div class="form-group">
              <label for="game_id">Игра</label>
              <select name="game_id" class="form-control" id="game_id">
                <?php foreach(\R::getAll("SELECT id, title FROM product") as $value): ?>
                    <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="alt">ALT</label>
              <input name="alt" id="alt" type="text" class="form-control" placeholder="ALT (название игры)">
            </div>
            <div class="form-group">
              <label class="d-block" for="main_image">Изображение</label>
              <input class="form-control" name="main_image" id="main_image" type="file">
              <p><small>Рекомендуемые размеры: 600x365</small></p>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Добавить товар">
          </form>
        </div>
      </div>