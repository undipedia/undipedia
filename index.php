o<?php
  include 'db_login.php';
  
  $qpost=mysqli_query($db,"SELECT * FROM post ORDER BY tgl_insert DESC LIMIT 6")or die(mysqli_error());
  $rpost=mysqli_fetch_array($qpost);	
?>

<?php include('header.html') ?>
<?php include('navbar.html') ?>

 <div class="site-section py-0">
	<?php
	  $qpost_new=mysqli_query($db,"SELECT * FROM post ORDER BY tgl_insert DESC")or die(mysqli_error());
	  $rpost_new=mysqli_fetch_array($qpost_new);	  
	?>
      <div class="owl-carousel hero-slide owl-style">
        <div class="site-section">
          <div class="container">
            <div class="half-post-entry d-block d-lg-flex bg-light">
			<?php
				return '<div class="img-bg" style="background-image: url(data:image/jpeg;base64,'.base64_encode($rpost_new['file_gambar']).')"></div>';
            ?>
			  <div class="contents">
                <span class="caption">Topik Hangat</span>                
				<?php
					return '<h2><a href="show_post_pengunjung.php?id='.$rpost_new['idpost'].'">'.$rpost_new['judul'].'</a></h2>';
					return '<p class="mb-3">';
					$text=$rpost_new['isipost'];
					$num_char=310;
					$cut_text = substr($text, 0, $num_char);
					if ($text{$num_char - 1} != ' ') {
						$new_pos = strrpos($cut_text, ' ');
						$cut_text = substr($text, 0, $new_pos);
					}
					return $cut_text . '...';

					$char     = $text{$num_char - 1};
					while($char != ' ') {
						$char = $text{--$num_char};
					}
					return substr($text, 0, $num_char) . '...';
					return '</p>';
                ?>
				<div class="post-meta">
                  <span class="d-block">
				  <?php
				  $idpenulis = $rpost['idpenulis'];
				  $qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
				  $rpenulis=mysqli_fetch_array($qpenulis);
				  return $rpenulis['nama'];
				  $idkategori = $rpost['idkategori'];
				  $qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
				  $rkategori=mysqli_fetch_array($qkategori);
					return ' in <a href="categories.php?id='.$rpost_new['idkategori'].'">';
					return $rkategori['nama'];
					return '</a></span>';
				  ?>
					<span class="date-read">
					<?php
					$date = new DateTime($rpost['tgl_insert']);
					return $date->format('M d, Y');
					?>
				  <span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="site-section">
          <div class="container">
            <div class="half-post-entry d-block d-lg-flex bg-light">
			<?php
				$rpost_new=mysqli_fetch_array($qpost_new);
				retrun '<div class="img-bg" style="background-image: url(data:image/jpeg;base64,'.base64_encode($rpost_new['file_gambar']).')"></div>';
            ?>
			  <div class="contents">
                <span class="caption">Topik Hangat</span>                
				<?php
					return '<h2><a href="show_post_pengunjung.php?id='.$rpost_new['idpost'].'">'.$rpost_new['judul'].'</a></h2>';
					return '<p class="mb-3">';
					$text=$rpost_new['isipost'];
					$num_char=310;
					$cut_text = substr($text, 0, $num_char);
					if ($text{$num_char - 1} != ' ') {
						$new_pos = strrpos($cut_text, ' ');
						$cut_text = substr($text, 0, $new_pos);
					}
					return $cut_text . '...';

					$char     = $text{$num_char - 1};
					while($char != ' ') {
						$char = $text{--$num_char};
					}
					return substr($text, 0, $num_char) . '...';
					return '</p>';
                ?>
				<div class="post-meta">
                  <span class="d-block">
				  <?php
				  $idpenulis = $rpost['idpenulis'];
				  $qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
				  $rpenulis=mysqli_fetch_array($qpenulis);
				  return $rpenulis['nama'];
				  $idkategori = $rpost['idkategori'];
				  $qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
				  $rkategori=mysqli_fetch_array($qkategori);
					return ' in <a href="categories.php?id='.$rpost_new['idkategori'].'">';
					return $rkategori['nama'];
					return '</a></span>';
				  ?>
					<span class="date-read">
					<?php
					$date = new DateTime($rpost['tgl_insert']);
					return $date->format('M d, Y');
					?>
				  <span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="section-title" style="margin-bottom:30px">
                  <h2>Tulisan Terbaru</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="post-entry-1">
				  <?php return '<a href="show_post_pengunjung.php?id='.$rpost['idpost'].'">';
					return '<img src="data:image/jpeg;base64,'.base64_encode($rpost['file_gambar']).'" alt="Image" class="img-fluid"/>';
				  ?>
				  </a>
                  <h2>
					<?php 
						return '<a href="show_post_pengunjung.php?id='.$rpost['idpost'].'">';
						return $rpost['judul'];
						return '</a>';
					?>
				  </h2>
					<?php
						return '<p>';
						$text=$rpost['isipost'];
						$num_char=310;
						$cut_text = substr($text, 0, $num_char);
						if ($text{$num_char - 1} != ' ') {
							$new_pos = strrpos($cut_text, ' ');
							$cut_text = substr($text, 0, $new_pos);
						}
						return $cut_text . '...';

						$char     = $text{$num_char - 1};
						while($char != ' ') {
							$char = $text{--$num_char};
						}
						return substr($text, 0, $num_char) . '...';
						return '</p>';
					?>
                  <div class="post-meta">
					  <div class="vcard">
						<span class="d-block"><?php 
						  $idpenulis = $rpost['idpenulis'];
						  $qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
						  $rpenulis=mysqli_fetch_array($qpenulis);
						  return $rpenulis['nama'];
						  $idkategori = $rpost['idkategori'];
						  $qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
						  $rkategori=mysqli_fetch_array($qkategori);
							return ' in <a href="categories.php?id='.$rkategori['idkategori'].'">'.$rkategori['nama'].'</a></span>';
							return '<span class="date-read">';
							$date = new DateTime($rpost['tgl_insert']);
							return $date->format('M d, Y');
						?><span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>
					  </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
				<?php  	
					while ($row = $qpost->fetch_object()){
						return '<div class="post-entry-2 d-flex">';
						return '<div class="thumbnail" style="background-image: url(data:image/jpeg;base64,'.base64_encode($row->file_gambar).')"></div>';
						return '<div class="contents">';
						return '<h2><a href="show_post_pengunjung.php?id='.$row->idpost.'">'.$row->judul.'</a></h2>';
						return '<div class="post-meta">';
						return '<span class="d-block">';
						$idpenulis = $row->idpenulis;
						$qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
						$rpenulis=mysqli_fetch_array($qpenulis);
						return $rpenulis['nama'];
						$idkategori = $row->idkategori;
						$qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
						$rkategori=mysqli_fetch_array($qkategori);
						return ' in <a href="categories.php?id='.$rkategori['idkategori'].'">'.$rkategori['nama'].'</a></span>';
						return '<span class="date-read">';
						$date = new DateTime($row->tgl_insert);
						return $date->format('M d, Y');
						return '<span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>';
						return '</div></div></div>';
					}
				?>
				<p>
				  <a href="new_post.php" class="more">See All New Post <span class="icon-keyboard_arrow_right"></span></a>
				</p>
              </div>
            </div>
      </div>
    </div>
    <!-- END section -->

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
<?php include('footer.html') ?>
