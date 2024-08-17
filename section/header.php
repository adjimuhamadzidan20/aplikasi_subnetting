<nav class="navbar navbar-expand-lg bg-info">
  <div class="container">
    <a class="navbar-brand text-white" style="font-weight: bold;">Hitung Subnetting</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
        	<?php  
        		if (isset($_SESSION['login'])) {
        	?>
        		<span class="nav-link text-white"><?= $_SESSION['nama_user']; ?> | <a class="text-white" data-bs-toggle="modal" 
		      	data-bs-target="#logout" style="text-decoration: none; cursor: pointer;">Logout</a></span>
          <?php  
          	}
          ?>
        </li>
      </ul>
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
	        <a href="proses/logout_sistem.php" class="btn btn-outline-info">Logout</a>
	      </div>
    </div>
  </div>
</div>