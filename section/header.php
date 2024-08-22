<nav class="navbar navbar-dark navbar-expand-lg bg-success sticky-top">
  <div class="container">
    <a class="navbar-brand text-white" style="font-weight: bold;">Hitung Subnetting</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    	<?php  
    		if (isset($_SESSION['login'])) {
    	?>
	      <ul class="navbar-nav">
	        <li class="nav-item d-block d-sm-none">
				    <a class="nav-link tab-menu text-white <?= $active1; ?>" aria-current="page" href="index.php?hal=ip_network">IP Jaringan</a>
				  </li>
				  <li class="nav-item d-block d-sm-none">
				    <a class="nav-link tab-menu text-white <?= $active2; ?>" aria-current="page" href="index.php?hal=host_network">Host Jaringan</a>
				  </li>
				  <li class="nav-item d-block d-sm-none">
				    <a class="nav-link tab-menu text-white <?= $active3; ?>" aria-current="page" href="index.php?hal=hasil">Hasil Perhitungan</a>
				  </li>
				  <li class="nav-item dropdown d-block d-sm-none">
				    <a class="nav-link tab-menu dropdown-toggle <?= $active6; ?> text-white" data-bs-toggle="dropdown" role="button" aria-expanded="false">Lainnya</a>
				    <ul class="dropdown-menu">
				      <li>
				      	<a class="dropdown-item <?= $active4; ?>" href="index.php?hal=tentang&link=dropdown">Tentang</a>
				      <li>
				      	<a class="dropdown-item <?= $active5; ?>" href="index.php?hal=penggunaan&link=dropdown">Cara Penggunaan</a>
				      </li>
				    </ul>
				  </li>
				  <li class="nav-item">
	        	<span class="nav-link text-white"><?= $_SESSION['nama_user']; ?> | <a class="text-white" data-bs-toggle="modal" 
			      data-bs-target="#logout" style="text-decoration: none; cursor: pointer;">Logout</a></span>
	        </li>
	      </ul>
      <?php  
        }
      ?>	
    </div>
  </div>
</nav>

<!-- Modal logout -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Keluar dari dashboard</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	Anda ingin keluar dari dashboard?
      </div>
      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
	        <a href="proses/logout_sistem.php" class="btn btn-outline-success">Logout</a>
	      </div>
    </div>
  </div>
</div>