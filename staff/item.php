<?php
  $page_title = 'All Items';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(2);
  $products = join_product_table();
?> 
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Item</h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <!-- <li class="breadcrumb-item">Tables</li> -->
              <li class="breadcrumb-item active" aria-current="page">Item</li>
            </ol>
          </div>
 <!-- Row -->
 <div class="row"> 
 <?php echo display_msg($msg); ?>
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Item List</h6>
                  <!-- <a href="add_item.php" class="btn btn-sm btn-primary"> Add New Item</a> -->
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                      <th class="text-center">#</th>
                      <!--<th> Photo</th>-->
                      <th>Item Name</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Quantity</th>
                      <th class="text-center">Last update</th>
                      <!-- <th class="text-center" style="width: 100px;">Actions</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product):?>
                      <tr>
                        <td class="text-center"><?php echo count_id();?></td>
                        <td><?php echo remove_junk($product['name']); ?></td>
                        <td class="text-center"><?php echo remove_junk($product['category']); ?></td>
                        <td class="text-center"><?php echo remove_junk($product['quantity']); ?></td>
                        <td class="text-center"><?php echo read_date_only($product['date']); ?></td>
                        <!-- <td class="text-center">
                        <a href="edit_item.php?id=<?php echo (int)$product['id'];?>" class="btn btn-sm btn-info">
                        Edit
                        </a>
                        <a href="delete_item.php?id=<?php echo (int)$product['id'];?>" class="btn btn-sm btn-danger">
                        Delete
                        </a> -->
                      </td>
                      </tr>
                      <?php endforeach;?>
                      </tbody>
                  </table>
                </div>
              </div> 
            </div>
  </div>

  <?php include_once('layouts/footer.php'); ?>
