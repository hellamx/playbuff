<?php 

use \playbuff\Registry;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?= $meta ?>
  <link href="/argon/assets/img/brand/favicon.png" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="/argon/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/argon/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="/argon/assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <link href="/css/admin.css" rel="stylesheet" />
</head>
<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark bg-default" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="/admin">
        <img src="/argon/assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="/icons/admin-user.svg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="/user/logout" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Выход из аккаунта</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src="/argon/assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item btn-outline-info">
            <a style="color:#fff" class="nav-link" href="/admin/order">
              <i class="ni ni-archive-2"></i> Все заказы
            </a>
          </li>
          <hr class="my-1">
          <li class="nav-item btn-outline-info">
            <a style="color:#fff" class="nav-link" href="/admin/user">
              <i class="ni ni-circle-08"></i> Все пользователи
            </a>
          </li>
          <hr class="my-1">
          <li class="nav-item btn-outline-info">
            <a style="color:#fff" class="nav-link" href="/admin/product">
              <i class="ni ni-box-2 "></i> Все товары
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/products/add">
              <i class="ni ni-fat-add text-primary"></i> Добавить
            </a>
          </li>
          <li class="nav-item btn-outline-info">
            <a style="color:#fff" class="nav-link" href="/admin/gallery">
              <i class="ni ni-cloud-upload-96 "></i> Галерея
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/gallery/add">
              <i class="ni ni-fat-add text-primary"></i> Добавить
            </a>
          </li>
          <li class="nav-item btn-outline-info">
            <a style="color:#fff" class="nav-link" href="/admin/news">
              <i class="ni ni-bullet-list-67 "></i> Все новости
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/news/add">
              <i class="ni ni-fat-add text-primary"></i> Добавить
            </a>
          </li>
          <li class="nav-item btn-outline-info">
            <a style="color:#fff" class="nav-link" href="/admin/keys">
              <i class="ni ni-key-25 "></i> Ключи
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/keys/add">
              <i class="ni ni-fat-add text-primary"></i> Добавить
            </a>
          </li>
          <li class="nav-item btn-outline-info">
            <a style="color:#fff" class="nav-link" href="/admin/category">
              <i class="ni ni-bullet-list-67 "></i> Все категории
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/category/add">
              <i class="ni ni-fat-add text-primary"></i> Добавить
            </a>
          </li> 
          <li class="nav-item btn-outline-info">
            <a style="color:#fff" class="nav-link align-items-center" href="/admin">
              <i class="ni ni-settings-gear-65"></i> Общие настройки
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar bg-default navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block pt-1" href="/admin">Панель управления</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Пользователь: </span>
                  <span class="mb-0 text-sm  font-weight-bold"><?= ucfirst($_SESSION['user']['login']) ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <a href="/" target="_blank" class="dropdown-item">
                <i class="ni ni-curved-next"></i>
                <span>Перейти на сайт</span>
              </a>
              <a href="/user/logout" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Выход</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-default pb-5 pt-0 pt-md-6">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Количество пользователей: </h5>
                      <span class="h2 font-weight-bold mb-0"><?= Registry::getProperty('admin.stats.users') ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted font-weight-bold text-sm">
                    <span class="text-success mr-2"><i class="fa fa-plus"></i> <?= Registry::getProperty('admin.stats.usersPastweek') ?></span>
                    <span class="text-nowrap">За последнюю неделю</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Количество продуктов:</h5>
                      <span class="h2 font-weight-bold mb-0"><?= Registry::getProperty('admin.stats.products') ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                        <i class="ni ni-diamond"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 font-weight-bold text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-plus"></i> <?= Registry::getProperty('admin.stats.productsPastweek') ?></span>
                    <span class="text-nowrap">Добавлено за неделю</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Продажи</h5>
                      <span class="h2 font-weight-bold mb-0"><?= Registry::getProperty('admin.stats.orders') ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-plus"></i> <?= Registry::getProperty('admin.stats.ordersPastWeek') ?></span>
                    <span class="text-nowrap">За неделю</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Товары по акции</h5>
                      <span class="display-2 font-weight-bold mb-0"> <?= Registry::getProperty('admin.stats.promotions') ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?= $content ?>
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; <?= date("Y") ?> Playbuff <a href="/" class="font-weight-bold ml-1" target="_blank">Перейти на сайт</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core   -->
  <script>
    var path = "<?= PATH ?>",
        adminPath = "<?= ADMIN ?>";
  </script>
  <script src="/argon/assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="/argon/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/js/ajaxupload.js"></script>
  <script src="/js/admin.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>