<?php  
	require 'koneksi_database.php';
	require __DIR__ . '/../vendor/autoload.php';

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
			$mpdf = new \Mpdf\Mpdf();
			$header = '	<div style="border-bottom: 1px solid black;">
							<h1 style="font-size: 24px; font-family: arial;">Hitung Subnetting</h1>		
						</div>';
			$text = '<p style="font-family: arial;"><b>Semua Hasil Perhitungan</b></p>';
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
			$mpdf->setFooter('Hasil Perhitungan Semua | {PAGENO} | Hitung Subnetting');
			$mpdf->Output('Hasil_Perhitungan_Semua.pdf', \Mpdf\Output\Destination::DOWNLOAD);
		}
		else if ($_GET['proses'] == 'hasil_net') {
			$mpdf = new \Mpdf\Mpdf();
			$header = '	<div style="border-bottom: 1px solid black;">
							<h1 style="font-size: 24px; font-family: arial;">Hitung Subnetting</h1>		
						</div>';
			$text = '<p style="font-family: arial;"><b>NetID Hasil Perhitungan</b></p>';
			$date = '<p style="font-size: 14px; font-family: arial;">'. date("d F Y H:i:s") .'</p>';
			$table = '<table border="1" cellspacing="0" cellpadding="8" style="width: 100%; text-align: center; font-size: 15px; 
			font-family: arial;">
							<tr>
								<th scope="col">No</th>
					      <th scope="col" nowrap="nowrap">Nama Divisi</th>
					      <th scope="col" nowrap="nowrap">Host</th>
					      <th scope="col" nowrap="nowrap">Network</th>
					      <th scope="col" nowrap="nowrap">Prefix</th>
							</tr>';

							$no = 0;
							while($data = mysqli_fetch_assoc($returnNetID)) :
								$no++;
								$table .= '<tr>
												<td>'. $no .'</td>
									      <td>'. $data['nama_divisi'] .'</td>
									      <td>'. $data['jumlah_host'] .'</td>
									      <td>'. $data['network'] .'</td>
									      <td>'. '/'. $data['prefix'] .'</td>
											</tr>';
							endwhile;

						$table .= ' 
						</table>';

			$mpdf->WriteHTML($header);
			$mpdf->WriteHTML($text);
			$mpdf->WriteHTML($date);
			$mpdf->WriteHTML($table);
			$mpdf->setFooter('Hasil Perhitungan NetID | {PAGENO} | Hitung Subnetting');
			$mpdf->Output('Hasil_Perhitungan_NetID.pdf', \Mpdf\Output\Destination::DOWNLOAD);
		}
		else if ($_GET['proses'] == 'hasil_range') {
			$mpdf = new \Mpdf\Mpdf();
			$header = '	<div style="border-bottom: 1px solid black;">
							<h1 style="font-size: 24px; font-family: arial;">Hitung Subnetting</h1>		
						</div>';
			$text = '<p style="font-family: arial;"><b>RangeID Hasil Perhitungan</b></p>';
			$date = '<p style="font-size: 14px; font-family: arial;">'. date("d F Y H:i:s") .'</p>';
			$table = '<table border="1" cellspacing="0" cellpadding="8" style="width: 100%; text-align: center; font-size: 15px; 
			font-family: arial;">
							<tr>
								<th scope="col">No</th>
					      <th scope="col" nowrap="nowrap">Nama Divisi</th>
					      <th scope="col" nowrap="nowrap">Host</th>
					      <th scope="col" nowrap="nowrap">IP Awal</th>
					      <th scope="col" nowrap="nowrap">IP Akhir</th>
					      <th scope="col" nowrap="nowrap">Prefix</th>
							</tr>';

							$no = 0;
							while($data = mysqli_fetch_assoc($returnRangeID)) :
								$no++;
								$table .= '<tr>
												<td>'. $no .'</td>
									      <td>'. $data['nama_divisi'] .'</td>
									      <td>'. $data['jumlah_host'] .'</td>
									      <td>'. $data['ip_awal'] .'</td>
									      <td>'. $data['ip_akhir'] .'</td>
									      <td>'. '/'. $data['prefix'] .'</td>
											</tr>';
							endwhile;

						$table .= ' 
						</table>';

			$mpdf->WriteHTML($header);
			$mpdf->WriteHTML($text);
			$mpdf->WriteHTML($date);
			$mpdf->WriteHTML($table);
			$mpdf->setFooter('Hasil Perhitungan RangeID | {PAGENO} | Hitung Subnetting');
			$mpdf->Output('Hasil_Perhitungan_RangeID.pdf', \Mpdf\Output\Destination::DOWNLOAD);
		}
		else if ($_GET['proses'] == 'hasil_broad') {
			$mpdf = new \Mpdf\Mpdf();
			$header = '	<div style="border-bottom: 1px solid black;">
							<h1 style="font-size: 24px; font-family: arial;">Hitung Subnetting</h1>		
						</div>';
			$text = '<p style="font-family: arial;"><b>BroadcastID Hasil Perhitungan</b></p>';
			$date = '<p style="font-size: 14px; font-family: arial;">'. date("d F Y H:i:s") .'</p>';
			$table = '<table border="1" cellspacing="0" cellpadding="8" style="width: 100%; text-align: center; font-size: 15px; 
			font-family: arial;">
							<tr>
								<th scope="col">No</th>
					      <th scope="col" nowrap="nowrap">Nama Divisi</th>
					      <th scope="col" nowrap="nowrap">Host</th>
					      <th scope="col" nowrap="nowrap">Broadcast</th>
					      <th scope="col" nowrap="nowrap">Prefix</th>
							</tr>';

							$no = 0;
							while($data = mysqli_fetch_assoc($returnBroadID)) :
								$no++;
								$table .= '<tr>
												<td>'. $no .'</td>
									      <td>'. $data['nama_divisi'] .'</td>
									      <td>'. $data['jumlah_host'] .'</td>
									      <td>'. $data['broadcast'] .'</td>
									      <td>'. '/'. $data['prefix'] .'</td>
											</tr>';
							endwhile;

						$table .= ' 
						</table>';

			$mpdf->WriteHTML($header);
			$mpdf->WriteHTML($text);
			$mpdf->WriteHTML($date);
			$mpdf->WriteHTML($table);
			$mpdf->setFooter('Hasil Perhitungan BroadcastID | {PAGENO} | Hitung Subnetting');
			$mpdf->Output('Hasil_Perhitungan_BroadcastID.pdf', \Mpdf\Output\Destination::DOWNLOAD);
		}
	}
?>