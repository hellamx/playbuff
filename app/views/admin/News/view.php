<?php

use playbuff\Registry;

$news = Registry::getProperty("admin.editNews");

if (isset($_SESSION['admin.alert'])) {
  echo $_SESSION['admin.alert'];
  unset($_SESSION['admin.alert']);
}
?>

<div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin/news/<?= $this->route['alias'] ?>">Просмотр новости</a>
      </div>
    </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/news/update" method="post">
            <div class="form-group" style="display:none">
              <label for="id">ID</label>
              <input name="id" id="id" type="text" value="<?= $news['id'] ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="title_content">Название</label>
              <input name="title_content" id="title_content" type="text" value="<?= $news['title_content'] ?>" class="form-control" placeholder="Название">
            </div>
            <div class="form-group">
              <label for="content">Описание</label>
              <textarea id="content" style="resize:none" class="form-control" id="content" name="content" cols="15" rows="6"><?= $news['content'] ?></textarea> 
            </div>
            <div class="form-group">
              <label for="date">Дата</label>
              <input name="date" id="date" value="<?= $news['date'] ?>" type="text" class="form-control" placeholder="Дата">
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Сохранить изменения">
          </form>
        </div>
      </div>