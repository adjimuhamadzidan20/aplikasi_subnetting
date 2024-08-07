<?php  
	require 'koneksi_database.php';

	if (isset($_GET['proses'])) {
		if ($_GET['proses'] == 'tambah') {
			$bagianAlamat = $_POST['bagian'];
			$hostIp = $_POST['host'];

			$query = "INSERT INTO tb_host VALUES ('', '$bagianAlamat', '$hostIp')";
			$return = mysqli_query($conn, $query);

			header('Location: ../index.php?hal=host_network');
			exit;
		}
		else if ($_GET['proses'] == 'hapus') {
			$id = $_GET['id'];

			$query = "DELETE FROM tb_host WHERE id = '$id'";
			$return = mysqli_query($conn, $query);

			header('Location: ../index.php?hal=host_network');
			exit;
		}
		else if ($_GET['proses'] == 'edit') {

		} 
		else if ($_GET['proses'] == 'generate') {
			// range / rentang host
			// jika host >= 1 dan <= 4 = /29 -> 8
			// jika host >= 4 dan <= 12 = /28 -> 16
			// jika host >= 12 dan <= 28 = /27 -> 32
			// jika host >= 28 dan <= 58 = /26 -> 64
			// jika host >= 58 dan <= 128 = /25 -> 128

			// range slash
			$slash_25 = 128;
			$slash_26 = 64;
			$slash_27 = 32;
			$slash_28 = 16;
			$slash_29 = 8;
			$slash_30 = 4;
			$slash_31 = 2;
			$slash_32 = 1;

			// range prefix
			$prefix_25 = 25;
			$prefix_26 = 26;
			$prefix_27 = 27;
			$prefix_28 = 28;
			$prefix_29 = 29;
			$prefix_30 = 30;
			$prefix_31 = 31;
			$prefix_32 = 32;

			// data jumlah host
			$query = "SELECT jumlah_host FROM tb_host";
			$return = mysqli_query($conn, $query);
			$jumlahData = mysqli_num_rows($return);
			$data = [];
			while ($row = mysqli_fetch_assoc($return)) {
				$data[] = $row['jumlah_host'];
			}

			// data ip network
			$query2 = "SELECT alamat_ip FROM tb_network";
			$return2 = mysqli_query($conn, $query2);
			$dataIp = [];
			while ($ip = mysqli_fetch_assoc($return2)) {
				$dataIp[] = $ip['alamat_ip'];
			}

			// cek jumlah host 
			for ($i=0; $i < $jumlahData; $i++) { 
				if ($data[$i] >= 1 && $data[$i] <= 4) {
					$network = str_replace('.','', implode(" ", $dataIp));
					$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
					$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_29) - 2; 
					$broadcast = $ipAkhir + 1;
					$prefix = $prefix_29;

					// echo "ip ".  ." host $data[$i] menggunakan slash $slash_29 /<br>";
					echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
				} 
				else if ($data[$i] >= 4 && $data[$i] <= 12) {
					$network = str_replace('.','', implode(" ", $dataIp));
					$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
					$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_28) - 2; 
					$broadcast = $ipAkhir + 1;
					$prefix = $prefix_28;
					
					// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_28 /$prefix_28<br>";
					echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
				} 
				else if ($data[$i] >= 12 && $data[$i] <= 28) {
					$network = str_replace('.','', implode(" ", $dataIp));
					$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
					$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_27) - 2; 
					$broadcast = $ipAkhir + 1;
					$prefix = $prefix_27;
					
					// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_27 /$prefix_27<br>";
					echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
				}
				else if ($data[$i] >= 28 && $data[$i] <= 58) {
					$network = str_replace('.','', implode(" ", $dataIp));
					$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
					$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_26) - 2; 
					$broadcast = $ipAkhir + 1;
					$prefix = $prefix_26;
					
					// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_26 /$prefix_26<br>";
					echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
				}
				else if ($data[$i] >= 58 && $data[$i] <= 128) {
					$network = str_replace('.','', implode(" ", $dataIp));
					$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
					$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_25) - 2; 
					$broadcast = $ipAkhir + 1;
					$prefix = $prefix_25;
					
					// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_25 /$prefix_25<br>";
					echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
				}

				// $query = "INSERT INTO tb_hasil VALUES ('', '$data[$i]', '$network', '$ipAwal', '$ipAkhir', '$broadcast', '$prefix')";
				// $return = mysqli_query($conn, $query);
			}

			// data hasil perhitungan sementara
			$queryHasil = "SELECT network, ip_awal, ip_akhir, broadcast FROM tb_hasil";
			$ret = mysqli_query($conn, $queryHasil);
			$item = mysqli_num_rows($ret);
			$dataHasil = [];
			while ($hasil = mysqli_fetch_assoc($ret)) {
				$dataHasil[] = $hasil;
			}

			// ambil data ip broadcast
			$queryBroadcast = "SELECT broadcast FROM tb_hasil";
			$retCast = mysqli_query($conn, $queryBroadcast);
			$item = mysqli_num_rows($ret);
			$dataCast = [];
			while ($hasilCast = mysqli_fetch_assoc($retCast)) {
				$dataCast[] = substr($hasilCast['broadcast'], 8);
			}

			// urutan data dlm tabel
			$arrayItem = range(1, $item);
			// var_dump($dataHasil[0]);
			// var_dump($dataCast[0]);
			// var_dump($arrayItem[0]);

			// die();
			echo "<br>";

			for ($i=0; $i < $item; $i++) { 
				// jika urutan datanya ke 1 / pertama
				if ($arrayItem[$i] == 1) {
					if ($data[$i] >= 1 && $data[$i] <= 4) {
						$network = str_replace('.','', implode(" ", $dataIp));
						$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
						$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_29) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_29;

						// echo "ip ".  ." host $data[$i] menggunakan slash $slash_29 /<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
					} 
					else if ($data[$i] >= 4 && $data[$i] <= 12) {
						$network = str_replace('.','', implode(" ", $dataIp));
						$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
						$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_28) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_28;
						
						// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_28 /$prefix_28<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
					} 
					else if ($data[$i] >= 12 && $data[$i] <= 28) {
						$network = str_replace('.','', implode(" ", $dataIp));
						$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
						$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_27) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_27;
						
						// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_27 /$prefix_27<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix data pertama <br>";
					}
					else if ($data[$i] >= 28 && $data[$i] <= 58) {
						$network = str_replace('.','', implode(" ", $dataIp));
						$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
						$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_26) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_26;
						
						// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_26 /$prefix_26<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
					}
					else if ($data[$i] >= 58 && $data[$i] <= 128) {
						$network = str_replace('.','', implode(" ", $dataIp));
						$ipAwal = str_replace('.','', implode(" ", $dataIp)) + 1;
						$ipAkhir = (str_replace('.','', implode(" ", $dataIp)) + $slash_25) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_25;
						
						// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_25 /$prefix_25<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
					}
				}
				// selebihnya lebih dari urutan 1
				else if ($arrayItem[$i] > 1) {
					
					if ($data[$i] >= 1 && $data[$i] <= 4) {
						$network = str_replace('.','', implode(" ", $dataIp)) + $dataCast[3] + 1;
						$ipAwal = $network + 1;
						$ipAkhir = ($network + $slash_29) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_29;

						// echo "ip ".  ." host $data[$i] menggunakan slash $slash_29 /<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix ketiga <br>";
					} 
					else if ($data[$i] >= 4 && $data[$i] <= 12) {
						$network = str_replace('.','', implode(" ", $dataIp)) + $dataCast[0] + 1;
						$ipAwal = $network + 1;
						$ipAkhir = ($network + $slash_28) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_28;
						
						// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_28 /$prefix_28<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix kedua <br>";
					} 
					else if ($data[$i] >= 12 && $data[$i] <= 28) {
						$network = str_replace('.','', implode(" ", $dataIp)) + $dataCast[$i] + 1;
						$ipAwal = $network + 1;
						$ipAkhir = ($network + $slash_27) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_27;
						
						// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_27 /$prefix_27<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
					}
					else if ($data[$i] >= 28 && $data[$i] <= 58) {
						$network = str_replace('.','', implode(" ", $dataIp)) + $dataCast[$i] + 1;
						$ipAwal = $network + 1;
						$ipAkhir = ($network + $slash_26) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_26;		
						
						// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_26 /$prefix_26<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
					}
					else if ($data[$i] >= 58 && $data[$i] <= 128) {
						$network = str_replace('.','', implode(" ", $dataIp)) + $dataCast[$i] + 1;
						$ipAwal = $network + 1;
						$ipAkhir = ($network + $slash_25) - 2; 
						$broadcast = $ipAkhir + 1;
						$prefix = $prefix_25;
						
						// echo "ip ". str_replace('.','', implode(" ", $dataIp)) ." host $data[$i] menggunakan slash $slash_25 /$prefix_25<br>";
						echo "$network - $ipAwal - $ipAkhir - $broadcast - /$prefix <br>";
					}
				}

				// echo "<br>";
				// $dataBroad = [];
				// $dataBroad[] = $broadcast;

				// var_dump($dataBroad);
			}	

		} 
	}

?>