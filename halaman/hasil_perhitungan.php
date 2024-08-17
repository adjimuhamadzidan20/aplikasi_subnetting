<?php  
	require 'proses/koneksi_database.php';

	// data hasil
	$queryHasil = "SELECT tb_hasil.id, tb_host.nama_divisi, tb_host.jumlah_host, tb_hasil.network, tb_hasil.ip_awal, 
	tb_hasil.ip_akhir, tb_hasil.broadcast, tb_hasil.prefix, tb_hasil.subnetmask FROM tb_hasil INNER JOIN tb_host 
	ON tb_hasil.id_host = tb_host.id";
	$returnHasil = mysqli_query($conn, $queryHasil);
	$jumlahData = mysqli_num_rows($returnHasil);

	// data net
	$queryNetID = "SELECT tb_hasil.id, tb_host.nama_divisi, tb_host.jumlah_host, tb_hasil.network, tb_hasil.prefix FROM tb_hasil 
	INNER JOIN tb_host ON tb_hasil.id_host = tb_host.id";
	$returnNetID = mysqli_query($conn, $queryNetID);

	// data range
	$queryRangeID = "SELECT tb_hasil.id, tb_host.nama_divisi, tb_host.jumlah_host, tb_hasil.ip_awal, 
	tb_hasil.ip_akhir, tb_hasil.prefix FROM tb_hasil INNER JOIN tb_host ON tb_hasil.id_host = tb_host.id";
	$returnRangeID = mysqli_query($conn, $queryRangeID);

	// data broadcast
	$queryBroadID = "SELECT tb_hasil.id, tb_host.nama_divisi, tb_host.jumlah_host, tb_hasil.broadcast, 
	tb_hasil.prefix FROM tb_hasil INNER JOIN tb_host ON tb_hasil.id_host = tb_host.id";
	$returnBroadID = mysqli_query($conn, $queryBroadID);
?>

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
			<div class="judul-hasil-perhitungan mt-3 mb-3 d-flex justify-content-between">
				<h3>Hasil Perhitungan</h3>
				<div class="reset-hasil">	
	      	<button type="button" 
	      	data-bs-toggle="modal" 
	      	data-bs-target="#resetHasil" 
	      	class="btn btn-outline-info btn-sm">Reset Hasil</button>
				</div>
			</div>

			<?php include 'section/active_hasil.php'; ?>
			
			<div class="pilihan-hasil mb-3">
				<ul class="nav nav-pills nav-justified rounded border">
				  <li class="nav-item">
				    <a class="nav-link text-dark <?= $active1; ?>" aria-current="page" href="index.php?hal=hasil&hasil=semua">Semua</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link text-dark <?= $active2; ?>" href="index.php?hal=hasil&hasil=net_id">NetID</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link text-dark <?= $active3; ?>" href="index.php?hal=hasil&hasil=range_id">RangeID</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link text-dark <?= $active4; ?>" href="index.php?hal=hasil&hasil=broad_id">BroadcastID</a>
				  </li>
				</ul>
			</div>
			<div class="hasil">
				<?php include 'section/hasil.php'; ?>
			</div>
		</div>	
	</div>
<?php  
	} 
?>

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
        <a href="proses/host_network_proses.php?proses=reset_hasil" class="btn btn-outline-info">Reset Hasil</a>
      </div>
    </div>
  </div>
</div>