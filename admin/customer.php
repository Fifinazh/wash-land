<?php
session_start();
include 'koneksi.php';

$queryCust = mysqli_query($koneksi, "SELECT * FROM customer ORDER BY id DESC");

if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //mengambil nilai param

    //query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM customer WHERE id ='$id'");
    header("location:customer.php?hapus=berhasil");
}
?>



<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>User Page</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords" content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="codedthemes">

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
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Customer Settings Page</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Customer</h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_GET['hapus'])): ?>
                                <div class="alert alert-danger" role="alert">
                                    Data berhasil dihapus
                                </div>
                            <?php endif ?>
                            <div align="right" class="button-action">
                                <a href="tambah-customer.php" class="btn btn-primary">Tambah</a>
                            </div>
                            <table class="table table-bordered table-striped table-hover table-responsive mt-3">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($rowCust = mysqli_fetch_assoc($queryCust)) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= isset($rowCust['customer_name']) ? $rowCust['customer_name'] : '-' ?></td>
                                            <td><?= isset($rowCust['phone']) ? $rowCust['phone'] : '-' ?></td>
                                            <td><?= isset($rowCust['address']) ? $rowCust['address'] : '-' ?></td>
                                            <td>
                                                <a href="tambah-customer.php?edit=<?php echo $rowCust['id'] ?>">
                                                    <button class="btn btn-secondary">
                                                        <i class="ti ti-pencil"></i>
                                                    </button>
                                                </a>
                                                <a onclick="return confirm ('Apakah anda yakin akan menghapus data ini?')"
                                                    href="customer.php?delete=<?php echo $rowCust['id'] ?>">
                                                    <button class="btn btn-danger">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; // End While 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <?php include 'inc/footer-js.php' ?>


</body>

</html>