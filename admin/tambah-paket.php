<?php
session_start();
include 'koneksi.php';

//jika button simpan di klik
if (isset($_POST['simpan'])) {
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $insert = mysqli_query($koneksi, "INSERT INTO type_of_service (service_name, price, description) VALUES ('$service_name','$price','$description')");

    header("location:paket.php?tambah=berhasil");
}




$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM type_of_service WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

//jika button edit di klik
if (isset($_POST['edit'])) {
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $update = mysqli_query($koneksi, "UPDATE type_of_service SET service_name='$service_name', price='$price', description='$description' WHERE id='$id'");
    header("location:paket.php?ubah=berhasil");
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
                                <h5 class="m-b-10">Service Page</h5>
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
                        <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Paket</div>
                        <div class="card-body">
                            <?php if (isset($_GET['hapus'])): ?>
                                <div class="alert alert-success" role="alert">
                                    Data berhasil dihapus
                                </div>
                            <?php endif ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <label for="" class="form-label">Nama Paket Laundry</label>
                                        <input type="text" class="form-control" name="service_name" placeholder="Masukkan Nama Paket" required value="<?php echo isset($_GET['edit']) ? $rowEdit['service_name'] : '' ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="form-label">Harga Laundry</label>
                                        <input type="number" class="form-control" name="price" placeholder="Masukkan Harga Laundry" required value="<?php echo isset($_GET['edit']) ? $rowEdit['price'] : '' ?>">
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <label for="" class="form-label">Deskripsi</label>
                                        <textarea name="description" id="" class="form-control" required><?php echo isset($_GET['edit']) ? $rowEdit['description'] : '' ?></textarea>

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