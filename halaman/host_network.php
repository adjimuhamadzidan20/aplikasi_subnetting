<?php  
	require 'proses/koneksi_database.php';

	$alamatIp = "SELECT alamat_ip, slash FROM tb_network";
	$returnAlamat = mysqli_query($conn, $alamatIp);
	$dataIp = mysqli_fetch_assoc($returnAlamat);
	$jumlahData = mysqli_num_rows($returnAlamat);

	$host = "SELECT * FROM tb_host";
	$returnHost = mysqli_query($conn, $host);

	$dataHost = [];
	while ($row = mysqli_fetch_assoc($returnHost)) {
		$dataHost[] = $row;
	}

?>

<div class="judul my-3">
	<h3>Host Jaringan</h3>	
</div>
<div class="input-ip mb-4">
	<div class="row mb-3">
		<div class="col-5">
			<div class="mb-2">
				<label class="form-label">Alamat IP</label>
				<input type="text" class="form-control mb-2 text-muted" 
				value="<?php $check = $jumlahData == 0 ? 'IP Network belum tersedia' : $dataIp['alamat_ip']; echo $check; ?>" 
				style="cursor: pointer; font-style: italic;" readonly>
			</div>
			<div class="mb-2">
				<label class="form-label">Slash IP</label>
				<input type="text" class="form-control mb-2 text-muted" 
				value="<?php $check = $jumlahData == 0 ? 'Slash Network belum tersedia' : $dataIp['slash']; echo $check; ?>"
				style="cursor: pointer; font-style: italic;" readonly>
			</div>
		</div>
	</div>
  <div class="row">
  	<div class="col d-flex justify-content-between">
  		<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#tambahHost">
  		Tambah Host Jaringan</button>
  		<a href="proses/host_network_proses.php?proses=generate" class="btn btn-outline-info">Generate</a>
  	</div>
  </div>
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
	      <th scope="col">No</th>
	      <th scope="col">Bagian/Divisi</th>
	      <th scope="col">Jumlah Host</th>
	      <th scope="col">Opsi</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php  
	  		$no = 0;
	  		foreach ($dataHost as $host) :
	  		$no++;
	  	?>
		    <tr>
		      <td><?= $no; ?></td>
		      <td><?= $host['nama_divisi']; ?></td>
		      <td><?= $host['jumlah_host']; ?></td>
		      <td>
		      	<button type="button" class="btn btn-outline-info btn-sm" 
		      	data-bs-toggle="modal" 
		      	data-bs-target="#editHost"
		      	data-id="<?= $host['id']; ?>" 
		      	data-divisi="<?= $host['nama_divisi']; ?>" 
		      	data-host="<?= $host['jumlah_host']; ?>">Edit</button>

		      	<button type="button" 
		      	data-bs-toggle="modal" 
		      	data-bs-target="#hapusHost<?= $host['id']; ?>" 
		      	class="btn btn-outline-info btn-sm">Hapus</button>

		      	<!-- Modal hapus -->
						<div class="modal fade" id="hapusHost<?= $host['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Host Network</h1>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <div class="modal-body">
						      	Yakin ingin menghapusnya?
						      </div>
						      <div class="modal-footer">
							        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
							        <a href="proses/host_network_proses.php?proses=hapus&id=<?= $host['id']; ?>" class="btn btn-outline-info">Hapus</a>
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

<!-- Modal edit -->
<div class="modal fade" id="editHost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Host Jaringan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/host_network_proses.php?proses=edit" method="post">
      	<input type="text" class="form-control" name="id" id="id" hidden>
	      <div class="modal-body">
				  <div class="mb-3">
				  	<label for="bagian" class="form-label">Nama Divisi</label>
				  	<input type="text" class="form-control" placeholder="Nama Bagian atau Divisi" name="bagian" id="bagian" required>
				  </div>	
			  	<div class="mb-3">
			  		<label for="host" class="form-label">Jumlah Host</label>
			  		<input type="text" class="form-control" placeholder="Jumlah Host" name="host" id="host" required>
				  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
	        <button type="submit" class="btn btn-outline-info">Edit</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal tambah -->
<div class="modal fade" id="tambahHost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Host Jaringan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/host_network_proses.php?proses=tambah" method="post">
	      <div class="modal-body">
				  <div class="mb-3">
				  	<label for="divisi" class="form-label">Nama Divisi</label>
				  	<input type="text" class="form-control" placeholder="Nama Bagian atau Divisi" name="bagian" id="divisi" required>
				  </div>	
			  	<div class="mb-3">
			  		<label for="jml_host" class="form-label">Jumlah Host</label>
			  		<input type="text" class="form-control" placeholder="Jumlah Host" name="host" id="jml_host" required>
				  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
	        <button type="submit" class="btn btn-outline-info">Simpan</button>
	      </div>
      </form>
    </div>
  </div>
</div>