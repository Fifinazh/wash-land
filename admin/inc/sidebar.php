<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="navbar-wrapper">
      <div class="m-header">
        <a href="#" class="">
          <img src="upload/laundry-machine.png" alt="image" width="50">
          <span class="app-brand-text demo menu-text fw-bolder ms-2"
            style="text-transform: none">Wash Land App</span>
        </a>
      </div>

      <div class="navbar-content">
        <ul class="pc-navbar">
          <li class="pc-item pc-caption">
            <label>Dashboard</label>
            <i class="ti ti-dashboard"></i>
          </li>
          <li class="pc-item">
            <a href="index.php" class="pc-link"><span class="pc-micon"><i class="ti ti-dashboard"></i></span><span
                class="pc-mtext">Default</span></a>
          </li>

          <li class="pc-item pc-caption">
            <label>Pages</label>
            <i class="ti ti-apps"></i>
          </li>

          <?php if ($_SESSION['id_level'] == 5) : ?>
          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span class="pc-mtext">Master Data</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
              <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="user.php">Data User</a></li>
                <li class="pc-item pc-hasmenu"><a href="level.php" class="pc-link">Level</a></li>
                <li class="pc-item pc-hasmenu"><a href="customer.php" class="pc-link">Data Customer</a></a></li>
                <li class="pc-item pc-hasmenu"><a href="paket.php" class="pc-link">Paket</a></li>
              </ul>
            </li>
          <?php endif ?>



          <?php if ($_SESSION['id_level'] == 6) : ?>
            <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span class="pc-mtext">Data Transaksi</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
              <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="order.php">Pesanan</a></li>
                <li class="pc-item pc-hasmenu"><a href="pickup.php" class="pc-link">Pengembalian</a></li>
              </ul>
            </li>
          <?php endif ?>


          <?php if ($_SESSION['id_level'] == 7) : ?>
            <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span class="pc-mtext">Data Penjualan</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
              <ul class="pc-submenu">
                <li class="pc-item pc-hasmenu"><a href="laporan.php" class="pc-link">Laporan Transaksi</a></li>
              </ul>
            </li>
          <?php endif ?>



          <!-- <li class="pc-item">
          <a href="../other/sample-page.html" class="pc-link">
            <span class="pc-micon"><i class="ti ti-brand-chrome"></i></span>
            <span class="pc-mtext">Sample page</span>
          </a>
        </li> -->
        </ul>
      </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->