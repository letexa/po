<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\BaseAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

BaseAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <?php $this->head() ?>

</head>

<body id="page-top">
  <?php $this->beginBody() ?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Apple Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item active">
        <a class="nav-link" href="/apple">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Яблоки</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="/color">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Цвета</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="/status">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Статусы</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="/status-log">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Логи статусов</span></a>
      </li>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Topbar Search -->
          <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"></div>

            <div class="topbar-divider d-none d-sm-block"></div>

            
            <?=
                Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
            ?>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Главная', 'url' => '/'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ]) ?>
          <?= Alert::widget() ?>
          <?= $content ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
