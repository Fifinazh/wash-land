<?php
include 'koneksi.php';
$id = $_SESSION['id'];
$queryLogin = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$rowLogin = mysqli_fetch_assoc($queryLogin);
?>
<div class="ms-auto">
    <ul class="list-unstyled">
        <li class="dropdown pc-h-item">
            
            <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                <div class="dropdown-header">
                    <a href="#!" class="link-primary float-end text-decoration-underline">Mark as all read</a>
                    <h5>All Notification <span class="badge bg-warning rounded-pill ms-1">01</span></h5>
                </div>
                <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                    style="max-height: calc(100vh - 215px)">
                    <div class="list-group list-group-flush w-100">
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="user-avtar bg-light-success"><i class="ti ti-building-store"></i></div>
                                </div>
                                <div class="flex-grow-1 ms-1">
                                    <span class="float-end text-muted">3 min ago</span>
                                    <h5>Store Verification Done</h5>
                                    <p class="text-body fs-6">We have successfully received your request.</p>
                                    <div class="badge rounded-pill bg-light-danger">Unread</div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="../assets/images/user/avatar-3.jpg" alt="user-image" class="user-avtar">
                                </div>
                                <div class="flex-grow-1 ms-1">
                                    <span class="float-end text-muted">10 min ago</span>
                                    <h5>Joseph William</h5>
                                    <p class="text-body fs-6">It is a long established fact that a reader will be distracted </p>
                                    <div class="badge rounded-pill bg-light-success">Confirmation of Account</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="text-center py-2">
                    <a href="#!" class="link-primary">Mark as all read</a>
                </div>
            </div>
        </li>
        <li class="dropdown pc-h-item header-user-profile">
            <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <!-- <img src="" alt="user-image" class="user-avtar"> -->
                <span>
                    <i class="ti ti-settings"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                <div class="dropdown-header">
                    <h4>Have a good day, <span class="small text-muted"><?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : '' ?></span></h4>
                    <p class="text-muted">Project Admin</p>
                    <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 280px)">
                        <hr>
                        <a href="logout.php" class="dropdown-item">
                            <i class="ti ti-logout"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>