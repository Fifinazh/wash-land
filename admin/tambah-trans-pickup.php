<?php
session_start();
include 'koneksi.php';

$queryCustomer = mysqli_query($koneksi, "SELECT * FROM customer");

$id = isset($_GET['proses']) ? $_GET['proses'] : '';
$queryTransDetail = mysqli_query($koneksi, "SELECT customer.customer_name, customer.phone, customer.address, trans_order.order_pay, trans_order.order_change, 
trans_order.order_code, trans_order.order_date, trans_order.order_end_date, trans_order.order_status, trans_order.id_customer, 
type_of_service.service_name, type_of_service.price, trans_order_detail.* FROM trans_order_detail 
LEFT JOIN type_of_service ON type_of_service.id = trans_order_detail.id_service 
LEFT JOIN trans_order ON trans_order.id = trans_order_detail.id_order 
LEFT JOIN customer ON customer.id = trans_order.id_customer
WHERE trans_order_detail.id_order='$id' ");

$row = [];
while ($dataTrans = mysqli_fetch_assoc($queryTransDetail)) {
    $row[] = $dataTrans;
}


$queryPaket = mysqli_query($koneksi, "SELECT * FROM type_of_service");
$rowPaket = [];
while ($data = mysqli_fetch_assoc($queryPaket)) {
    $rowPaket[] = $data;
}

$queryTransPickup = mysqli_query($koneksi, "SELECT * FROM trans_laundry_pickup WHERE id_order = '$id' ");

// jika button simpan ditekan/klik 
if (isset($_POST['simpan_transaksi'])) {

    // mengambil nilai dari input dengan atribute name
    $id_customer = $_POST['id_customer'];
    $id_order = $_POST['id_order'];
    $order_pay = $_POST['order_pay'];
    $order_change = $_POST['order_change'];

    $pickup_date = date("Y-m-d");

    // insert ke table trans_laundry_pickup
    $insert =  mysqli_query($koneksi, "INSERT INTO trans_laundry_pickup (id_order, id_customer, pickup_date) 
    VALUES ('$id_order','$id_customer', '$pickup_date')");

    // ubah status order jadi satu=sudah diambil
    $updateTransOrder = mysqli_query($koneksi, "UPDATE trans_order SET order_pay = '$order_pay', 
        order_change = '$order_change',  order_status = 1  WHERE id = '$id_order'");

    header("location:order.php?tambah=berhasil");
}


// no invoice code
// 001, jika ada auto increment id + 1 = 002, selain itu 001
// MAX : terbesar MIN : terkecil
$queryInvoice = mysqli_query($koneksi, "SELECT MAX(id) AS no_invoice FROM trans_order ");
//jika di dalam tabel trans order ada datanya
$str_unique = "INV";
$date_now = date("dmy");
if (mysqli_num_rows($queryInvoice) > 0) {
    $rowInvoice = mysqli_fetch_assoc($queryInvoice);
    $incrementPlus = $rowInvoice['no_invoice'] + 1;
    $code = $str_unique . "/" . $date_now . "-" . "000" . $incrementPlus;
} else {
    $code = $str_unique . "/" . $date_now . "-" . "0001";
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
                    <?php if (isset($_GET['proses'])) : ?>
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>Pengambilan Laundry : <?php echo $row[0]['customer_name'] ?></h5>
                                                </div>
                                                <div class="col-sm-6" align="right">
                                                    <a href="pickup.php" class="btn btn-secondary">Kembali</a>
                                                    <a href="print.php?id=<?php echo $id ?>" class="btn btn-success">Cetak Struk</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Data Transaksi</h5>
                                        </div>
                                        <?php include 'helper.php' ?>
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <th>No. Invoice</th>
                                                    <td><?php echo $row[0]['order_code'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Laundry</th>
                                                    <td><?php echo $row[0]['order_date'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td><?php echo changeStatus($row[0]['order_status']) ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Data Pelanggan</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <th>Nama</th>
                                                    <td><?php echo $row[0]['customer_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Telepon</th>
                                                    <td><?php echo $row[0]['phone'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td><?php echo $row[0]['address'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Transaksi Detail</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="post">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Paket</th>
                                                            <th>Quantity</th>
                                                            <th>Harga</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $total = 0;
                                                        foreach ($row as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $no++ ?></td>
                                                                <td><?php echo $value['service_name'] ?></td>
                                                                <td><?php echo $value['qty'] ?></td>
                                                                <td><?php echo $value['price'] ?></td>
                                                                <td><?php echo $value['subtotal'] ?></td>
                                                            </tr>
                                                            <?php
                                                            $total += $value['subtotal'];

                                                            ?>
                                                        <?php endforeach ?>
                                                        <tr>
                                                            <td colspan="4" align="right">
                                                                <strong>Total Keseluruhan</strong>
                                                            </td>
                                                            <td>
                                                                <strong><?php echo "Rp" . number_format($total) ?></strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" align="right">
                                                                <strong>Dibayar</strong>
                                                            </td>
                                                            <td>
                                                                <strong>
                                                                    <?php if (isset($row[0]['order_pay']) && $row[0]['order_pay'] == 0): ?>
                                                                        <input type="text" name="order_pay" placeholder="Dibayar" class="form-control" value="<?php echo isset($_POST['order_pay']) ? $_POST['order_pay'] : '' ?>">

                                                                    <?php else: ?>
                                                                        <input type="text" placeholder="Dibayar" class="form-control" value="<?php echo $row[0]['order_pay'] ?>">
                                                                    <?php endif; ?>

                                                                </strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" align="right">
                                                                <strong>Kembalian</strong>
                                                            </td>
                                                            <?php
                                                            if (isset($_POST['proses_kembalian'])) {
                                                                $dibayar = $_POST['order_pay'];

                                                                $kembalian = (int)$dibayar - (int)$total;
                                                            }
                                                            if (mysqli_num_rows($queryTransPickup) > 0) {
                                                                $rowTransPickup = mysqli_fetch_assoc($queryTransPickup);
                                                            } else {
                                                                $rowTransPickup = []; // Inisialisasi sebagai array kosong
                                                            }
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="total" value="<?php echo $total ?>">
                                                                <input type="hidden" name="id_customer" value="<?php echo $row[0]['id_customer'] ?>">
                                                                <input type="hidden" name="id_order" value="<?php echo $row[0]['id_order'] ?>">
                                                                <strong>
                                                                    <input type="text" name="order_change" placeholder="Kembalian" class="form-control" value="<?php echo isset($kembalian) ?  number_format($kembalian) : "" ?>" readonly>
                                                                </strong>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td colspan="5" align="right">
                                                                <button class="btn btn-primary" name="proses_kembalian">Proses Kembalian</button>
                                                                <button class="btn btn-success" name="simpan_transaksi">Simpan Transaksi</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Transaksi</div>
                                            <div class="card-body">
                                                <div class="mb-3 row">

                                                    <div class="col-sm-12 mb-3">
                                                        <label for="" class="form-label">Pelanggan</label>
                                                        <select name="id_customer" class="form-control" id="">
                                                            <option value="">Pilih Pelanggan</option>
                                                            <?php while ($rowCustomer = mysqli_fetch_assoc($queryCust)): ?>
                                                                <option value="<?php echo $rowCustomer['id'] ?>">
                                                                    <?php echo $rowCustomer['customer_name'] ?>
                                                                </option>
                                                            <?php endwhile ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">No invoice</label>
                                                        <input type="text" class="form-control" id="" name="order_code" readonly
                                                            value="<?php echo $code ?>">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">Tanggal Laundry</label>
                                                        <input type="date" name="order_date" class="form-control" id="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">Detail Transaksi</div>
                                            <div class="card-body">
                                                <div class="mb-3 row">

                                                    <div class="col-sm-3 mb-4">
                                                        <label for="" class="form-label"> Jenis Paket</label>
                                                    </div>
                                                    <div class="col-9 mb-4">
                                                        <select name="id_service[]" class="form-control" id="">
                                                            <option value="">Pilih Paket</option>
                                                            <?php
                                                            foreach ($rowPaket as $key => $value) {
                                                            ?>
                                                                <option value="<?php echo $value['id'] ?>">
                                                                    <?php echo $value['service_name'] ?>
                                                                </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 mb-3">
                                                        <label for="" class="form-label">Quantity</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="number" class="form-control" id="" name="qty[]"
                                                            value="" placeholder="Qty">
                                                    </div>

                                                </div>
                                                <div class="mb-3 row">

                                                    <div class="col-sm-3 mb-4">
                                                        <label for="" class="form-label">Paket</label>
                                                    </div>
                                                    <div class="col-9 mb-4">
                                                        <select name="id_service[]" class="form-control" id="">
                                                            <option value="">Pilih Paket</option>
                                                            <?php
                                                            foreach ($rowPaket as $key => $value) {
                                                            ?>
                                                                <option value="<?php echo $value['id'] ?>">
                                                                    <?php echo $value['service_name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 mb-3">
                                                        <label for="" class="form-label">Quantity</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="number" class="form-control" id="" name="qty[]"
                                                            value="" placeholder="Qty">
                                                    </div>

                                                </div>

                                                <div class="mb-3">
                                                    <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php endif ?>

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