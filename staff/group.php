<?php
  $page_title = 'All Group';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(2);
  $all_groups = find_all('user_groups');
?>  
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Group</h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <!-- <li class="breadcrumb-item">Tables</li> -->
              <li class="breadcrumb-item active" aria-current="page">Group</li>
            </ol>
          </div>
 <!-- Row -->
 <div class="row">
 <?php echo display_msg($msg); ?>
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Group List</h6>
                  <!-- <a href="add_group.php" class="btn btn-sm btn-primary"> Add New Group</a> -->
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Group Name</th>
                        <th class="text-center">Group Level</th>
                        <th class="text-center">Status</th>
                        <!-- <th class="text-center" style="width: 100px;">Action</th> -->
                      </tr>
                    </thead>
                    <!-- <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Group Name</th>
                        <th>Group Level</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot> -->
                    <tbody>
                    <?php foreach($all_groups as $a_group): ?>
                      <tr>
                        <td class="text-center"><?php echo count_id();?></td>
                        <td class="text-center"><?php echo remove_junk(ucwords($a_group['group_name']))?></td>
                        <td class="text-center"><?php echo remove_junk(ucwords($a_group['group_level']))?></td>
                        <td class="text-center"><?php if($a_group['group_status'] === '1'): ?>
                        <span class="badge badge-success"><?php echo "Active"; ?></span>
                        <?php else: ?>
                          <span class="badge badge-warning"><?php echo "Inactive"; ?></span>
                        <?php endif;?></td>
                        <!-- <td class="text-center">
                        <a href="edit_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-sm btn-info">
                        Edit
                        </a>
                        <a href="delete_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-sm btn-danger">
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
<?php include_once('layouts/footer.php'); ?>
