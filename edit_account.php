<?php
  $page_title = 'Edit Account';
  require_once('includes/load.php');
   //page_require_level(3);
?>

<?php
//update user image
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $user_id = (int)$_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','photo has been uploaded.');
    redirect('edit_account.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('edit_account.php');
    }
  }
?>
<?php
 //update user other info
  if(isset($_POST['update_account'])){
    $req_fields = array('name','username' );
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$_SESSION['user_id'];
           $name = remove_junk($db->escape($_POST['name']));
       $username = remove_junk($db->escape($_POST['username']));
       $email = remove_junk($db->escape($_POST['email']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}', email ='{$email}' WHERE id='{$id}'";
    $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount updated ");
            redirect('edit_account.php', false);
          } else {
            $session->msg('d',' Sorry failed to updated!');
            redirect('edit_account.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_account.php',false);
    }
  }
?>


<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
           
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <!-- <li class="breadcrumb-item"><a href="profile.php">Profile</a></li> -->
              <li class="breadcrumb-item active" aria-current="page">Setting</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-6"> 
            <?php echo display_msg($msg); ?>
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                </div>
                <div class="card-body">

              <form class="form" action="edit_account.php" method="POST" enctype="multipart/form-data">
           
              <div class="form-group">
                
              <label for="file_upload">Change Photo</label><p></p>
              <img class="img-circle img-size-2" src="img/users/<?php echo $user['image'];?>" alt="img" style="max-width: 50px"><br><br>
                <input type="file" name="file_upload" multiple="multiple" class="form-control"/>
              </div>
              <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
                 <button type="submit" name="submit" class="btn btn-primary">Change</button>
              </div>
             </form>
                  <hr>

                  <form method="post" action="edit_account.php?id=<?php echo (int)$user['id'];?>">
                 
                    <div class="form-group">
                    <label for="name">Name</label> 
                    <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucwords($user['name'])); ?>">
                    </div>
                    <div class="form-group">
                    <label for="username">Username</label> 
                    <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($user['username'])); ?>">
                    </div>
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo remove_junk(ucwords($user['email'])); ?>">
                    </div>
                    <button type="submit" name="update_account" class="btn btn-primary">Update</button><br><br>
                  </form>
                </div>
              </div>
        </div>
        <div class="col-lg-6">
              <!-- General Element -->  
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Change password</h6>
                </div>
                <div class="card-body">
                  <form method="post" action="change_password.php" >
                    <div class="form-group">
                      <label for="newPassword">New Password</label>
                      <input type="text" class="form-control" name="new-password"
                        placeholder="New password">
                    </div>
                    <div class="form-group">
                      <label for="oldPassword">Old Password</label>
                      <input type="text" class="form-control" name="old-password"
                        placeholder="Old password">
                    </div>
                    <div class="form-group">
                     <input type="hidden" name="id" value="<?php echo (int)$user['id'];?>">
                     <button type="submit" name="update_password" class="btn btn-primary">Update</button>
                    </div>
                    </div>
                   
                  </form>
                </div>
              </div>
         </div>
        
    



  

<?php include_once('layouts/footer.php'); ?>
