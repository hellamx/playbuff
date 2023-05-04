<?php

use playbuff\Registry;

$category = Registry::getProperty("admin.categoryView");

if (isset($_SESSION['admin.alert'])) {
    echo $_SESSION['admin.alert'];
    unset($_SESSION['admin.alert']);
}
?>
<div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin/user/">Категория: <?= $category->title ?></a>
      </div>
      </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/category/save" id="adminCategoryForm" method="post">
            <div class="form-group">
              <label for="exampleFormControlInput1">ID</label>
              <input name="id" disabled value="<?= $category->id ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="ID">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Название</label>
              <input name="title" value="<?= $category->title ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Название">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Ключевые слова</label>
              <input name="keywords" value="<?= $category->keywords ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ключевые слова">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Краткое описание</label>
              <input name="description" value="<?= $category->description ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Краткое описание">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Alias (без пробелов, знаков ": ;" и др.)</label>
              <input name="alias" value="<?= $category->alias ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Alias">
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Сохранить изменения">
        </form>
        </div>
      </div>