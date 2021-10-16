<?php
	$id = filter_input(INPUT_GET, 'id');
	#include login information
	require_once('db_login.php');
	#assign query
	$query = " DELETE FROM penulis WHERE idpenulis=".$id." ";
	#execute query
	$result = $db->query($query);
	if (!$result) {
	     ("Could not query the database: <br>".$db->error);
	}else {
	    $db->close();
	    header('Location: view_penulis.php');
	}
	#close db connection
	$db->close();
?>
