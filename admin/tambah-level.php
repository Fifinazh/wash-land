<?php
session_start();

include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama_level = $_POST['nama_level'];

    $insert = mysqli_query($koneksi, "INSERT INTO level (nama_level) VALUES ('$nama_level')");
    header("location:level.php?tambah=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editLevel = mysqli_query(
    $koneksi,
    "SELECT * FROM level WHERE id = '$id'"
);
$rowEdit = mysqli_fetch_assoc($editLevel);

if (isset($_POST['edit'])) {
    $level_name = $_POST['level_name'];


    //ubah user kolom apa yang mau di ubah (SET) 
    $update = mysqli_query($koneksi, "UPDATE level SET nama_level= '$nama_level'WHERE id='$id'");
    header("location:level.php?ubah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM level WHERE id='$id'");
    header("location:level.php?hapus=berhasil");
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
                        <div class="card-header">
                            <h4><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Level</h4>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_GET['hapus'])): ?>
                                <div class="alert alert-success" role="alert">
                                    Data berhasil dihapus
                                </div>
                            <?php endif ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <label for="" class="form-label">Nama Role atau Level</label>
                                        <input type="text" class="form-control" name="nama_level" placeholder="Masukkan Role atau Level" required value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_level'] : '' ?>">
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