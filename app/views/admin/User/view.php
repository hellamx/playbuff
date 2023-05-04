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
        <a class="settings__title h3 mt-4 mb-4 text-default text-uppercase d-none d-lg-inline-block" href="/admin/user/">Профиль <?= $user->login ?></a>
      </div>
      </div>
      <div class="col pl-0">
        <div class="pl-0 col">
          <form action="/admin/user/save" id="adminUserForm" method="post">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Состояние</label>
              <select name="ban" class="form-control" id="exampleFormControlSelect1">
                <?php 
                if ($user['ban'] == '0') {
                  echo '<option selected value="0">Активный</option>';
                } else {
                  echo '<option selected value="1">Пользователь заблокирован</option>';
                }
                ?>
                <option value="0">Активный</option>
                <option value="1">Заблокировать</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">ID</label>
              <input name="id" disabled value="<?= $user->id ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Время кэширования">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Дата регистрации</label>
              <input name="date_signup" disabled value="<?= $user->date_signup ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Время кэширования">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Логин</label>
              <input name="login" value="<?= $user->login ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Время кэширования">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Email</label>
              <input name="email" value="<?= $user->email ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="API ключ">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Баланс (руб.)</label>
              <input name="balance" value="<?= $user->balance ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="API ключ">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Роль</label>
              <select name="role" class="form-control" id="exampleFormControlSelect1">
                <?php 
                if ($user['role'] == '0') {
                  echo '<option selected value="0">Пользователь</option>';
                } else {
                  echo '<option selected value="1">Администратор</option>';
                }
                ?>
                <option value="0">Пользователь</option>
                <option value="1">Администратор</option>
              </select>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Сохранить изменения">
            <a href="/admin/user/delete?id=<?= $user->id ?>" class="btn btn-lg text-white bg-danger btn-block">Удалить пользователя</a>
          </form>
        </div>
      </div>