<?php
  $page_title = 'Add Stock Out';
  require_once('includes/load.php');

  $all_item = find_all('item');
  $all_photo = find_all('media');  
  $user = current_user();
  
?>   
<?php  
 if(isset($_POST['add_out'])){
   $media = new Media();
   $req_fields = array('item-name', 'out-quantity','description');
   validate_fields($req_fields); 
   if(empty($errors)){
     $user_id = $user["id"];
     $item_id  = remove_junk($db->escape($_POST['item-name']));
     $out_qty   = remove_junk($db->escape($_POST['out-quantity']));

      $media = new Media();
        if (is_null($_FILES['item-photo'])) {
          $file_name = '0';
        } else {
          $file_name = $_FILES['item-photo']['name'];
        }
        $media->upload($_FILES['item-photo']);
        $media->process_media();

    
     $date    = make_date();
     $description = remove_junk($db->escape($_POST['description']));
     $query  = "INSERT INTO outgoing (";
     $query .=" user_id,item_id,quantity,media,date,description";
     $query .=") VALUES (";
     $query .=" '{$user_id}', '{$item_id}', '{$out_qty}', '{$file_name}', '{$date}', '{$description}'";
     $query .=")";
  
    outgoing_update_item_quantity($out_qty,$item_id);
  
     if($db->query($query)){
       $session->msg('s',"Stock out added successfully ");
       redirect('outgoing.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('add_outgoing.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_outgoing.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Stock Out</h1>
           
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="outgoing.php">Stock Out</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Stock Out</li>
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
                  <h6 class="m-0 font-weight-bold text-primary">Add Stock Out</h6>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data" action="add_outgoing.php">
                  <div class="form-group">
                  <label for="item-name">Item</label> 
                  <select class="form-control" name="item-name">
                      <option value="">Select item to stock out</option>
                    <?php  foreach ($all_item as $product): ?>
                      <option value="<?php echo (int)$product['id'] ?>">
                        <?php echo $product['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                    <div class="form-group">
                    <label for="item-category">Photo</label> 
                    <input name="item-photo" type="file" class="form-control" id="item-photo">
                    </div>
                    <div class="form-group">
                      <label for="item-name">Quantity</label>
                      <input type="number" class="form-control" name="out-quantity" placeholder="Enter item quantity">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea class="form-control" name="description" rows="3" placeholder="Enter description or remark"></textarea>
                    </div>
                    <button type="submit" name="add_out" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
        </div>
        </div>
        </div>

<?php include_once('layouts/footer.php'); ?>
