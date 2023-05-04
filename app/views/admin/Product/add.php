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
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin/products/add">Добавление товара</a>
      </div>
      </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/products/add" enctype="multipart/form-data" id="adminProductAddForm" method="post">
            <div class="form-group">
              <label for="category_id">Категория</label>
              <select name="category_id" class="form-control" id="category_id">
                <?php foreach(\R::getAll("SELECT id, title FROM categories") as $value): ?>
                    <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="title">Название</label>
              <input name="title" id="title" type="text" class="form-control" placeholder="Название">
            </div>
            <div class="form-group">
              <label for="alias">Alias (без пробелов, знаков "; :" и др)</label>
              <input name="alias" id="alias" type="text" class="form-control" placeholder="Alias">
            </div>
            <div class="form-group">
              <label for="content">Описание</label>
              <textarea id="editor" style="resize:none" class="form-control" id="content" name="content" cols="15" rows="6"></textarea> 
            </div>
            <div class="form-group">
              <label for="price">Цена (руб.)</label>
              <input name="price" id="price" type="text" class="form-control" placeholder="Цена">
            </div>
            <div class="form-group">
              <label for="discount">Скидка (%)</label>
              <input name="discount" id="discount" value="0" type="text" class="form-control" placeholder="Скидка">
            </div>
            <div class="form-group">
              <label for="keywords">Keywords</label>
              <input name="keywords" id="keywords" type="text" class="form-control" placeholder="Keywords">
            </div>
            <div class="form-group">
              <label for="discription">Description</label>
              <input name="discription" id="discription" type="text" class="form-control" placeholder="Description">
            </div>
            <div class="form-group">
              <label for="hit">Популярное</label>
              <select name="hit" id="hit" class="form-control" id="exampleFormControlSelect1">
                <option value="0">Нет</option>
                <option value="1">Да</option>
              </select>
            </div>
            <div class="form-group">
              <label for="release_date">Дата выхода</label>
              <input name="release_date" id="release_date" type="text" class="form-control" placeholder="Дата выхода">
            </div>
            <div class="form-group">
              <label class="d-block" for="main_image">Обложка</label>
              <input class="form-control" name="main_image" id="main_image" type="file">
              <p><small>Рекомендуемые размеры: 245x300</small></p>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Добавить товар">
          </form>
        </div>
      </div>