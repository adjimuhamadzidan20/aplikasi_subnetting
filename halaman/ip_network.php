<?php  
	require 'proses/koneksi_database.php';

	$query = "SELECT * FROM tb_network";
	$return = mysqli_query($conn, $query);

	$data = [];
	while ($row = mysqli_fetch_assoc($return)) {
		$data[] = $row;
	}
?>

<div class="judul-ip-network my-3">
	<h3>IP Jaringan</h3>	
</div>
<div class="tambah-ip-network mb-3">
	<div class="row">
		<div class="col">
			<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambahIP">
			Tambah IP Jaringan</button>
		</div>
	</div>
</div>

<?php  
	if (isset($_SESSION['status']) && isset($_SESSION['pesan'])) :
?>
	<div class="alert small alert-<?= $_SESSION['status']; ?> alert-dismissible fade show" role="alert" id="notif">
	  <?= $_SESSION['pesan']; ?>
	</div>
<?php
	unset($_SESSION['status']);  
	unset($_SESSION['pesan']);  
	endif;
?>

<span class="text-secondary" style="font-size: 12px;"><i>*Note : IP Network tidak bisa dimasukkan lebih dari 1 data</i></span>
<div class="tabel-ip-network">
	<table class="table table-responsive">
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
		      	class="btn btn-outline-success btn-sm">Hapus</button>

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
							        <a href="proses/ip_network_proses.php?proses=hapus&id=<?= $ip['id']; ?>" class="btn btn-outline-success">
							        Hapus</a>
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

<!-- Modal tambah -->
<div class="modal fade" id="tambahIP" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah IP Jaringan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/ip_network_proses.php?proses=tambah" method="post">
      	<div class="modal-body">
	      	<div class="mb-3">
	      		<label for="alamat_ip" class="form-label">Alamat IP</label>
				  	<input type="text" class="form-control" placeholder="Masukkan Alamat IP" name="alamat_ip" id="alamat_ip" required>
				  </div>
				  <div class="mb-3">
				  	<label for="slash_ip" class="form-label">Slash IP</label>
				  	<input type="text" class="form-control" placeholder="Masukkan Slash IP" name="slash_ip" id="slash_ip" required>
				  </div>
      	</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
	        <button type="submit" class="btn btn-outline-success">Simpan</button>
	      </div>
      </form>
    </div>
  </div>
</div>