<?php


$page_title = 'Edit Stock In';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
//page_require_level(2);
?>
<?php
$incoming = find_by_id('incoming', (int)$_GET['id']);
$all_item = find_all('item');
$all_media = find_all('media');

if (!$incoming) {
  $session->msg("d", "Missing Stock In id.");
  redirect('incoming.php');
}
?>
<?php
if (isset($_POST['edit_in'])) {
  $req_fields = array('description');
  validate_fields($req_fields);

  if (empty($errors)) {
    // $user_id = $user["id"];
    // $item_id  = remove_junk($db->escape($_POST['item-name']));
    // $in_qty   = remove_junk($db->escape($_POST['in-quantity']));

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
    $query   = "UPDATE incoming SET";
    // $query  .= " item_id ='{$item_id}',";
    $query  .= " media ='{$file_name}', date ='{$date}', description = '{$description}'";
    $query  .= " WHERE id ='{$incoming['id']}'";
    // incoming_update_item_quantity($in_qty, $item_id);
    $result = $db->query($query);

    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Incoming transaction updated ");
      redirect('incoming.php', false);
    } else {
      $session->msg('d', ' Sorry failed to updated!');
      redirect('edit_incoming.php?id=' . $incoming['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_incoming.php?id=' . $incoming['id'], false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Stock In</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item"><a href="incoming.php">Stock In</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Stock In</li>
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
              <h6 class="m-0 font-weight-bold text-primary">Edit Stock In</h6>
            </div>
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" action="edit_incoming.php?id=<?php echo (int)$incoming['id'] ?>">
                <!-- <div class="form-group">
                  <label for="name">Item</label>
                  <select class="form-control" name="item-name">
                    <option value=""> Select an item</option>
                    <?php foreach ($all_item as $item) : ?>
                      <option value="<?php echo (int)$item['id']; ?>" <?php if ($incoming['item_id'] === $item['id']) : echo "selected";
                                                                      endif; ?>>
                        <?php echo remove_junk($item['name']); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div> -->
                <div class="form-group">
                  <label for="item-photo">Photo</label>
                  <input name="item-photo" type="file" class="form-control" id="item-photo" >
                </div>
                <!-- <div class="form-group">
                  <label for="item-name">Quantity</label>
                  <input type="number" class="form-control" name="in-quantity" value="<?php echo remove_junk($incoming['quantity']); ?>">
                </div> -->
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" rows="3"><?php echo remove_junk($incoming['description']); ?></textarea>
                </div>
                <button type="submit" name="edit_in" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include_once('layouts/footer.php'); ?>