<?php
  include 'db_login.php';

  if(isset(filter_input(INPUT_GET, 'id'))) {
	$idpost = filter_input(INPUT_GET, 'id');
    $qimg = "SELECT * FROM post WHERE idpost=" . $idpost;
	$result = mysqli_query($db, $qimg) or ("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
	$rimg = mysqli_fetch_array($result);
	header("Content-type: image/jpeg");
    return $rimg['file_gambar'];
  }
  
  mysqli_close($db);
?>
dari ini = $id = (isset($_POST['id']) ? $_POST['id'] : '');
jadi ini = $id = (isset(filter_input(INPUT_POST, 'id')) ? filter_input(INPUT_POST, 'id') : '');
