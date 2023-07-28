<?php
  $page_title = 'Register User';
  require_once('includes/load.php');
  $groups = find_all('user_groups');
?>
<?php
  if(isset($_POST['signup'])){

   $req_fields = array('full-name','username','password','level', 'email' );
   validate_fields($req_fields);
   
 
   if(empty($errors)){
       $name   = remove_junk($db->escape($_POST['full-name']));
       $username   = remove_junk($db->escape($_POST['username']));
       $password   = remove_junk($db->escape($_POST['password']));
       $user_level = (int)$db->escape($_POST['level']);
       $password = sha1($password);
       $email = remove_junk($db->escape($_POST['email']));

        $query = "INSERT INTO users (";
        $query .="name,username,password,user_level,email";
        $query .=") VALUES ("; 
        $query .=" '{$name}', '{$username}', '{$password}', '{$user_level}','{$email}'";
        $query .=")";
      
        if($db->query($query)){
        
          //sucess
          $session->msg('s',"User account has been created! ");
          redirect('signup.php', false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to create account!');
          redirect('signup.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('signup.php',false);
   }
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo-uptm.jpeg" rel="icon">
  <title>JPK-IMS - Register</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                  </div>
                  <?php echo display_msg($msg); ?>
                  <form method="post" action="signup.php">
                    <div class="form-group">
                      <label  for="name">Full Name</label>
                      <input type="text" class="form-control" name="full-name" placeholder="Enter Full Name">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" name="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" aria-describedby="emailHelp"
                        placeholder="Enter Email Address">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name= "password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="level">Group</label>
                      <select class="form-control" name="level">
                      <option value="">Select group</option>
                      <?php foreach ($groups as $group ):?>
                        <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                      <?php endforeach;?>
                      </select>
                    </div>
                    <div class="form-group">
                      <button type="submit" name="signup" class="btn btn-primary btn-block">Register</button>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="login.php">Click to Login</a>
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
  <!-- Register Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>

