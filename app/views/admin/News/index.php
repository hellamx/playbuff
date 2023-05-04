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
          <a class="h3 mt-4 mb-0 text-default text-uppercase d-none d-lg-inline-block" href="/admin/gallery">Все фотографии</a>
        </div>
      </div>
      <div class="col mt-4 pl-0">
          <div class="card shadow">
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="text-sm text-light thead-dark">
                  <tr>
                    <th class="text-sm text-light" scope="col">ID</th> 
                    <th class="text-sm text-light" scope="col">Заголовок</th>
                    <th class="text-sm text-light" scope="col">Дата</th>
                    <th class="text-sm text-light" scope="col">Действие</th>
                  </tr>
                </thead>
                <?php foreach($data as $key => $v): ?>
                <tbody>
                  <tr>
                    <td><?= $v['id'] ?></td>
                    <td><a href="/admin/news/<?= $v['id'] ?>"><?= $v['title_content'] ?></a></td>
                    <td><?= $v['date'] ?></td>
                    <td>
                      <a href="?delete=<?= $v['id'] ?>" class="btn btn-sm btn-danger">Удалить</a>
                    </td>
                  </tr>
                </tbody>
                <?php endforeach; ?>
              </table>
            </div>
            <?php if(App::$app::getProperty("admin.newsPagination")): ?>
            <div class="card-footer ">
              <nav aria-label="...">
                <ul class="pagination justify-content-center mb-0">
                  <?= App::$app::getProperty("admin.newsPagination") ?>
                </ul>
              </nav>
            </div>
            <?php endif; ?>
          </div>
        </div>