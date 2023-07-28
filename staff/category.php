<?php
  $page_title = 'All categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(1);
  
  $all_categories = find_all('category')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name', 'status');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
   $status = remove_junk($db->escape($_POST['status']));

   if(empty($errors)){ 

      $sql  = "INSERT INTO category (name, status)";
      $sql .= " VALUES ('{$cat_name}', '{$status}')";


      if($db->query($sql)){
        $session->msg("s", "Successfully Added New Category");
        redirect('category.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('category.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('category.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <!-- <li class="breadcrumb-item">Tables</li> -->
              <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
          </div>
 <!-- Row -->
 <div class="row">
 <?php echo display_msg($msg); ?>
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                  <!-- <a href="add_category.php" class="btn btn-sm btn-primary"> Add New Category</a> -->
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Category Name</th>
                        <th class="text-center">Status</th>
                        <!-- <th class="text-center" style="width: 100px;">Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($all_categories as $cat):?>
                      <tr>
                        <td class="text-center"><?php echo count_id();?></td>
                        <td class="text-center"><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                        <td class="text-center">
                        <?php if($cat['status'] === '1'): ?>
                          <span  class="badge badge-success"><?php echo "Active"; ?></span>
                        <?php else: ?>
                          <span class="badge badge-warning"><?php echo "Inactive"; ?></span>
                        <?php endif;?>
                        </td>
                        <!-- <td class="text-center">
                        <a href="edit_category.php?id=<?php echo (int)$cat['id'];?>" class="btn btn-sm btn-info">
                        Edit
                        </a>
                        <a href="delete_category.php?id=<?php echo (int)$cat['id'];?>" class="btn btn-sm btn-danger">
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
