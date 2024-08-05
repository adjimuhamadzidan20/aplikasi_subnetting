<?php  
	require 'proses/koneksi_database.php';

	$alamatIp = "SELECT alamat_ip, slash FROM tb_network";
	$returnAlamat = mysqli_query($conn, $alamatIp);
	$dataIp = mysqli_fetch_assoc($returnAlamat);

	$host = "SELECT * FROM tb_host";
	$returnHost = mysqli_query($conn, $host);

	$dataHost = [];
	while ($row = mysqli_fetch_assoc($returnHost)) {
		$dataHost[] = $row;
	}

?>

<div class="container">
	<div class="judul my-3">
		<h3>Host Network</h3>	
	</div>
	<div class="input-ip mb-4">
		<div class="row">
			<div class="col-5">
				<input type="text" class="form-control mb-2" value="<?= $dataIp['alamat_ip']; ?>" readonly>
			</div>
			<div class="col-1 px-0">
				<input type="text" class="form-control mb-2" value="<?= $dataIp['slash']; ?>" readonly>
			</div>
		</div>
		
		<form action="proses/host_network_proses.php?proses=tambah" method="post">
		  <div class="mb-3">
		    <input type="text" class="form-control mb-2" placeholder="Nama Bagian atau Divisi" name="bagian" required>
		    <input type="text" class="form-control" placeholder="Jumlah Host" name="host" required>
		  </div>
		  <div class="d-flex justify-content-between">
		  	<button type="submit" class="btn btn-primary">Simpan</button>
		  	<a href="proses/host_network_proses.php?proses=generate" class="btn btn-primary">Generate</a>
		  </div>
		</form>
	</div>
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
			      	<a href="proses/host_network_proses.php?proses=edit&id=<?= $host['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
			      	<a href="proses/host_network_proses.php?proses=hapus&id=<?= $host['id']; ?>" class="btn btn-primary btn-sm">Hapus</a>
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