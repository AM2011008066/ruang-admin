<?php
  $page_title = 'Add Item';  
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(2);
  $all_categories = find_all('category');
?>
<?php 
 if(isset($_POST['add_item'])){
   $req_fields = array('item-name','item-category');
   validate_fields($req_fields);
   if(empty($errors)){
     $item_name  = remove_junk($db->escape($_POST['item-name']));
     $item_cat   = remove_junk($db->escape($_POST['item-category']));
     $date    = make_date();
     $query  = "INSERT INTO item (";
     $query .=" name,categorie_id,date";
     $query .=") VALUES (";
     $query .=" '{$item_name}','{$item_cat}', '{$date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$item_name}'";
     if($db->query($query)){
       $session->msg('s',"Item added ");
       redirect('item.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('add_item.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_item.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Item</h1>
           
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="item.php">Item</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Item</li>
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
                  <h6 class="m-0 font-weight-bold text-primary">Add Item</h6>
                </div>
                <div class="card-body">
                  <form method="post" action="add_item.php">
                    <div class="form-group">
                      <label for="item-name">Item Name</label>
                      <input type="text" class="form-control" name="item-name"
                        placeholder="Enter item name">
                    </div>
                    <div class="form-group">
                    <label for="item-category">Category</label> 
                    <select class="form-control" name="item-category">
                      <option value="">Select Item Category</option>
                      <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    </div>
                    <button type="submit" name="add_item" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
        </div>
       </div>
     </div>
<?php include_once('layouts/footer.php'); ?>
