<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
  $email = $_POST['email']; //POST untuk mengambil nilai dari input
  $password = $_POST['password'];

  $queryLogin = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$password'");
  //fungsi mysqli_num_rows untuk melihat total data di dalam table
  if (mysqli_num_rows($queryLogin) > 0) {
    $rowLogin = mysqli_fetch_assoc($queryLogin);
    if ($password == $rowLogin['password']) {
      $_SESSION['nama'] = $rowLogin['nama'];
      $_SESSION['id'] = $rowLogin['id'];
      header("location:index.php");
    } else {
      header("location:login.php?login=gagal");
    }
  } else {
    header("location:login.php?login=gagal");
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Login | Berry Dashboard Template</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
  <meta name="keywords" content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
  <meta name="author" content="codedthemes">

  <?php include 'inc/header.php' ?>
</head>

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">
            <a href="#" class="d-flex justify-content-center">
              <img src="upload/laundry-machine.png" alt="image" width="
                85">
            </a>
            <div class="row">
              <div class="d-flex justify-content-center">
                <div class="auth-header">
                  <h2 class="text-secondary mt-2"><b>Wash-land App</b></h2>
                 
                </div>
              </div>
            </div>
            <div class="d-grid">
              <!-- <button type="button" class="btn mt-2 bg-light-primary bg-light text-muted">
                  <img src="../assets/images/authentication/google-icon.svg" alt="image">Sign In With Google
                </button> -->
            </div>
            <!-- <div class="saprator mt-3">
                <span>or</span>
              </div> -->
            <h5 class="my-4 d-flex justify-content-center">Sign in with Email address</h5>
            <form action="" method="post">
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="Email address / Username" name="email">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput1" placeholder="Password" name="password">
                <label for="floatingInput1">Password</label>
              </div>
              <div class="d-flex mt-1 justify-content-between">
                <div class="form-check">
                  <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                  <label class="form-check-label text-muted" for="customCheckc1">Remember me</label>
                </div>
                <h5 class="text-secondary">Forgot Password?</h5>
              </div>
              <div class="d-grid mt-4">
                <button type="submit" name="login" class="btn btn-secondary">Sign In</button>
              </div>
              <hr>
              <h5 class="d-flex justify-content-center">Don't have an account?</h5>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="../assets/dist/assets/js/plugins/popper.min.js"></script>
  <script src="../assets/dist/assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/dist/assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/dist/assets/js/fonts/custom-font.js"></script>
  <script src="../assets/dist/assets/js/pcoded.js"></script>
  <script src="../assets/dist/assets/js/plugins/feather.min.js"></script>





  <script>
    layout_change('light');
  </script>




  <script>
    font_change("Roboto");
  </script>


  <script>
    change_box_container('false');
  </script>


  <script>
    layout_caption_change('true');
  </script>




  <script>
    layout_rtl_change('false');
  </script>


  <script>
    preset_change("preset-1");
  </script>


</body>
<!-- [Body] end -->

</html>