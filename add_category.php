<?php
  $page_title = 'Add categories';
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
        redirect('add_category.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('add_category.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="category.php">Category</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Category</li>
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
                  <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                </div>
                <div class="card-body">
                  <form method="post" action="add_category.php">
                    <div class="form-group">
                      <label for="categorie-name">Category Name</label>
                      <input type="text" class="form-control" name="categorie-name"
                        placeholder="Enter category name">
                    </div>
                    <div class="form-group">
                    <label for="status">Status</label>
                      <select class="form-control mb-3" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                    <button type="submit" name="add_cat" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
          </div>
          </div>
        </div>

<?php include_once('layouts/footer.php'); ?>
