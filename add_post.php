<?php
  include 'db_login.php';
  session_start();
$user=filter_input(INPUT_SESSION, 'username');
$query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
?>

<?php include('header.html') ?>
<?php include('navbar_login.html') ?>

<?php

if (isset(filter_input(INPUT_POST, 'submit'))) {
    $valid = TRUE;
    $judul = test_input(filter_input(INPUT_POST, 'judul'));
    if ($judul == '') {
        $error_judul = "Name is required";
        $valid = FALSE;
    }
	$kategori = test_input(filter_input(INPUT_POST, 'kategori'));
	$isi = test_input(filter_input(INPUT_POST, 'isi'));
    if ($isi == '') {
        $error_isi = "Isi post is required";
        $valid = FALSE;
    }

	
    if($valid){
        #escape inputs data
        $judul = $db->real_escape_string($judul);
		$idpenulis = $row['idpenulis'];
		$imgData = addslashes(file_get_contents(filter_input(INPUT_FILES, 'gambar', 'tmp_name')));
        #assign a query
        $query = " INSERT INTO post(judul,idkategori,isipost,file_gambar,idpenulis) VALUES('".$judul."',$kategori,'".$isi."','{$imgData}',$idpenulis)";
        #execute query
        $result =$db->query($query);
        if (!$result) {
             ("could not query the database: <br>".$db->error.'<br>Query:'.$query);
        }
        else {
            header('Location: view_post.php');
        }
        #close connection
        $db->close();
    }
}
?>

<br><br><br><br>
<div class="container">
<div class="card">
<div class="card-header">Add Post</div>
<div class="card-body">
<form method="POST" autocomplete="on" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="judul">Judul :</label>
        <input type="text" class="form-control" id="judul" name="judul">
        <div class="error"><?php if (isset($error_judul)) print_r $error_judul;?></div>
    </div>
    <div class="form-group">
        <label for="kategori">Kategori :</label>
        <select id="kategori" name="kategori" class="form-control">
			<?php
				require_once('db_login.php');
				$query = " SELECT * FROM kategori ORDER BY idkategori ";
				#execute query
				$result =$db->query($query);
				if (!$result) {
					("Could not query the database: <br>".$db->error);
				}
				while ($row=$result->fetch_object()) {
					print_r'<option value="'.$row->idkategori.'">'.$row->nama.'</option>';
				}
				$result->free();
				$db->close();
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="isi">Isi Post :</label>
        <textarea class="form-control" id="isi" name="isi" rows="5" cols="40" minlength="5"></textarea>
        <div class="error"><?php if (isset($error_isi)) print_r $error_isi;?></div>
    </div>
    <div class="form-group">
      <label>Pilih file gambar :</label><br>
      <input class="inputFile" type="file" id="gambar" name="gambar">
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="submit">
    <a href="view_post.php" class="btn btn-secondary">Cancel</a>
</form>
</div>
</div>
</div>
<br><br>
<?php include('footer.html') ?>
