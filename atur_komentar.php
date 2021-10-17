<?php
  include 'db_login.php';
  session_start();
  $user=$_SESSION['username'];
  $query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or (mysqli_error());
  $row=mysqli_fetch_array($query);
  
  $idpost = $_GET['id'];
  $qpost=mysqli_query($db,"SELECT * FROM post where idpost='$idpost'")or (mysqli_error());
  $rpost=mysqli_fetch_array($qpost);
	
  $idpenulis = $rpost['idpenulis'];
  $qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or (mysqli_error());
  $rpenulis=mysqli_fetch_array($qpenulis);

  $idkategori = $rpost['idkategori'];
  $qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or (mysqli_error());
  $rkategori=mysqli_fetch_array($qkategori);
?>

<?php include('header.html') ?>
<?php include('navbar_login.html') ?>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 single-content">
            
            <p class="mb-5">
				<?php print_r '<img src="data:image/jpeg;base64,'.base64_encode($rpost['file_gambar']).'" width="700" height="400"/>';
				?>
            </p>  
            <h1 class="mb-3">
				<?php print_r $rpost['judul'];?>
			</h1>
            <div class="post-meta d-flex mb-4">
              <div class="vcard">
                <span class="d-block"><?php print_r $rpenulis['nama'];?> in
				<?php 
					print_r '<a href="categories_login.php?id='.$idkategori.'">';
					print_r $rkategori['nama'];
				?></a></span>
                <span class="date-read"><?php
					$date = new DateTime($rpost['tgl_insert']);
					print_r $date->format('M d, Y');
				?><span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>
              </div>
            </div>
				<?php print_r $rpost['isipost'];?>
            <div class="pt-5">
                    <p>Categories:  
					<?php 
						print_r '<a href="categories_login.php?id='.$idkategori.'">';
						print_r $rkategori['nama'];
					?></a></p>
                  </div>
				  
                  <div class="pt-5">
                    <div class="section-title" style="margin-bottom: 20px">
                      <h2>
						<?php	
							$result = $db->query(" SELECT * FROM komentar WHERE idpost=$idpost AND idpenulis=$idpenulis");
							print_r $result->num_rows.'&nbsp;&nbsp';
						?>
					  Comments</h2>
                    </div>
                    <ul class="comment-list">
                      <li class="comment">
						<div class="container">
						  <script>
							function confirmationDelete(anchor){
							var conf = confirm('Are you sure want to delete this comment?');
							if(conf)
								window.location=anchor.attr("href");
							}
						  </script>
							<?php
							  while ($rkomen = $result->fetch_object()){
								  print_r '<div class="row">';
								  print_r '<div class="col-md-3">';
								  print_r '<h5 style="margin-bottom: 0px">Anonim</h5>';
								  $dkomen = new DateTime(''.$rkomen->tgl_update.'');
								  print_r '<span class="date-read">';
								  print_r $dkomen->format('M d, Y');
								  print_r '</span><br>';
								  print_r ''.$rkomen->isi.'';
								  print_r '</div><div class="col-md-3">';
								  print_r '<br><a onclick="javascript:confirmationDelete($(this));return false;" class="btn btn-danger btn-sm" href="delete_komen.php?id='.$rkomen->idkomentar.'&idpost='.$idpost.'">Delete</a>';
								  print_r '</div>';
								  print_r '</div><br>';
							  }
							?>
						</div>
                      </li>
					</ul>
                    <!-- END comment-list -->
                    
                  </div>
          </div>


        </div>
        
      </div>
    </div>

  <!-- .site-wrap -->


  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>

</html>
