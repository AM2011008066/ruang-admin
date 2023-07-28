<?php
  $page_title = 'Edit Group';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(2);
?>
<?php
  $e_group = find_by_id('user_groups',(int)$_GET['id']);
  if(!$e_group){
    $session->msg("d","Missing Group id.");
    redirect('group.php');
  }
?>
<?php
  if(isset($_POST['edit_group'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);
   if(empty($errors)){
          $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "UPDATE user_groups SET ";
        $query .= "group_name='{$name}',group_level='{$level}',group_status='{$status}'";
        $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Group has been updated! ");
          redirect('group.php?id='.(int)$e_group['id'], false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to updated Group!');
          redirect('edit_group.php?id='.(int)$e_group['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('edit_group.php?id='.(int)$e_group['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Group</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="group.php">Group</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Group</li>
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
                  <h6 class="m-0 font-weight-bold text-primary">Edit Group</h6>
                </div>
                <div class="card-body">
                  <form method="post" action="edit_group.php?id=<?php echo (int)$e_group['id'];?>">
                    <div class="form-group">
                      <label for="name">Group Name</label>
                      <input type="name" class="form-control" name="group-name"
                      value="<?php echo remove_junk(ucwords($e_group['group_name'])); ?>">
                    </div>
                    <div class="form-group">
                    <label for="level">Group Level</label>
                    <input type="number" class="form-control" name="group-level" value="<?php echo (int)$e_group['group_level']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control mb-3" name="status">
                      <option <?php if($e_group['group_status'] === '1') echo 'selected="selected"';?> value="1"> Active </option>
                      <option <?php if($e_group['group_status'] === '0') echo 'selected="selected"';?> value="0"> Inactive</option>
                      </select>
                    </div>
                    <button type="submit" name="edit_group" class="btn btn-primary">Update</button>
                  </form>
                </div>
              </div>
  </div>
</div>
</div>

<?php include_once('layouts/footer.php'); ?>
