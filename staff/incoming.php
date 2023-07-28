<?php
  $page_title = 'All Stock In';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(2);
  $incomings = join_incoming_table();
  
?>  
<?php include_once('layouts/header.php'); ?>  

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Stock In List</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <!-- <li class="breadcrumb-item">Tables</li> -->
              <li class="breadcrumb-item active" aria-current="page">Stock In</li>
            </ol>
          </div>
 <!-- Row -->
 <div class="row"> 
 <?php echo display_msg($msg); ?>
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Stock In List</h6>
                  <!-- <a href="add_incoming.php" class="btn btn-sm btn-primary"> Add New Incoming</a> -->
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                      <th class="text-center">#</th>
                      <th>Photo</th>
                      <th>Item Name</th>
                      <th class="text-center">User Name</th>
                      <th class="text-center">Quantity</th>
                      <th class="text-center">Created Date</th>
                      <th class="text-center">Description</th>
                      <!-- <th class="text-center">Actions</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($incomings as $incoming):?>
                      <tr>
                        <td class="text-center"><?php echo count_id();?></td>
                        <td>
                          <img class="img-avatar img-circle" src="../img/item/<?php echo $incoming['media']; ?>" style="max-width: 50px">
                        </td>
                        <td><?php echo remove_junk($incoming['item_name']); ?></td>
                        <td class="text-center"><?php echo remove_junk($incoming['user_name']); ?></td>
                        <td class="text-center"><?php echo remove_junk($incoming['quantity']); ?></td>
                        <td class="text-center"><?php echo read_date($incoming['date']); ?></td>
                        <td class="text-center"><?php echo remove_junk($incoming['description']); ?></td>
                        <!-- <td class="text-center">
                        <a href="edit_incoming.php?id=<?php echo (int)$incoming['id'];?>" class="btn btn-sm btn-info">
                        Edit
                        </a>
                        <a href="delete_incoming.php?id=<?php echo (int)$incoming['id'];?>" class="btn btn-sm btn-danger">
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
