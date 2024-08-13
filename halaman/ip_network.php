<?php  
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
		  <div class="mb-3">
		  	<div class="row">
		  		<div class="col-5">
		  			<input type="text" class="form-control" placeholder="Masukkan Alamat IP" name="alamat_ip" required>
		  		</div>
		  		<div class="col-2 px-0">
		  			<input type="text" class="form-control" placeholder="Masukkan Slash IP" name="slash_ip" required>
		  		</div>
		  	</div>
		  	<span class="text-secondary" style="font-size: 12px;"><i>*IP Network tidak bisa dimasukkan lebih dari 1</i></span>
		  </div>
		  <button type="submit" class="btn btn-primary">Simpan</button>
		</form>
	</div>
	<div class="ip">
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">No</th>
		      <th scope="col">Alamat IP</th>
		      <th scope="col">Slash</th>
		      <th scope="col">Opsi</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php  
		  		$no = 0;
		  		foreach ($data as $ip) :
		  		$no++;
		  	?>
			    <tr>
			      <td><?= $no; ?></td>
			      <td><?= $ip['alamat_ip']; ?></td>
			      <td><?= $ip['slash']; ?></td>
			      <td>
			      	<a href="proses/ip_network_proses.php?proses=hapus&id=<?= $ip['id']; ?>" class="btn btn-primary btn-sm">Hapus</a>
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