<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($pageTitle) ? $pageTitle : 'New Page Title'; ?></title>
  <!--favicon-->
	<link rel="icon" href="<?= base_url('public/assets/uploads/logo/' .getCompanyData('company_favicon')) ?>" type="image/png">
  <!-- loader-->
	<link href="<?= base_url('public/admin/assets/css/pace.min.css') ?>" rel="stylesheet">
	<script src="<?= base_url('public/admin/assets/js/pace.min.js') ?>"></script>

  <!--plugins-->
  <link href="<?= base_url('public/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin/assets/plugins/metismenu/metisMenu.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin/assets/plugins/metismenu/mm-vertical.css') ?>">
  <!--bootstrap css-->
  <link href="<?= base_url('public/admin/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
  <!--main css-->
  <link href="<?= base_url('public/admin/assets/css/bootstrap-extended.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/main.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/dark-theme.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/blue-theme.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/responsive.css') ?>" rel="stylesheet">

  </head>

  <body>

    <!--authentication-->
    <div class="auth-basic-wrapper d-flex align-items-center justify-content-center">
      <div class="container-fluid my-5 my-lg-0">
        <div class="row">
           <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
            <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
              <?= $this->renderSection('content') ?>
            </div>
           </div>
        </div><!--end row-->
     </div>
    </div>
    <!--authentication-->


    <!--plugins-->
    <script src="<?= base_url('public/admin/assets/js/jquery.min.js') ?>"></script>

    <script>
      $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
          event.preventDefault();
          if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bi-eye-slash-fill");
            $('#show_hide_password i').removeClass("bi-eye-fill");
          } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bi-eye-slash-fill");
            $('#show_hide_password i').addClass("bi-eye-fill");
          }
        });
      });
    </script>
  
  </body>
</html>