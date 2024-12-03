<?php
session_start();

include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
//mengambil data detail penjual dan penjualan
$queryDetail = mysqli_query($koneksi, "SELECT trans_order.id, trans_order.order_code, trans_order.order_date, trans_order.order_end_date, trans_order.order_status, customer.customer_name, type_of_service.service_name, type_of_service.price, trans_order_detail.* FROM trans_order_detail LEFT JOIN trans_order ON trans_order.id = trans_order_detail.id_order LEFT JOIN customer ON customer.id = trans_order.id_customer LEFT JOIN type_of_service ON type_of_service.id = trans_order_detail.id_service");

$row = [];
while ($rowDetail = mysqli_fetch_assoc($queryDetail)) {
    $row[] = $rowDetail;
}

?>



<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords" content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="codedthemes">

    <style>
        body {
            margin: 20px;

        }

        .struk {
            width: 80mm;
            max-width: 100%;
            border: 1px solid #000;
            padding: 10px;
            margin: 0 auto;
        }

        .struk-header,
        .struk-footer {
            text-align: center;
            margin-bottom: 10px;
        }

        .struk-header h1 {
            font-size: 25px;
            margin: 0;
            margin-top: 10px;
        }

        .struk-header p {
            font-size: 15px;
            margin: 0;
            margin-top: 10px;
        }

        .struk-body {
            margin-bottom: 10px;
        }

        .struk-body table {
            border-collapse: collapse;
            width: 100%;
        }

        .struk-body table th,
        .struk-body table td {
            padding: 5px;
            text-align: left;
        }

        .struk-body table th {
            border-bottom: 1px solid #000;
        }

        .total,
        .payment,
        .change {
            display: flex;
            justify-content: space-evenly;
            padding: 5px 0;
            font-weight: bold;
        }

        .total {
            margin-top: 10px;
            border-top: 1px solid #000;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .struk {
                width: auto;
                border: none;
                margin: 0;
                padding: 0;
            }

            .struk-header h1,
            .struk-footer {
                font-size: 14px;
            }

            .struk-body table th,
            .struk-body table td {
                padding: 2px;
            }

            .total,
            .payment,
            .change {
                padding: 2px 0;
            }
        }
    </style>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <div class="struk">
        <div class="struk-header">
            <h1>Wash-Land</h1>
            <p>Kemayoran, Jakarta Pusat</p>
            <p>081245367695</p>
        </div>
        <div class="struk-body">
            <table>
                <thead>
                    <tr>
                        <th>No Invoice</th>
                        <th>Tanggal Laundry</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Jenis Paket Laundry</th>
                        <th>Sub Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row : [0] => data-->
                    <?php foreach ($row as $key => $rowDetail): ?>
                        <tr>

                            <td><?php echo $rowDetail['order_code'] ?></td>
                            <td><?php echo $rowDetail['order_date'] ?></td>
                            <td><?php echo $rowDetail['order_end_date'] ?></td>
                            <td><?php echo $rowDetail['service_name'] ?></td>
                            <td><?php echo $rowDetail['subtotal'] ?></td>
                            <td>
                                <?php
                                switch ($rowDetail['order_status']) {
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
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>

</html>