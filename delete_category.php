<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(1);
?>
<?php
  $categorie = find_by_id('category',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing Category id.");
    redirect('category.php');
  }
?>
<?php
  $delete_id = delete_by_id('category',(int)$categorie['id']);
  if($delete_id){
      $session->msg("s","Category deleted.");
      redirect('category.php');
  } else {
      $session->msg("d","Category deletion failed.");
      redirect('category.php');
  }
?>
