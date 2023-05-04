<?php

use playbuff\App;

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
          <a class="h3 mt-4 mb-0 text-default text-uppercase d-none d-lg-inline-block" href="/admin/order">История заказов</a>
        </div>
      </div>
      
      <div class="col mt-4 pl-0">
          <div class="card shadow">
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="text-sm text-light thead-dark">
                  <tr>
                    <th class="text-sm text-light" scope="col">ID</th>
                    <th class="text-sm text-light" scope="col">ID пользователя</th>
                    <th class="text-sm text-light" scope="col">Дата</th>
                    <th class="text-sm text-light" scope="col">Сумма</th>
                    <th class="text-sm text-light" scope="col">Товары</th>
                    <th class="text-sm text-light" scope="col">E-mail пользователя</th>
                    <th class="text-sm text-light" scope="col">Способ оплаты</th>
                    <th class="text-sm text-light" scope="col">Промокод</th>
                    <th class="text-sm text-light" scope="col">Управление</th>
                  </tr>
                </thead>
                <?php foreach($data as $v): ?>
                <tbody>
                  <tr>
                    <td><?= $v['id'] ?></td>
                    <td><?= $v['user_id'] ?></td>
                    <td><?= $v['date'] ?></td>
                    <td><?= str_replace(':', ' ', $v['sum']) ?></td>
                    <td><?= \app\models\admin\Admin::getGames($v['products']) ?></td>
                    <td><?= $v['user_email'] ?></td>
                    <td><?= $v['pay_method'] ?></td>
                    <td><?= $v['promocode'] ?></td>
                    <td>
                      <a href="?delete=<?= $v['id'] ?>" class="btn btn-sm btn-danger">Удалить</a>
                    </td>
                  </tr>
                </tbody>
                <?php endforeach; ?>
              </table>
            </div>
            <?php if(App::$app::getProperty("admin.ordersPagination")): ?>
            <div class="card-footer ">
              <nav aria-label="...">
                <ul class="pagination justify-content-center mb-0">
                  <?= App::$app::getProperty("admin.ordersPagination") ?>
                </ul>
              </nav>
            </div>
            <?php endif; ?>
          </div>
        </div>