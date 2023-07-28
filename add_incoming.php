<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$page_title = 'Add Stock In';
require_once('includes/load.php');

$all_item = find_all('item');
$all_photo = find_all('media');
$user = current_user();

?>
<?php $media = find_all('media'); ?>

<?php
if (isset($_POST['add_in'])) {
  $media = new Media();
  $req_fields = array('item-name', 'in-quantity', 'description');
  validate_fields($req_fields);
  if (empty($errors)) {
    $user_id = $user["id"];
    $item_id  = remove_junk($db->escape($_POST['item-name']));
    $in_qty   = remove_junk($db->escape($_POST['in-quantity']));
    if (is_null($_FILES['item-photo'])) {
      $file_name = '0';
    } else {
      $file_name = $_FILES['item-photo']['name'];
    }
    $media->upload($_FILES['item-photo']);
    $media->process_media();

    $date    = make_date();
    $description = remove_junk($db->escape($_POST['description']));
    $query  = "INSERT INTO incoming (";
    $query .= " user_id,item_id,quantity,media,date,description";
    $query .= ") VALUES (";
    $query .= " '{$user_id}', '{$item_id}', '{$in_qty}', '{$file_name}', '{$date}', '{$description}'";
    $query .= ")";

    incoming_update_item_quantity($in_qty, $item_id);

    if ($db->query($query)) {
      $session->msg('s', "Stock in added successfully ");
      redirect('incoming.php', false);
    } else {
      $session->msg('d', ' Sorry failed to added!');
      redirect('add_incoming.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_incoming.php', false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Stock In</h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item"><a href="incoming.php">Stock In</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Stock In</li>
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
              <h6 class="m-0 font-weight-bold text-primary">Add Stock In</h6>
            </div>
            <div class="card-body">
              <form method="post" action="add_incoming.php" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="item-name">Item</label>
                  <select class="form-control" name="item-name">
                    <option value="">Select item to stock in</option>
                    <?php foreach ($all_item as $product) : ?>
                      <option value="<?php echo (int)$product['id'] ?>">
                        <?php echo $product['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="item-photo">Photo</label>
                  <input name="item-photo" type="file" class="form-control" id="item-photo">
                </div>
                <div class="form-group">
                  <label for="item-name">Quantity</label>
                  <input type="number" class="form-control" name="in-quantity" placeholder="Enter item quantity">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <!-- <input type="text" class="form-control" name="description" placeholder="Enter description or note"> -->
                  <textarea class="form-control" name="description" rows="3" placeholder="Enter description or remark"></textarea>
                </div>
                <button type="submit" name="add_in" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php include_once('layouts/footer.php'); ?>