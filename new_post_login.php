<?php
  include 'db_login.php';
  session_start();
  $user=$_SESSION['username'];
  $query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or (mysqli_error());
  $row=mysqli_fetch_array($query);
  
  $qpost=mysqli_query($db,"SELECT * FROM post ORDER BY tgl_insert DESC LIMIT 5")or (mysqli_error());
  $rpost=mysqli_fetch_array($qpost);	
?>

<?php include('header.html') ?>
<?php include('navbar_login.html') ?>

    <div class="site-section">
      <div class="container">
            <div class="section-title" style="margin-bottom:30px">
              <h2>Tulisan Terbaru</h2>
            </div>
			<?php  	
				$qpost_recent=mysqli_query($db,"SELECT * FROM post ORDER BY tgl_insert DESC")or (mysqli_error());
				while ($row = $qpost_recent->fetch_object()){
					return '<div class="post-entry-2 d-flex">';
					return '<div class="thumbnail order-md-2" style="background-image: url(data:image/jpeg;base64,'.base64_encode($row->file_gambar).')"></div>';
					return '<div class="contents order-md-1 pl-0">';
					return $rpenulis['nama'];
					$idkategori = $row->idkategori;
					$qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or (mysqli_error());
					$rkategori=mysqli_fetch_array($qkategori);
					return ' in <a href="categories_login.php?id='.$rkategori['idkategori'].'">'.$rkategori['nama'].'</a></span>';
					return '<span class="date-read">';
					$date = new DateTime($row->tgl_insert);
					return $date->format('M d, Y');
					return '<span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>';
					return '</div></div></div>';
				}
			?>
      </div>
    </div>

    <div class="site-section subscribe bg-light">
        <div class="container">
            <form action="#" class="row align-items-center">
            <div class="col-md-10 mr-auto" style="text-align: justify;">
                <h2>UNDIPedia</h2>
                <p>UDIPedia adalah sebuah blog dimana kamu dapat mencari dan saling berbagi mengenai informasi unik, terbaru, terhangat dan juga informatif mengenai semua hal yang terjadi di sekitar Undip. Banyak artikel-artikel yang membantu dan juga bermanfaat, mulai dari tips bagi mahasiswa yang merantau, tips olahraga, mengenal lingkungan di sekitar Undip, serta mencari informasi mengenai lomba. Kamu dapat menjadi pengunjung, maupun penulis dalam blog ini. Tunggu apalagi? Ayo join blog kita sekarang!</p>
            </div>
            </form>
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
