<?php
session_start();
include 'koneksi.php';

// munculkan / pilih sebuah atau semua kolom dari table user
$queryTr = mysqli_query($koneksi, "SELECT customer.customer_name, trans_order.* FROM trans_order LEFT JOIN customer ON customer.id = trans_order.id_customer ORDER BY id DESC");
// mysqli_fetch_assoc = untuk menjadikan hasil query menjadi sebuah data (object, array)
// $rowUser = mysqli_fetch_assoc($queryUser);

//jika parameternya ada ?delete-nilai param
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //mengambil nilai param

    //query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM trans_order WHERE id ='$id'");
    header("location:order.php?hapus=berhasil");
}
?>



<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Pickup Page</title>
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
                                <h5 class="m-b-10">Pickup Settings Page</h5>
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
                            <h4>Transaksi Pengembalian Wash-land</h4>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_GET['hapus'])): ?>
                                <div class="alert alert-success" role="alert">
                                    Data berhasil dihapus
                                </div>
                            <?php endif ?>
                            <!-- <div align="right" class="mb-3">
                                <a href="tambah-order.php" class="btn btn-primary">Tambah</a>
                            </div> -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Invoice</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Tanggal Laundry</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($rowTr = mysqli_fetch_assoc($queryTr)) : ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $rowTr['order_code'] ?></td>
                                            <td><?php echo $rowTr['customer_name'] ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($rowTr['order_date'])) ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($rowTr['order_end_date'])) ?></td>
                                            <td>
                                                <?php
                                                switch ($rowTr['order_status']) {
                                                    case '1':
                                                        $badge = "<span class='badge bg-primary'>Sudah dikembalikan</span>";
                                                        break;

                                                    default:
                                                        $badge = "<span class='badge bg-warning'>Baru</span>";
                                                        break;
                                                }

                                                echo $badge;
                                                ?>
                                            </td>
                                            <td>
                                                <a href="tambah-trans-pickup.php?proses=<?php echo $rowTr['id'] ?>" class="btn btn-secondary btn-sm">
                                                    <i class="ti ti-businessplan"></i>
                                                </a>
                                                <a target="_blank" href="print.php?id=<?php echo $rowTr['id'] ?>" class="btn btn-dark btn-sm">
                                                    <i class="ti ti-printer"></i>
                                                </a>
                                                <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')" href="pickup.php?delete=<?php echo $rowTr['id'] ?>" class="btn btn-danger btn-sm">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
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