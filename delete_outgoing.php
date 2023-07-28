<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(2);
?>
<?php
  $outgoing = find_by_id('outgoing',(int)$_GET['id']);
  if(!$outgoing){
    $session->msg("d","Missing Stock Out id.");
    redirect('outgoing.php');
  }
?>
<?php
  $delete_id = delete_by_id('outgoing',(int)$outgoing['id']);
  if($delete_id){
      $session->msg("s","Stock Out deleted.");
      redirect('outgoing.php');
  } else {
      $session->msg("d","Stock Out deletion failed.");
      redirect('outgoing.php');
  }
?>
