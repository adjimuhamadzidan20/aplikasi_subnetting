<div class="cetak-hasil mb-3 d-flex justify-content-end">
	<div class="opsi">
		<a href="proses/cetak_hasil_pdf.php?proses=hasil_semua" class="btn btn-outline-success btn-sm">Cetak PDF</a>
		<a href="proses/cetak_hasil_excel.php?proses=hasil_semua" class="btn btn-outline-success btn-sm">Cetak Excel</a>
	</div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Divisi</th>
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
	      <td><?= $data['nama_divisi']; ?></td>
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