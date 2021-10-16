<?php
  include 'db_login.php';
  session_start();
	$user=filter_input(INPUT_SESSION, 'username');
	$query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or (mysqli_error());
	$row=mysqli_fetch_array($query);
    if(isset(filter_input(INPUT_GET, 'id')))
      {
        $id=filter_input(INPUT_GET, 'id');
		$idpost=filter_input(INPUT_GET, 'idpost');
        $query = " delete from komentar where idkomentar='$id' ";
        $result =$db->query($query);
        if($result)
          {
          header('location:atur_komentar.php?id='.$idpost.'');
          }
      }
?>
