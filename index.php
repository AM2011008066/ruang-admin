<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('dashboard.php', false);}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo-uptm-nobg.jpeg" rel="icon">
  <title>JPK IMS - Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link rel="manifest" href="manifest.json">
  <link rel="stylesheet" type="text/css" href="addtohomescreen.css">
  <script src="addtohomescreen.js"></script>
</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                  <img src="img/logo/logo-uptm.jpeg" style="max-width: 110px"><p></p>
                  <h1 class="h4 text-gray-900 mb-4">JPK INVENTORY MANAGEMENT SYSTEM</h1>
                    <h1 class="h5 text-gray-900 mb-4">Login Panel</h1>
                    <?php echo display_msg($msg); ?>
                    <!-- <?php print_r($session); ?> -->
                  </div> 
                  <form class="user" method="post" action="auth2.php">
                    <div class="form-group">
                      <input type="name" class="form-control" name="username" aria-describedby="emailHelp"
                        placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Login</button>
                      <a href="admin_login.php" type="submit" class="btn btn-danger btn-block">Admin Login</a>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center"> 
                    <a class="font-weight-bold small" href="signup.php">Create an Account!</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script>
	addToHomescreen();
        //if browser support service worker
        if('serviceWorker' in navigator) {
          navigator.serviceWorker.register('sw.js');
        };
  </script>
  

  

</body>

</html>