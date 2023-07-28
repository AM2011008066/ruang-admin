<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(2);
?>
<?php
  $product = find_by_id('item',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","Missing Item id.");
    redirect('item.php');
  }
?>
<?php
  $delete_id = delete_by_id('item',(int)$product['id']);
  if($delete_id){
      $session->msg("s","Item deleted.");
      redirect('item.php');
  } else {
      $session->msg("d","Item deletion failed.");
      redirect('item.php');
  }
?>
