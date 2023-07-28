<?php
  $page_title = 'Add Group';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(2);
?>
<?php
  if(isset($_POST['add_group'])){ 

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);

   if(find_by_groupName($_POST['group-name']) === false ){
     $session->msg('d','<b>Sorry!</b> Entered Group Name already in database!');
     redirect('add_group.php', false);
   }elseif(find_by_groupLevel($_POST['group-level']) === false) {
     $session->msg('d','<b>Sorry!</b> Entered Group Level already in database!');
     redirect('add_group.php', false);
   }
   if(empty($errors)){
         $name = remove_junk($db->escape($_POST['group-name']));
         $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "INSERT INTO user_groups (";
        $query .="group_name,group_level,group_status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$level}','{$status}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Group has been created! ");
          redirect('group.php', false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to create Group!');
          redirect('add_group.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_group.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Group</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="group.php">Group</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Group</li>
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
                  <h6 class="m-0 font-weight-bold text-primary">Add Group</h6>
                </div>
                <div class="card-body">
                  <form method="post" action="add_group.php">
                    <div class="form-group">
                      <label for="name">Group Name</label>
                      <input type="name" class="form-control" name="group-name"
                        placeholder="Enter group name">
                    </div>
                    <div class="form-group">
                    <label for="level">Group Level</label>
                    <input type="number" class="form-control" name="group-level"  placeholder="Enter group level">
                    </div>
                    <div class="form-group">
                    <label for="status">Status</label>
                      <select class="form-control mb-3" name="status">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                      </select>
                    </div>
                    <button type="submit" name="add_group" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
           </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
