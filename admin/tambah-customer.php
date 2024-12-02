<?php
session_start();
include 'koneksi.php';

//jika button simpan di klik
if (isset($_POST['simpan'])) {
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $insert = mysqli_query($koneksi, "INSERT INTO customer (customer_name, phone, address) VALUES ('$customer_name','$phone','$address')");

    header("location:customer.php?tambah=berhasil");
}




$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM customer WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

//jika button edit di klik
if (isset($_POST['edit'])) {
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];



    $update = mysqli_query($koneksi, "UPDATE customer SET customer_name='$customer_name', phone='$phone', address='$address' WHERE id='$id'");
    header("location:customer.php?ubah=berhasil");
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
                                <h5 class="m-b-10">Level Page</h5>
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
                        <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Customer</div>
                        <div class="card-body">
                            <?php if (isset($_GET['hapus'])): ?>
                                <div class="alert alert-success" role="alert">
                                    Data berhasil dihapus
                                </div>
                            <?php endif ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <label for="" class="form-label">Nama Pelanggan</label>
                                        <input type="text" class="form-control" name="customer_name" placeholder="Masukkan Nama Pelanggan" required value="<?php echo isset($_GET['edit']) ? $rowEdit['customer_name'] : '' ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="form-label">No. Telepon</label>
                                        <input type="number" class="form-control" name="phone" placeholder="Masukkan Nomor Telepon" required value="<?php echo isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>">
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <label for="" class="form-label">Alamat</label>
                                        <textarea name="address" id="" class="form-control" required><?php echo isset($_GET['edit']) ? $rowEdit['address'] : '' ?></textarea>

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                                </div>
                            </form>
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