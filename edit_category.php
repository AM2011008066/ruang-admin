<?php
  $page_title = 'Edit category';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(1);
?>
<?php
  //Display all catgories.
  $categorie = find_by_id('category',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing category id.");
    redirect('category.php');
  }
?>  

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('categorie-name', 'status');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['categorie-name']));
  $status = remove_junk($db->escape($_POST['status']));

  if(empty($errors)){
       $sql = "UPDATE category SET name='{$cat_name}', status='{$status}'";
       $sql .= " WHERE id='{$categorie['id']}'";

     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated category");
       redirect('category.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('edit_category.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('edit_category.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="category.php">Category</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
                  <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                </div>
                <div class="card-body">
                  <form method="post" action="edit_category.php?id=<?php echo (int)$categorie['id'];?>">
                    <div class="form-group">
                      <label for="name">Category Name</label>
                      <input type="name" class="form-control" 
                      name="categorie-name" value="<?php echo remove_junk(ucfirst($categorie['name']));?>">
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control mb-3" name="status">
                      <option <?php if($categorie['status'] === '1') echo 'selected="selected"';?> value="1"> Active </option>
                      <option <?php if($categorie['status'] === '0') echo 'selected="selected"';?> value="0"> Inactive</option>
                      </select>
                    </div>
                    <button type="submit" name="edit_cat" class="btn btn-primary">Update</button>
                  </form>
                </div>
              </div>
          </div>
</div>
</div>



<?php include_once('layouts/footer.php'); ?>
