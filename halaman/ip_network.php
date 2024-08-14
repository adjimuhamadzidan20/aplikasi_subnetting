<?php  
	session_start();
	require 'proses/koneksi_database.php';

	$query = "SELECT * FROM tb_network";
	$return = mysqli_query($conn, $query);

	$data = [];
	while ($row = mysqli_fetch_assoc($return)) {
		$data[] = $row;
	}

?>

<div class="container">
	<div class="judul my-3">
		<h3>IP Network</h3>	
	</div>
	<div class="input-ip mb-4">
		<form action="proses/ip_network_proses.php?proses=tambah" method="post">
		  <div class="mb-2">
		  	<div class="row">
		  		<div class="col-5">
		  			<input type="text" class="form-control" placeholder="Masukkan Alamat IP" name="alamat_ip" required>
		  		</div>
		  	</div>
		  </div>
		  <div class="mb-3">
		  	<div class="row">
		  		<div class="col-5">
		  			<input type="text" class="form-control" placeholder="Masukkan Slash IP" name="slash_ip" required>
		  		</div>
		  	</div>
		  	<span class="text-secondary" style="font-size: 12px;"><i>*IP Network tidak bisa dimasukkan lebih dari 1</i></span>
		  </div>
		  <button type="submit" class="btn btn-outline-secondary">Simpan</button>
		</form>
	</div>

	<?php  
		if (isset($_SESSION['status']) && isset($_SESSION['pesan'])) :
	?>
		<div class="alert small alert-<?= $_SESSION['status']; ?> alert-dismissible fade show" role="alert">
		  <?= $_SESSION['pesan']; ?>
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php
		unset($_SESSION['status']);  
		unset($_SESSION['pesan']);  
		endif;
	?>

	<div class="ip">
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">Alamat IP</th>
		      <th scope="col">Slash</th>
		      <th scope="col">Opsi</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php  
		  		foreach ($data as $ip) :
		  	?>
			    <tr>
			      <td><?= $ip['alamat_ip']; ?></td>
			      <td><?= $ip['slash']; ?></td>
			      <td>
			      	<button type="button" 
			      	data-bs-toggle="modal" 
			      	data-bs-target="#hapusNet<?= $ip['id']; ?>" 
			      	class="btn btn-outline-secondary btn-sm">Hapus</button>

			      	<!-- Modal hapus -->
							<div class="modal fade" id="hapusNet<?= $ip['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" 
							aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus IP Network</h1>
							        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							      </div>
							      <div class="modal-body">
							      	Yakin ingin menghapusnya?
							      </div>
							      <div class="modal-footer">
								        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
								        <a href="proses/ip_network_proses.php?proses=hapus&id=<?= $ip['id']; ?>" class="btn btn-outline-secondary">Hapus</a>
								      </div>
							    </div>
							  </div>
							</div>

			      </td>
			    </tr>
			   <?php  
			   	endforeach;
			   ?>
		  </tbody>
		</table>
	</div>
	<br>
</div>