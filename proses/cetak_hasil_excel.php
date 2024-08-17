<?php  
	require 'koneksi_database.php';

	// convert ke format excel
	header('Content-Type:application/vnd-ms-excel');

	// data hasil
	$queryHasil = "SELECT tb_hasil.id, tb_host.nama_divisi, tb_host.jumlah_host, tb_hasil.network, tb_hasil.ip_awal, 
	tb_hasil.ip_akhir, tb_hasil.broadcast, tb_hasil.prefix, tb_hasil.subnetmask FROM tb_hasil INNER JOIN tb_host 
	ON tb_hasil.id_host = tb_host.id";
	$returnHasil = mysqli_query($conn, $queryHasil);

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

	if (isset($_GET['proses'])) {
		if ($_GET['proses'] == 'hasil_semua') {
			header('Content-disposition:attachment; filename=Hasil_Perhitungan_Semua.xls');
			$table = '<span>Hitung Subnetting</span><br>
									<span>Semua Hasil Perhitungan</span><br><br>
									<table border="1">
									  <thead>
									    <tr>
									      <th>No</th>
									      <th>Nama Divisi</th>
									      <th>Host</th>
									      <th>Network</th>
									      <th>IP Awal</th>
									      <th>IP Akhir</th>
									      <th>Broadcast</th>
									      <th>Prefix</th>
									      <th>Subnetmask</th>
									    </tr>
									  </thead>
									  <tbody>';

							  		$no = 0;
							  		while ($data = mysqli_fetch_assoc($returnHasil)) : 
							  		$no++;
								  		$table .= ' <tr>
									      <td>'. $no .'</td>
									      <td>'. $data['nama_divisi'] .'</td>
									      <td>'. $data['jumlah_host'] .'</td>
									      <td>'. $data['network'] .'</td>
									      <td>'. $data['ip_awal'] .'</td>
									      <td>'. $data['ip_akhir'] .'</td>
									      <td>'. $data['broadcast'] .'</td>
									      <td>'. '/'. $data['prefix'] .'</td>
									      <td>'. $data['subnetmask'] .'</td>
									    </tr>';  
								  	endwhile;

									  $table .= '
										  </tbody>
										</table>';
			echo $table;
		}
		else if ($_GET['proses'] == 'hasil_net') {
			header('Content-disposition:attachment; filename=Hasil_Perhitungan_NetID.xls');
			$table = '<span>Hitung Subnetting</span><br>
									<span>NetID Hasil Perhitungan</span><br><br>
									<table border="1">
									  <thead>
									    <tr>
									      <th>No</th>
									      <th>Nama Divisi</th>
									      <th>Host</th>
									      <th>Network</th>
									      <th>Prefix</th>
									    </tr>
									  </thead>
									  <tbody>';

							  		$no = 0;
							  		while ($data = mysqli_fetch_assoc($returnNetID)) : 
							  		$no++;
								  		$table .= ' <tr>
									      <td>'. $no .'</td>
									      <td>'. $data['nama_divisi'] .'</td>
									      <td>'. $data['jumlah_host'] .'</td>
									      <td>'. $data['network'] .'</td>
									      <td>'. '/'. $data['prefix'] .'</td>
									    </tr>';  
								  	endwhile;

									  $table .= '
										  </tbody>
										</table>';
			echo $table;
		}
		else if ($_GET['proses'] == 'hasil_range') {
			header('Content-disposition:attachment; filename=Hasil_Perhitungan_RangeID.xls');
			$table = '<span>Hitung Subnetting</span><br>
									<span>RangeID Hasil Perhitungan</span><br><br>
									<table border="1">
									  <thead>
									    <tr>
									      <th>No</th>
									      <th>Nama Divisi</th>
									      <th>Host</th>
									      <th>IP Awal</th>
									      <th>IP Akhir</th>
									      <th>Prefix</th>
									    </tr>
									  </thead>
									  <tbody>';

							  		$no = 0;
							  		while ($data = mysqli_fetch_assoc($returnRangeID)) : 
							  		$no++;
								  		$table .= ' <tr>
									      <td>'. $no .'</td>
									      <td>'. $data['nama_divisi'] .'</td>
									      <td>'. $data['jumlah_host'] .'</td>
									      <td>'. $data['ip_awal'] .'</td>
									      <td>'. $data['ip_akhir'] .'</td>
									      <td>'. '/'. $data['prefix'] .'</td>
									    </tr>';  
								  	endwhile;

									  $table .= '
										  </tbody>
										</table>';
			echo $table;
		}
		else if ($_GET['proses'] == 'hasil_broad') {
			header('Content-disposition:attachment; filename=Hasil_Perhitungan_BroadcastID.xls');
			$table = '<span>Hitung Subnetting</span><br>
									<span>BroadcastID Hasil Perhitungan</span><br><br>
									<table border="1">
									  <thead>
									    <tr>
									      <th>No</th>
									      <th>Nama Divisi</th>
									      <th>Host</th>
									      <th>Broadcast</th>
									      <th>Prefix</th>
									    </tr>
									  </thead>
									  <tbody>';

							  		$no = 0;
							  		while ($data = mysqli_fetch_assoc($returnBroadID)) : 
							  		$no++;
								  		$table .= ' <tr>
									      <td>'. $no .'</td>
									      <td>'. $data['nama_divisi'] .'</td>
									      <td>'. $data['jumlah_host'] .'</td>
									      <td>'. $data['broadcast'] .'</td>
									      <td>'. '/'. $data['prefix'] .'</td>
									    </tr>';  
								  	endwhile;

									  $table .= '
										  </tbody>
										</table>';
			echo $table;
		}
	}
?>