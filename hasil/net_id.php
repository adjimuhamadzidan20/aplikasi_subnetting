<div class="cetak-hasil mb-3 d-sm-flex justify-content-sm-end">
	<div class="opsi">
		<a href="proses/cetak_hasil_pdf.php?proses=hasil_net" class="btn btn-outline-success btn-sm cetak-pdf">Cetak PDF</a>
		<a href="proses/cetak_hasil_excel.php?proses=hasil_net" class="btn btn-outline-success btn-sm cetak-excel">Cetak Excel</a>
	</div>
</div>
<div class="table-responsive">
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col" nowrap="nowrap">No</th>
	      <th scope="col" nowrap="nowrap">Nama Divisi</th>
	      <th scope="col" nowrap="nowrap">Host</th>
	      <th scope="col" nowrap="nowrap">Network</th>
	      <th scope="col" nowrap="nowrap">Prefix</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php  
	  		$no = 0;
	  		while ($data = mysqli_fetch_assoc($returnNetID)) : 
	  		$no++;
	  	?>
		    <tr>
		      <td><?= $no; ?></td>
		      <td><?= $data['nama_divisi']; ?></td>
		      <td><?= $data['jumlah_host']; ?></td>
		      <td><?= $data['network']; ?></td>
		      <td><?= '/'. $data['prefix']; ?></td>
		    </tr>
		  <?php  
		  	endwhile;
		  ?>
	  </tbody>
	</table>
</div>
