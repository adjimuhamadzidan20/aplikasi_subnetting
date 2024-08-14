<?php  
	require 'proses/koneksi_database.php';

	// data hasil
	$queryHasil = "SELECT tb_hasil.id, tb_host.jumlah_host, tb_hasil.network, tb_hasil.ip_awal, 
	tb_hasil.ip_akhir, tb_hasil.broadcast, tb_hasil.prefix, tb_hasil.subnetmask FROM tb_hasil INNER JOIN tb_host 
	ON tb_hasil.id_host = tb_host.id";
	$returnHasil = mysqli_query($conn, $queryHasil);
	$jumlahData = mysqli_num_rows($returnHasil);

	// data net
	$queryNetID = "SELECT tb_hasil.id, tb_host.nama_divisi, tb_hasil.network, tb_hasil.prefix 
	FROM tb_hasil INNER JOIN tb_host ON tb_hasil.id_host = tb_host.id";
	$returnNetID = mysqli_query($conn, $queryNetID);

	// data range
	$queryRangeID = "SELECT tb_hasil.id, tb_host.nama_divisi, tb_hasil.ip_awal, 
	tb_hasil.ip_akhir, tb_hasil.prefix FROM tb_hasil INNER JOIN tb_host ON tb_hasil.id_host = tb_host.id";
	$returnRangeID = mysqli_query($conn, $queryRangeID);

	// data broadcast
	$queryBroadID = "SELECT tb_hasil.id, tb_host.nama_divisi, tb_hasil.broadcast, 
	tb_hasil.prefix FROM tb_hasil INNER JOIN tb_host ON tb_hasil.id_host = tb_host.id";
	$returnBroadID = mysqli_query($conn, $queryBroadID);

?>

<div class="container">
	<?php  
		if ($jumlahData == 0) {
	?>
		<div class="row">
			<div class="col">
				<div class="judul-hasil-perhitungan mt-4">
					<h5>Hasil perhitungan belum tersedia..</h5>	
				</div>
			</div>
		</div>
	<?php  
		} else {
	?>
		<div class="row">
			<div class="col">
				<div class="judul-hasil-perhitungan mt-3 mb-2 d-flex justify-content-between">
					<h3>Hasil Perhitungan</h3>
					<div>
						<button type="button" 
		      	data-bs-toggle="modal" 
		      	data-bs-target="#resetHasil" 
		      	class="btn btn-outline-secondary btn-sm">Reset Hasil</button>	
					</div>
				</div>
				<div class="hasil">
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">No</th>
					      <th scope="col">Host</th>
					      <th scope="col">Network</th>
					      <th scope="col">IP Awal</th>
					      <th scope="col">IP Akhir</th>
					      <th scope="col">Broadcast</th>
					      <th scope="col">Prefix</th>
					      <th scope="col">Subnetmask</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php  
					  		$no = 0;
					  		while ($data = mysqli_fetch_assoc($returnHasil)) : 
					  		$no++;
					  	?>
						    <tr>
						      <td><?= $no; ?></td>
						      <td><?= $data['jumlah_host']; ?></td>
						      <td><?= $data['network']; ?></td>
						      <td><?= $data['ip_awal']; ?></td>
						      <td><?= $data['ip_akhir']; ?></td>
						      <td><?= $data['broadcast']; ?></td>
						      <td><?= '/'. $data['prefix']; ?></td>
						      <td><?= $data['subnetmask']; ?></td>
						    </tr>
						  <?php  
						  	endwhile;
						  ?>
					  </tbody>
					</table>
				</div>
			</div>	
		</div>
		
		<div class="row">
			<div class="col">
				<div class="judul-netID mt-3">
					<h4>Net ID</h4>	
				</div>
				<div class="net-ID">
					<table class="table">
					  <tbody>
					  	<?php  
					  		$no = 0;
					  		while ($data = mysqli_fetch_assoc($returnNetID)) : 
					  		$no++;
					  	?>
						    <tr>
						      <td><?= $no; ?></td>
						      <td><?= $data['nama_divisi']; ?></td>
						      <td><?= $data['network']; ?></td>
						      <td><?= '/'. $data['prefix']; ?></td>
						    </tr>
						  <?php  
						  	endwhile;
						  ?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<div class="judul-rangeID mt-3">
					<h4>Range ID</h4>	
				</div>
				<div class="range-ID">
					<table class="table">
					  <tbody>
					  	<?php  
					  		$no = 0;
					  		while ($data = mysqli_fetch_assoc($returnRangeID)) : 
					  		$no++;
					  	?>
						    <tr>
						    	<td><?= $no; ?></td>
						      <td><?= $data['nama_divisi']; ?></td>
						      <td><?= $data['ip_awal']; ?></td>
						      <td><?= $data['ip_akhir']; ?></td>
						      <td><?= '/'. $data['prefix']; ?></td>
						    </tr>
						  <?php  
						  	endwhile;
						  ?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<div class="judul-broadcastID mt-3">
					<h4>Broadcast ID</h4>	
				</div>
				<div class="broadcast-ID">
					<table class="table">
					  <tbody>
					  	<?php  
					  		$no = 0;
					  		while ($data = mysqli_fetch_assoc($returnBroadID)) : 
					  		$no++;
					  	?>
						    <tr>
						    	<td><?= $no; ?></td>
						      <td><?= $data['nama_divisi']; ?></td>
						      <td><?= $data['broadcast']; ?></td>
						      <td><?= '/'. $data['prefix']; ?></td>
						    </tr>
						  <?php  
						  	endwhile;
						  ?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	<?php  
		} 
	?>
	
	<br><br><br><br>
</div>

	<!-- Modal reset hasil -->
	<div class="modal fade" id="resetHasil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">Reset hasil perhitungan</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	Yakin ingin meresetnya? semua hasil perhitungan akan terhapus semua
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
	        <a href="proses/host_network_proses.php?proses=reset_hasil" class="btn btn-outline-secondary">Reset Hasil</a>
	      </div>
	    </div>
	  </div>
	</div>