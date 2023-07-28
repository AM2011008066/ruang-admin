<?php
  $page_title = 'Dashboard Page';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
?> 
<?php
 $c_categorie     = count_by_id('category');
 $c_product       = count_by_id('item');
 $c_user          = count_by_id('users');
 $total_quantity  = count_by_qty('item');
 $new_in_items = find_recent_incoming_added('5');
 $new_out_items = find_recent_outgoing_added('5');
?>
<?php include_once('layouts/header.php'); ?>
<head>
<link rel="stylesheet" type="text/css" href="addtohomescreen.css">
<script src="addtohomescreen.js"></script>
</head>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
         
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <?php echo display_msg($msg); ?>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- User Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total User</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  echo $c_user['total']; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Category Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Category</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php  echo $c_categorie['total']; ?> </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-bars fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Item Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Item</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php  echo $c_product['total']; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-gift fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Quantity Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Quantity</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  echo $total_quantity['total']; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chart-bar fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Recent Added -->
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">New Stock In</h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="incoming.php">View More <i
                      class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>PIC</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php foreach ($new_in_items as  $new_in_item): ?>
                      <td><?php echo remove_junk(first_character($new_in_item['item_name'])); ?></td>
                      <td><?php echo (int)$new_in_item['quantity']; ?></td>
                      <td><?php echo $new_in_item['user_name']; ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
              <!-- Recent Remove -->
              <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">New Stock Out</h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="outgoing.php">View More <i
                      class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>PIC</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($new_out_items as  $new_out_item): ?>
                      <tr>
                        <td><?php echo remove_junk(first_character($new_out_item['item_name'])); ?></td>
                        <td><?php echo remove_junk(ucfirst($new_out_item['quantity'])); ?></td>
                        <td><?php echo remove_junk(first_character($new_out_item['user_name'])); ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
            

        </div>
<script>addToHomescreen();</script>


<?php include_once('layouts/footer.php'); ?>
