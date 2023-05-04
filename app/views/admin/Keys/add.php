<?php 
if (isset($_SESSION['admin.alert'])) {
    echo $_SESSION['admin.alert'];
    unset($_SESSION['admin.alert']);
}
?>
<div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin/keys/add">Добавление ключей</a>
      </div>
      </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/keys/add" method="post">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Игра</label>
                <select name="id" class="form-control" id="exampleFormControlSelect1">
                    <?php foreach($data as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>        
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Платформа</label>
              <select name="platform" class="form-control" id="exampleFormControlSelect1">
                <option value="steam">Steam</option>
                <option value="origin">Origin</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Ключ</label>
              <input name="key" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ключ">
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Добавить ключ">
            </form>
        </div>
      </div>