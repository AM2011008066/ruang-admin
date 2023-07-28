<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(2);
?>
<?php
  $incoming = find_by_id('incoming',(int)$_GET['id']);
  if(!$incoming){
    $session->msg("d","Missing Stock In id.");
    redirect('incoming.php');
  }
?>
<?php
  $delete_id = delete_by_id('incoming',(int)$incoming['id']);
  if($delete_id){
      $session->msg("s","Stock In deleted.");
      redirect('incoming.php');
  } else {
      $session->msg("d","Stock In deletion failed.");
      redirect('incoming.php');
  }
?>
