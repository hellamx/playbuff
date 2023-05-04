<?php

use playbuff\Registry;

$product = Registry::getProperty("admin.editProduct");

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
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin/products">Просмотр товара</a>
      </div>
    </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/product/edit" method="post">
            <div class="form-group">
              <label for="title">Название</label>
              <input name="title" id="title" type="text" value="<?= $product['title'] ?>" class="form-control" placeholder="Название">
            </div>
            <div class="form-group" style="display:none">
              <label for="alias">Alias (без пробелов, знаков "; :" и др)</label>
              <input name="alias" id="alias" type="text" value="<?= $product['alias'] ?>" class="form-control" placeholder="Alias">
            </div>
            <div class="form-group">
              <label for="content">Описание</label>
              <textarea id="editor" style="resize:none" class="form-control" id="content" name="content" cols="15" rows="6"><?= $product['content'] ?></textarea> 
            </div>
            <div class="form-group">
              <label for="price">Цена (руб.)</label>
              <input name="price" id="price" value="<?= $product['price'] ?>" type="text" class="form-control" placeholder="Цена">
            </div>
            <div class="form-group">
              <label for="discount">Скидка (%)</label>
              <input name="discount" id="discount" value="<?= $product['discount'] ?>" type="text" class="form-control" placeholder="Скидка">
            </div>
            <div class="form-group">
              <label for="keywords">Keywords</label>
              <input name="keywords" id="keywords" type="text" value="<?= $product['keywords'] ?>" class="form-control" placeholder="Keywords">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <input name="description" id="discription" type="text" value="<?= $product['description'] ?>" class="form-control" placeholder="Description">
            </div>
            <div class="form-group">
              <label for="hit">Популярное</label>
              <select name="hit" id="hit" class="form-control">
                <option value="0">Нет</option>
                <option value="1">Да</option>
              </select>
            </div>
            <div class="form-group">
              <label for="release_date">Дата выхода</label>
              <input name="release_date" id="release_date" value="<?= $product['release_date'] ?>" type="text" class="form-control" placeholder="Дата выхода">
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Сохранить изменения">
          </form>
        </div>
      </div>