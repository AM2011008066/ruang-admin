<?php
  $page_title = 'My profile';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(3);
?>

<?php
  $user_id = (int)$_GET['id'];
  if(empty($user_id)):
    redirect('dashboard.php',false);
  else:
    $user_p = find_by_id('users',$user_id);
  endif;
?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <!-- <li class="breadcrumb-item">Tables</li> -->
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
          </div>

      <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
          <div class="row">
            <div class="col-lg-12">
             <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
                </div>
              <div class="card-body">
              <!-- <img class="img-profile rounded-circle" src="img/users/<?php echo $user['image'];?>" style="max-width: 100px">
              <p></p> -->
              <p>Name: <?php echo remove_junk(ucwords($user['name'])); ?></p>
              <p>Username: <?php echo remove_junk(ucwords($user['username'])); ?></p>
              <p>Email: <?php echo remove_junk(ucwords($user['email'])); ?></p>
              <p>Group: <?php echo remove_junk(ucwords($user['user_level'])); ?> </p>
              <?php if( $user_p['id'] === $user['id']):?>
                <div class="form-group">
                      <a href="edit_account.php" class="btn btn-primary">Edit Account</a>
                </div>
                <?php endif;?>
              <!-- <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin"
                  class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p> -->
            </div>
          </div>
</div>


        </div>
        </div>
        </div>
        
<?php include_once('layouts/footer.php'); ?>
