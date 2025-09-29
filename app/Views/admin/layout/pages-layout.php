<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($pageTitle) ? $pageTitle : 'Data Entry Software Admin Dashboard'; ?></title>
  <!--favicon-->
  <link rel="icon" href="<?= base_url('public/assets/uploads/logo/' .getCompanyData('company_favicon')) ?>" type="image/png">
  <!-- loader-->
  <link href="<?= base_url('public/admin/assets/css/pace.min.css') ?>" rel="stylesheet">
  <script src="<?= base_url('public/admin/assets/js/pace.min.js') ?>"></script>

  <!--plugins-->
  <link href="<?= base_url('public/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin/assets/plugins/metismenu/metisMenu.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin/assets/plugins/metismenu/mm-vertical.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/admin/assets/plugins/simplebar/css/simplebar.css') ?>">
  
  <!--bootstrap css-->
  <link href="<?= base_url('public/admin/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

  <!--main css-->
  <link href="<?= base_url('public/admin/assets/css/bootstrap-extended.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/main.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/dark-theme.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/blue-theme.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/semi-dark.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/bordered-theme.css') ?>" rel="stylesheet">
  <link href="<?= base_url('public/admin/sass/responsive.css') ?>" rel="stylesheet">
  
  <link href="<?= base_url('public/admin/assets/css/custom.css') ?>" rel="stylesheet">
</head>
<body>
<!--start header-->
<?php include('inc/header.php') ?>
<!--end top header-->

<!--start sidebar-->
<?php include('inc/right-sidebar.php') ?>
<!--end sidebar-->

  <!--start main wrapper-->
  <main class="main-wrapper">
    <div class="main-content">
     <?= $this->renderSection('content') ?>
		</div>
  </main>
  <!--end main wrapper-->

  <!--start overlay-->
    <div class="overlay btn-toggle"></div>
  <!--end overlay-->

<!--start footer-->
<?php include('inc/footer.php') ?>
<!--top footer-->

  <!--bootstrap js-->
  <script src="<?= base_url('public/admin/assets/js/bootstrap.bundle.min.js') ?>"></script>
  <!--plugins-->
  <script src="<?= base_url('public/admin/assets/js/jquery.min.js') ?>"></script>
  <!--plugins-->
  <script src="<?= base_url('public/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') ?>"></script>
  <script src="<?= base_url('public/admin/assets/plugins/metismenu/metisMenu.min.js') ?>"></script>
  <script src="<?= base_url('public/admin/assets/plugins/simplebar/js/simplebar.min.js') ?>"></script>
  <script src="<?= base_url('public/admin/assets/plugins/peity/jquery.peity.min.js ') ?>"></script>
  <script src="<?= base_url('public/admin/assets/js/main.js') ?>"></script>
    <script src="<?= base_url('public/admin/assets/js/custom.js') ?>"></script>
    <script>
        var GET_FIELDS_URL = "<?= site_url('admin/get-fields/') ?>";
    </script>

  <script src="<?= base_url('public/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('public/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') ?>"></script>
  
	<script>
		$('#example').DataTable({
      "dom":
        "<'row mb-3'<'col-sm-6 d-flex align-items-center'l><'col-sm-6 d-flex align-items-center justify-content-end'f>>" +
        "<'table-responsive'tr>" +
        "<'row mt-3'<'col-sm-6 d-flex align-items-center'i><'col-sm-6 d-flex align-items-center justify-content-end'p>>",
        "language": {
        "lengthMenu": "Show _MENU_ entries",
        "search": "Search:"
        }
    });
	</script>

</body>

</html>