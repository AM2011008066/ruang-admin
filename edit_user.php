<?php
  $page_title = 'Edit User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(1);
?>
<?php
  $e_user = find_by_id('users',(int)$_GET['id']);
  $groups  = find_all('user_groups');
  if(!$e_user){
    $session->msg("d","Missing user id.");
    redirect('users.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['edit_user'])) {
    $req_fields = array('name','level','email');
    validate_fields($req_fields);
    if(empty($errors)){
          $id = (int)$e_user['id'];
          $name = remove_junk($db->escape($_POST['name']));
          // $username = remove_junk($db->escape($_POST['username']));
          $level = (int)$db->escape($_POST['level']);
          $email   = remove_junk($db->escape($_POST['email']));
          $sql = "UPDATE users SET name ='{$name}',user_level='{$level}',email='{$email}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount Updated ");
            redirect('users.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Sorry failed to updated!');
            redirect('edit_user.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_user.php?id='.(int)$e_user['id'],false);
    }
  }
?>
<?php
// Update user password
if(isset($_POST['update-pass'])) {
  $req_fields = array('password');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
     $password = remove_junk($db->escape($_POST['password']));
     $h_pass   = sha1($password);
          $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
       $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"User password has been updated ");
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d',' Sorry failed to updated user password!');
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id='.(int)$e_user['id'],false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="users.php">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                  <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
                </div>
                <div class="card-body">
                  <form method="post" action="edit_user.php?id=<?php echo (int)$e_user['id'];?>">
                    <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" name="name" value="<?php echo remove_junk(ucwords($e_user['name'])); ?>">
                    </div>
                    <!-- <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($e_user['username'])); ?>">
                    </div> -->
                    <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" name="email" value="<?php echo remove_junk(ucwords($e_user['email'])); ?>">
                    </div>
                    <div class="form-group">
                    <label for="level">User Group</label>
                      <select class="form-control" name="level">
                        <?php foreach ($groups as $group ):?>
                        <option <?php if($group['group_level'] === $e_user['user_level']) echo 'selected="selected"';?> value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                      <?php endforeach;?>
                      </select>
                  </div>
                    <button type="submit" name="edit_user" class="btn btn-primary">Update</button>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>


  <!-- Change password form -->
    <!-- <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            Change <?php echo remove_junk(ucwords($e_user['name'])); ?> password
          </strong>
        </div>
        <div class="panel-body">
          <form action="edit_user.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
            <div class="form-group">
                  <label for="password" class="control-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Type user new password">
            </div>
            <div class="form-group clearfix">
                    <button type="submit" name="update-pass" class="btn btn-danger pull-right">Change</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div> -->
<?php include_once('layouts/footer.php'); ?>
