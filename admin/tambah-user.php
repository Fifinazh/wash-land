<?php
session_start();

include 'koneksi.php';

//jika button simpan di klik
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id_level = $_POST['id_level'];

    $insert = mysqli_query($koneksi, "INSERT INTO user (nama, email, password, id_level) VALUES ('$nama','$email','$password','$id_level)");

    header("location:user.php?tambah=berhasil");
} else if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    $queryEdit = mysqli_query($connection, "SELECT * FROM user WHERE id='$idEdit'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
    //jika button edit di klik
    if (isset($_POST['edit'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $id_level = $_POST['id_level'];

        $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama',email='$email', password='$password', id_level='$id_level' WHERE id='$idEdit'");
        header("location:user.php?ubah=berhasil");
    }
}

$queryLevel = mysqli_query($koneksi, "SELECT * FROM level");
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
                                <h5 class="m-b-10">User Page</h5>
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
                            <h5><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> User</h5>
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
                                        <label for="" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Anda" required value="<?php echo isset($_GET['edit']) ? $rowEdit['nama'] : '' ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Masukkan Email Anda" required value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>">
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password Anda">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="level" class="form-label">Role atau level</label>
                                        <select class="form-control" name="id_level" id="">
                                            <option value=""> -- Pilih Level -- </option>
                                            <?php while ($rowLevel = mysqli_fetch_assoc($queryLevel)) : ?>
                                                <option value="<?= $rowLevel['id'] ?>"
                                                    <?= isset($_GET['edit']) && ($rowLevel['id'] == $rowEdit['id_level']) ? 'selected' : '' ?>>
                                                    <?= $rowLevel['nama_level'] ?></option>
                                            <?php endwhile ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="mb-3 row">
                                    <div class="col-sm-12">
                                        <label for="" class="form-label">Foto</label>
                                        <input type="file" name="foto">
                                    </div>
                                </div> -->
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