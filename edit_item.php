<?php
  $page_title = 'Edit item';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(2);
?>
<?php  
$item = find_by_id('item',(int)$_GET['id']);
$all_categories = find_all('category');
$all_photo = find_all('media');
if(!$item){
  $session->msg("d","Missing item id.");
  redirect('item.php');
}
?>
<?php
 if(isset($_POST['edit_item'])){
    $req_fields = array('item-name','item-category');
    validate_fields($req_fields);

   if(empty($errors)){
       $item_name  = remove_junk($db->escape($_POST['item-name']));
       $item_cat   = (int)$_POST['item-category'];
      //  $item_qty   = remove_junk($db->escape($_POST['item-quantity']));
       /*if (is_null($_POST['item-photo']) || $_POST['item-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['item-photo']));
       }*/
       $query   = "UPDATE item SET";
       $query  .=" name ='{$item_name}',";
       $query  .=" categorie_id ='{$item_cat}'";
       $query  .=" WHERE id ='{$item['id']}'";
       $result = $db->query($query);
       
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Item updated ");
                 redirect('item.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_item.php?id='.$item['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_item.php?id='.$item['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Item</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="item.php">Item</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
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
                  <h6 class="m-0 font-weight-bold text-primary">Edit Item</h6>
                </div>
                <div class="card-body">
                  <form method="post" action="edit_item.php?id=<?php echo (int)$item['id'] ?>">
                    <div class="form-group">
                      <label for="item-name">Item Name</label>
                      <input type="text" class="form-control" 
                      name="item-name" value="<?php echo remove_junk($item['name']);?>">
                    </div>
                    <div class="form-group">
                      <label for="item-category">Category</label>
                      <select class="form-control" name="item-category">
                      <?php  foreach ($all_categories as $cat): ?>
                        <option value="<?php echo (int)$cat['id']; ?>" <?php if($item['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                          <?php echo remove_junk($cat['name']); ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                    <button type="submit" name="edit_item" class="btn btn-primary">Update</button>
                  </form>
                </div>
              </div>
          </div>
                      </div>
                      </div>
<?php include_once('layouts/footer.php'); ?>
