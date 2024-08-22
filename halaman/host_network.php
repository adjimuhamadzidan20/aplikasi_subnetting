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

<div class="judul-host-network my-3">
	<h3>Host Jaringan</h3>	
</div>
<div class="input-host-network mb-4">
	<div class="row mb-2">
		<div class="col-12 col-lg-4">
			<div class="mb-2">
				<input type="text" class="form-control mb-2 text-muted" 
				value="<?php $check = $jumlahData == 0 ? 'IP Network belum tersedia' : $dataIp['alamat_ip']; echo $check; ?>" 
				style="cursor: pointer; font-style: italic;" readonly>
			</div>
			<div class="mb-2">
				<input type="text" class="form-control mb-2 text-muted" 
				value="<?php $check = $jumlahData == 0 ? 'Slash Network belum tersedia' : $dataIp['slash']; echo $check; ?>"
				style="cursor: pointer; font-style: italic;" readonly>
			</div>
		</div>
	</div>
  <div class="row">
  	<div class="col d-block d-sm-flex justify-content-sm-between">
  		<button type="button" class="btn btn-outline-success mb-2 mb-sm-0 tambah-host" data-bs-toggle="modal" 
  		data-bs-target="#tambahHost">Tambah Host Jaringan</button>

  		<!-- button proses setelah mengklik button check -->
  		<div class="tombol-generate">
	      <button class="btn btn-success mx-auto generate-load" type="button" id="button-cek" style="display: none;">
	        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
	        Generate
	      </button>
	  		<button type="button" class="btn btn-outline-success generate" id="generate">Generate</button>
  		</div>
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

<div class="tabel-host-network table-responsive">
	<table class="table" id="tabel_host">
	  <thead>
	    <tr>
	      <th scope="col" nowrap="nowrap">No</th>
	      <th scope="col" nowrap="nowrap">Bagian/Divisi</th>
	      <th scope="col" nowrap="nowrap">Jumlah Host</th>
	      <th scope="col" nowrap="nowrap">Opsi</th>
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
		      <td nowrap="nowrap">
		      	<button type="button" class="btn btn-outline-success btn-sm" 
		      	data-bs-toggle="modal" 
		      	data-bs-target="#editHost"
		      	data-id="<?= $host['id']; ?>" 
		      	data-divisi="<?= $host['nama_divisi']; ?>" 
		      	data-host="<?= $host['jumlah_host']; ?>">Edit</button>

		      	<button type="button" 
		      	data-bs-toggle="modal" 
		      	data-bs-target="#hapusHost<?= $host['id']; ?>" 
		      	class="btn btn-outline-success btn-sm">Hapus</button>

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
							        <a href="proses/host_network_proses.php?proses=hapus&id=<?= $host['id']; ?>" class="btn btn-outline-success">Hapus</a>
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
	        <button type="submit" class="btn btn-outline-success">Edit</button>
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
	        <button type="submit" class="btn btn-outline-success">Simpan</button>
	      </div>
      </form>
    </div>
  </div>
</div>