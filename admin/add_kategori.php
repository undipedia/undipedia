<?php
require_once('db_login.php');
if (isset(filter_input(INPUT_POST, 'submit'))) {
    $valid = TRUE;
    $nama = test_input(filter_input(INPUT_POST, 'nama'));
    if ($nama == '') {
        $error_nama = "Name is required";
        $valid = FALSE;
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/",$nama)) {
        $error_nama = "Only letters and white space allowed";
        $valid = FALSE;
    }

    if($valid){
        #escape inputs data
        $nama = $db->real_escape_string($nama);
        #assign a query
        $query = " INSERT INTO kategori (nama) VALUES('".$nama."') ";
        #execute query
        $result =$db->query($query);
        if (!$result) {
             ("could not query the database: <br>".$db->error.'<br>Query:'.$query);
        }
        else {
            header('Location: view_kategori.php');
        }
        #close connection
        $db->close();
    }
}
?>
<?php include('sidebar.php') ?>

<div class="main">
    <div class="py-0">
        <div class="half-post-entry d-block d-lg-flex bg-light">
          <div class="contents">
            <h2><a href="blog-single.html">DASHBOARD ADMIN</a></h2>
            <h3 class="mb-3">Menambahkan kategori</h3>
          </div>
      </div>
      <div class="container">
        <br><br>
        <div class=card>
        <div class="card-header">Add Kategori</div>
        <div class="card-body">
        <br>
        <form method="POST" autocomplete="on" action="<?php print_r htmlspecialchars(filter_input(INPUT_SERVER, 'PHP_SELF')); ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama">
                <div class="error"><?php if (isset($error_nama)) print_r $error_nama;?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_kategori.php" class="btn btn-secondary">Cancel</a>
        </form>
        </div>
        </div>
        </div>
<br><br><br>
  </div>
</div>
<?php include('footer.html') ?>
