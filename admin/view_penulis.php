<?php include('sidebar.php') ?>

<div class="main">
    <div class="py-0">
        <div class="half-post-entry d-block d-lg-flex bg-light">
          <div class="contents">
            <h2><a href="blog-single.html">DASHBOARD ADMIN</a></h2>
            <h3 class="mb-3">Melihat Penulis</h3>
          </div>
      </div>
      <br>
          <div class="container">
          <div class="card">
          <div class="card-header">Daftar Penulis</div>
          <div class="card-body">
          <br>
          <table class="table table-striped">
              <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Kota</th>
              <th>No Telpon</th>
              <th>Action</th>
            </tr>

          <?php
          // Include our login information
          require_once('db_login.php');
          // Execute the query
          $result = $db->query(" SELECT * FROM penulis ORDER BY idpenulis ");
          if (!$result){
              ("Could not query the database: <br />". $db->error);
          }
          // Fetch and display the results
          $i = 1;
          while ($row = $result->fetch_object()){
            print_r '<tr>';
              print_r '<td>'.$i.'</td>';
              print_r '<td>'.$row->nama.'</td> ';
              print_r '<td>'.$row->alamat.'</td> ';
              print_r '<td>'.$row->kota.'</td> ';
              print_r '<td>'.$row->no_telp.'</td> ';
              print_r '<td><a class="btn btn-warning btn-sm" href="edit_penulis.php?id='.$row->idpenulis.'">Edit</a>&nbsp;&nbsp; 
                <a class="btn btn-danger btn-sm" href="confirm_delete_penulis.php?id='.$row->idpenulis.'">Delete</a>
                </td>';
            print_r '</tr>';
            $i++;
          }
          print_r '</table>';
          print_r '<br />';
          print_r 'Total Rows = '.$result->num_rows;
          $result->free();
          $db->close();
          ?>
          </table>
        <br>
        </div>
        </div>
        </div>
<br><br><br>
  </div>
</div>
<?php include('footer.html') ?>
