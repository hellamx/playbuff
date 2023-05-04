<?php 
    if (isset($_SESSION['admin.alert'])) {
      echo $_SESSION['admin.alert'];
      unset($_SESSION['admin.alert']);
    }
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-auto">
          <a class="h3 mt-4 mb-0 text-default text-uppercase d-none d-lg-inline-block" href="/admin/category">Список категорий</a>
        </div>
      </div>
      
      <div class="col mt-4 pl-0">
          <div class="card shadow">
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="text-sm text-light thead-dark">
                  <tr>
                    <th class="text-sm text-light" scope="col">ID</th>
                    <th class="text-sm text-light" scope="col">Название</th>
                    <th class="text-sm text-light" scope="col">Keywords</th>
                    <th class="text-sm text-light" scope="col">Description</th>
                    <th class="text-sm text-light" scope="col">Alias</th>
                  </tr>
                </thead>
                <?php foreach($data as $v): ?>
                <tbody>
                  <tr>
                    <td><?= $v['id'] ?></td>
                    <td><a href="/admin/category/<?= $v['id'] ?>"><?= $v['title'] ?></a></td>
                    <td><?= $v['keywords'] ?></td>
                    <td><?= $v['description'] ?></td>
                    <td><?= $v['alias'] ?></td>
                  </tr>
                </tbody>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>