<?php 
if (isset($_SESSION['admin.alert'])) {
    echo $_SESSION['admin.alert'];
    unset($_SESSION['admin.alert']);
}
?>
<div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin/category/add">Добавление категории</a>
      </div>
      </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/category/add" method="post">
            <div class="form-group">
              <label for="exampleFormControlInput1">Название</label>
              <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Название">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Keywords</label>
              <input name="keywords" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ключевые слова">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Description</label>
              <input name="description" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Краткое описание">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Alias (без пробелов, знаков ": ;" и др)</label>
              <input name="alias" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Alias">
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Добавить категорию">
            </form>
        </div>
      </div>