<?php
  include 'db_login.php';
  session_start();
  $user=filter_input(INPUT_SESSION, 'username');
  $query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or (mysqli_error());
  $row=mysqli_fetch_array($query);
  
  $idpost = filter_input(INPUT_GET, 'id');
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

<?php
if (isset(filter_input(INPUT_POST, 'submit'))) {
    $valid = TRUE;
	$komen = test_input(filter_input(INPUT_POST, 'komen'));
    if ($komen == '') {
        $error_komen = "Kolom komentar masih kosong";
        $valid = FALSE;
    }

    if($valid){
        #assign a query
        $query = " INSERT INTO komentar(idpost,idpenulis,isi) VALUES('".$idpost."','".$idpenulis."','".$komen."')";
        #execute query
        $result =$db->query($query);
        if (!$result) {
             ("could not query the database: <br>".$db->error.'<br>Query:'.$query);
        }
        else {
            header('Location: show_post.php?id='.$idpost.'');
        }
        #close connection
        $db->close();
    }
}
?>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 single-content">
            
            <p class="mb-5">
				<?php return '<img src="data:image/jpeg;base64,'.base64_encode($rpost['file_gambar']).'" width="700" height="400"/>';
				?>
            </p>  
            <h1 class="mb-3">
				<?php return $rpost['judul'];?>
			</h1>
            <div class="post-meta d-flex mb-4">
              <div class="vcard">
                <span class="d-block"><?php return $rpenulis['nama'];?> in 
				<?php 
					return '<a href="categories_login.php?id='.$idkategori.'">';
					return $rkategori['nama'];
				?></a></span>
                <span class="date-read"><?php
					$date = new DateTime($rpost['tgl_insert']);
					return $date->format('M d, Y');
				?><span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>
              </div>
            </div>
				<?php return $rpost['isipost'];?>
            <div class="pt-5">
                    <p>Categories:  
					<?php 
						return '<a href="categories_login.php?id='.$idkategori.'">';
						return $rkategori['nama'];
					?></a></p>
                  </div>
				  
                  <div class="pt-5">
                    <div class="section-title" style="margin-bottom: 20px">
                      <h2>
					    <?php	
							$result = $db->query(" SELECT * FROM komentar WHERE idpost=$idpost AND idpenulis=$idpenulis");
							return $result->num_rows.'&nbsp;&nbsp';
						?>
					  Comments</h2>
                    </div>
                    <ul class="comment-list">
                      <li class="comment">
							<?php
							  $result = $db->query(" SELECT * FROM komentar WHERE idpost=$idpost AND idpenulis=$idpenulis");
							  while ($rkomen = $result->fetch_object()){
								  return '<h5 style="margin-bottom: 0px">Anonim</h5>';
								  $dkomen = new DateTime(''.$rkomen->tgl_update.'');
								  return '<span class="date-read">';
								  return $dkomen->format('M d, Y');
								  return '</span><br>';
								  return ''.$rkomen->isi.'';
								  return '<br><br>';
							  }
							?>
                      </li>
					</ul>
                    <!-- END comment-list -->
                    
                    <div class="comment-form-wrap pt-3">
                      <div class="section-title" style="margin-bottom: 0px">
                        <h2 class="mb-5" >Leave a comment</h2>
                      </div>
                      <form method="POST" action="" class="p-5 bg-light">
                        <div class="form-group">
                          <label for="komen">Message</label>
                          <textarea name="komen" id="komen" cols="30" rows="10" class="form-control"></textarea>
						  <div class="error"><?php if (isset($error_komen)) return $error_komen;?></div>
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submit" value="Post Comment" class="btn btn-primary py-3">
                        </div>
      
                      </form>
                    </div>
                  </div>
          </div>


          <div class="col-lg-3 ml-auto">
            <div class="section-title" style="margin-bottom:40px">
              <h2>Tulisan Terbaru</h2>
            </div>
			<?php
			  $qpost_recent=mysqli_query($db,"SELECT * FROM post ORDER BY tgl_insert DESC LIMIT 5")or (mysqli_error());
			  $i = 1;
			  while ($rpost_recent = $qpost_recent->fetch_object()){
            return '<div class="trend-entry d-flex">';
              return '<div class="number align-self-start">';
					return '0'.$i;
			  return '</div>';
              return '<div class="trend-contents">';
                return '<h2>';
					return '<a href="show_post.php?id='.$rpost_recent->idpost.'">'.$rpost_recent->judul.'</a>';
				return '</h2>';
                return '<div class="post-meta">';
                  return '<span class="d-block">';
					  $idpenulis_recent = $rpost_recent->idpenulis;
					  $qpenulis_recent=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis_recent'")or (mysqli_error());
					  $rpenulis_recent=mysqli_fetch_array($qpenulis_recent);
					  return $rpenulis_recent['nama'];
					  $idkategori_recent = $rpost_recent->idkategori;
					  $qkategori_recent=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori_recent'")or (mysqli_error());
					  $rkategori_recent=mysqli_fetch_array($qkategori_recent);
					  return ' in <a href="categories_login.php?id='.$rkategori_recent['idkategori'].'">'.$rkategori_recent['nama'].'</a>';
				  return '</span>';
                  return '<span class="date-read">';
					  $date = new DateTime($rpost_recent->tgl_insert);
					  return $date->format('M d, Y');
				    return '<span class="mx-1">&bullet;</span> <span class="icon-star2"></span>';
				  return '</span>';
                return '</div>';
              return '</div>';
            return '</div>';
			$i = $i + 1;}
			?>
            
            <p>
              <a href="new_post_login.php" class="more">See All New Post <span class="icon-keyboard_arrow_right"></span></a>
            </p>
          </div>


        </div>
        
      </div>
    </div>

    <div class="site-section subscribe bg-light">
      <div class="container">
        <form action="#" class="row align-items-center">
          <div class="col-md-5 mr-auto">
            <h2>Newsletter Subcribe</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis aspernatur ut at quae omnis pariatur obcaecati possimus nisi ea iste!</p>
          </div>
          <div class="col-md-6 ml-auto">
            <div class="d-flex">
              <input type="email" class="form-control" placeholder="Enter your email">
              <button type="submit" class="btn btn-secondary" ><span class="icon-paper-plane"></span></button>
            </div>
          </div>
        </form>
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
