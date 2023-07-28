<?php
  $page_title = 'All User';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 //page_require_level(1);
//pull out all user form database
 $all_users = find_all_user();
?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage User</h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <!-- <li class="breadcrumb-item">Tables</li> -->
              <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
          </div>
 <!-- Row -->
 <div class="row">
 <?php echo display_msg($msg); ?>
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                  <!-- <a href="add_user.php" class="btn btn-sm btn-primary"> Add New User</a> -->
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                      <th class="text-center">#</th>
                      <th>Name</th>
                      <th class="text-center">User Group</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Last login</th>
                      <!-- <th class="text-center" style="width: 100px;">Actions</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($all_users as $a_user): ?>
                      <tr>
                        <td class="text-center"><?php echo count_id();?></td>
                        <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
                        <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
                        <td class="text-center"><?php echo remove_junk(ucwords($a_user['email']))?></td>
                        <td class="text-center"><?php echo read_date($a_user['last_login'])?></td>
                        <!-- <td class="text-center">
                        <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-sm btn-info">
                        Edit
                        </a>
                        <a href="delete_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-sm btn-danger">
                        Delete
                        </a>
                      </td> -->
                      </tr>
                      <?php endforeach;?>
                      </tbody>
                  </table>
                </div>
              </div> 
            </div>
  </div>


  <?php include_once('layouts/footer.php'); ?>
