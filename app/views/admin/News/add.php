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
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin/news/add">Добавление новости</a>
      </div>
      </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/news/add" enctype="multipart/form-data" id="adminProductAddForm" method="post">
            <div class="form-group">
              <label for="title_content">Заголовок</label>
              <input name="title_content" id="title_content" type="text" class="form-control" placeholder="Заголовок">
            </div>
            <div class="form-group">
              <label for="content">Описание</label>
              <textarea id="editor" style="resize:none" class="form-control" id="content" name="content" cols="15" rows="6"></textarea> 
            </div>
            <div class="form-group">
              <label class="d-block" for="main_image">Изображение</label>
              <input class="form-control" name="main_image" id="main_image" type="file">
              <p><small>Рекомендуемые размеры: 800x360</small></p>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Добавить товар">
          </form>
        </div>
      </div>