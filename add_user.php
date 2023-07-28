<?php
  $page_title = 'Add User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(1);
  $groups = find_all('user_groups');
?>
<?php
  if(isset($_POST['add_user'])){ 

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
          redirect('users.php', false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to create account!');
          redirect('add_user.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_user.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add User</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="users.php">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add User</li>
            </ol>
          </div>
          

      <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">

          <div class="row">
            <div class="col-lg-12">
            <?php echo display_msg($msg); ?>
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
                </div>
                <div class="card-body">
                  <form method="post" action="add_user.php">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="full-name" placeholder="Enter full name">
                    </div> 
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name ="password" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                    <label for="username">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                    <label for="level">User Role</label>
                      <select class="form-control" name="level">
                        <?php foreach ($groups as $group ):?>
                        <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                      <?php endforeach;?>
                      </select>
                  </div>
                    <button type="submit" name="add_user" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
        </div>
                        </div>
                        </div>
<?php include_once('layouts/footer.php'); ?>
