<?php
session_start();

include 'koneksi.php';

// munculkan atau pilih  sebuah atau semua kolom dari table user
$tanggal_dari = isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : '';
$tanggal_sampai = isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$query = "SELECT customer.customer_name, trans_order.* FROM trans_order LEFT JOIN customer ON customer.id=trans_order.id_customer WHERE 1";

if ($tanggal_dari != '') {
    $query .= " AND order_date >= '$tanggal_dari'";
}

if ($tanggal_sampai != '') {
    $query .= " AND order_date <= '$tanggal_sampai'";
}

// jika status tidak kosong
if ($status != '') {
    $query .= " AND order_status = '$status'";
}


$query .= " ORDER BY trans_order.id DESC";

$queryTrans = mysqli_query($koneksi, $query);

// pake mysqli_fetch_assoc($query) = untuk menjadikan hasil query menjadi sebuah data (object, array)
// $dataUser = mysqli_fetch_assoc($queryUser);
// jika parameternya ada ?delete=nilai parameter
if (isset($_GET['delete'])) {
    $id =  $_GET['delete']; // untuk mengambil nilai parameter
    //masukin $query untuk melakukan perintah yg diinginkan
    $delete  = mysqli_query($koneksi, "DELETE FROM trans_order WHERE id = '$id'");
    header("location:trans-order.php?hapus=berhasil");
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
                                <h5 class="m-b-10">User Settings Page</h5>
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
                            <h4>Laporan Transaksi Wash-land</h4>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_GET['hapus'])): ?>
                                <div class="alert alert-success" role="alert">
                                    Data berhasil dihapus
                                </div>
                            <?php endif ?>
                            <!-- filter data transaksi -->
                            <form action="" method="get">
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <label for="">Tanggal dari</label>
                                        <input type="date" name="tanggal_dari" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="">Tanggal sampai</label>
                                        <input type="date" name="tanggal_sampai" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="">--Pilih Status--</option>
                                            <option value="0">Baru</option>
                                            <option value="1">Sudah Dikembalikan</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mt-4">
                                        <button name="filter" class="btn btn-primary">Tampilkan Laporan</button>
                                    </div>
                                </div>
                            </form>
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
                                    while ($rowTrans = mysqli_fetch_assoc($queryTrans)) { ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $rowTrans['order_code'] ?></td>
                                            <td><?php echo $rowTrans['customer_name'] ?></td>
                                            <td><?php echo $rowTrans['order_date'] ?></td>
                                            <td><?php echo $rowTrans['order_end_date'] ?></td>
                                            <td>
                                                <?php
                                                switch ($rowTrans['order_status']) {
                                                    case '1':
                                                        $badge = "<span class='badge bg-success'>Sudah dikembalikan</span>";
                                                        break;
                                                    default:
                                                        $badge = "<span class='badge bg-warning'>Baru</span>";
                                                        break;
                                                }
                                                echo $badge;
                                                ?>
                                            </td>
                                            <td>
                                                <a href="tambah-order.php?detail=<?php echo $rowTrans['id'] ?>" class="btn btn-info btn-sm">
                                                    <i class="ti ti-notes"></i>
                                                </a>
                                                <a target="_blank" href="print.php?id=<?php echo $rowTrans['id'] ?>" class="btn btn-dark btn-sm">
                                                    <i class="ti ti-printer"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="text-center mt-3">
                                <a href="print-laporan.php" class="btn btn-secondary">Print Laporan</a>
                            </div>
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