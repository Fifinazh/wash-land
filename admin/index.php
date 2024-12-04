<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Dashboard | Wash-land App</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
  <meta name="keywords" content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
  <meta name="author" content="codedthemes">
  <style>
    .card {
      min-height: 500px;
    }

    .card .card-body img {
      max-width: 300px;
    }
  </style>
  <?php include 'inc/header.php' ?>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
  <!-- [ Sidebar Menu ] start -->
  <?php include 'inc/sidebar.php' ?>
  <!-- [ Sidebar Menu ] end -->

  <!-- [ Header Topbar ] start -->
  <header class="pc-header">
    <div class="header-wrapper">
      <!-- [Mobile Media Block] start -->
      <?php include 'inc/topbar.php' ?>
      <!-- [Mobile Media Block end] -->

      <!-- dropdown start -->
      <?php include 'inc/nav-dropdown.php' ?>
      <!-- dropdown end -->
    </div>
  </header>
  <!-- [ Header ] end -->



  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="card">
          <div class="card-header">
            <h3><b>Welcome, to Wash-land laundry App</b></h3>
          </div>
          <div class="card-body d-flex align-items-center justify-content-center gap-3">
            <div class="row">
              <div class="col-sm-12 mb-5" align="center">
                <img src="upload/laundry-machine.png" alt="">
              </div>
              <div class="col-sm-12" align="center">

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <?php include 'inc/footer-js.php' ?>
</body>
<!-- [Body] end -->

</html>