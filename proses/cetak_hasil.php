<?php  
	require 'koneksi_database.php';
	require __DIR__ . '/../vendor/autoload.php';

	$queryHasil = "SELECT tb_hasil.id, tb_host.nama_divisi, tb_host.jumlah_host, tb_hasil.network, tb_hasil.ip_awal, 
	tb_hasil.ip_akhir, tb_hasil.broadcast, tb_hasil.prefix, tb_hasil.subnetmask FROM tb_hasil INNER JOIN tb_host 
	ON tb_hasil.id_host = tb_host.id";
	$returnHasil = mysqli_query($conn, $queryHasil);

	if (isset($_GET['proses'])) {
		if ($_GET['proses'] == 'cetak_pdf') {
			$mpdf = new \Mpdf\Mpdf();
			$header = '	<div style="border-bottom: 1px solid black;">
							<h1 style="font-size: 24px; font-family: arial;">Hitung Subnetting</h1>		
						</div>';

			$text = '<p style="font-family: arial;"><b>Data Hasil Perhitungan</b></p>';

			$date = '<p style="font-size: 14px; font-family: arial;">'. date("d F Y H:i:s") .'</p>';

			$table = '<table border="1" cellspacing="0" cellpadding="8" style="width: 100%; text-align: center; font-size: 15px; 
			font-family: arial;">
							<tr>
								<th scope="col">No</th>
					      <th scope="col" nowrap="nowrap">Nama Divisi</th>
					      <th scope="col" nowrap="nowrap">Host</th>
					      <th scope="col" nowrap="nowrap">Network</th>
					      <th scope="col" nowrap="nowrap">IP Awal</th>
					      <th scope="col" nowrap="nowrap">IP Akhir</th>
					      <th scope="col" nowrap="nowrap">Broadcast</th>
					      <th scope="col" nowrap="nowrap">Prefix</th>
					      <th scope="col" nowrap="nowrap">Subnetmask</th>
							</tr>';

							$no = 0;
							while($data = mysqli_fetch_assoc($returnHasil)) :
								$no++;
								$table .= '<tr>
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
						</table>';

			$mpdf->WriteHTML($header);
			$mpdf->WriteHTML($text);
			$mpdf->WriteHTML($date);
			$mpdf->WriteHTML($table);
			$mpdf->setFooter('Hasil Perhitungan | {PAGENO} | Hitung Subnetting');
			$mpdf->Output('Hasil_Perhitungan.pdf', \Mpdf\Output\Destination::DOWNLOAD);
		}
		else if ($_GET['proses'] == 'cetak_excel') {
			// convert ke format excel
			header('Content-Type:application/vnd-ms-excel');
			header('Content-disposition:attachment; filename=Hasil_Perhitungan.xls');

			$table = '<span>Hitung Subnetting</span><br>
									<span>Data Hasil Perhitungan</span><br><br>
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
	}
?>