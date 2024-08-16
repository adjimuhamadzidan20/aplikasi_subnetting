<?php  
	session_start();
	require 'koneksi_database.php';

	// data hasil
	$queryHasil = "SELECT * FROM tb_hasil";
	$returnHasil = mysqli_query($conn, $queryHasil);
	$jumlahData = mysqli_num_rows($returnHasil);

	if (isset($_GET['proses'])) {
		if ($_GET['proses'] == 'tambah') {
			$bagianAlamat = htmlspecialchars($_POST['bagian']);
			$hostIp = htmlspecialchars($_POST['host']);

			$query = "INSERT INTO tb_host VALUES ('', '$bagianAlamat', '$hostIp')";
			$return = mysqli_query($conn, $query);

			if ($return) {
				$_SESSION['status'] = 'success';
				$_SESSION['pesan'] = 'Host Network berhasil ditambahkan!';

				header('Location: ../index.php?hal=host_network');
				exit;
			}
			else {
				$_SESSION['status'] = 'danger';
				$_SESSION['pesan'] = 'Host Network gagal ditambahkan!';

				header('Location: ../index.php?hal=host_network');
				exit;
			}
		}
		else if ($_GET['proses'] == 'hapus') {
			$id = $_GET['id'];

			$query = "DELETE FROM tb_host WHERE id = '$id'";
			$return = mysqli_query($conn, $query);

			if ($return) {
				$_SESSION['status'] = 'success';
				$_SESSION['pesan'] = 'Host Network berhasil terhapus!';

				header('Location: ../index.php?hal=host_network');
				exit;
			}
			else {
				$_SESSION['status'] = 'danger';
				$_SESSION['pesan'] = 'Host Network gagal terhapus!';

				header('Location: ../index.php?hal=host_network');
				exit;
			}
		}
		else if ($_GET['proses'] == 'edit') {
			$id = $_POST['id'];
			$bagianAlamat = htmlspecialchars($_POST['bagian']);
			$hostIp = htmlspecialchars($_POST['host']);

			$query = "UPDATE tb_host SET nama_divisi = '$bagianAlamat', jumlah_host = '$hostIp' WHERE id = '$id'";
			$return = mysqli_query($conn, $query);

			if ($return) {
				$_SESSION['status'] = 'success';
				$_SESSION['pesan'] = 'Host Network berhasil terubah!';

				header('Location: ../index.php?hal=host_network');
				exit;
			} 
			else {
				$_SESSION['status'] = 'danger';
				$_SESSION['pesan'] = 'Host Network gagal terubah!';

				header('Location: ../index.php?hal=host_network');
				exit;
			}
		} 
		else if ($_GET['proses'] == 'generate') {
			if ($jumlahData > 0) {
				$_SESSION['status'] = 'info';
				$_SESSION['pesan'] = 'Data host network telah di generate!';

				header('Location: ../index.php?hal=host_network');
				exit;
			} 
			else {
				// range / rentang host
				// jika host >= 1 dan <= 4 = /29 -> 8
				// jika host >= 4 dan <= 12 = /28 -> 16
				// jika host >= 12 dan <= 28 = /27 -> 32
				// jika host >= 28 dan <= 58 = /26 -> 64
				// jika host >= 58 dan <= 128 = /25 -> 128

				// menggunakan rumus VLSM
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
				$queryHost = "SELECT id, jumlah_host FROM tb_host";
				$returnHost = mysqli_query($conn, $queryHost);
				$dataHost = [];
				while ($row = mysqli_fetch_assoc($returnHost)) {
					$dataHost[] = $row;
				}

				// data ip network
				$queryIp = "SELECT alamat_ip FROM tb_network";
				$returnIp = mysqli_query($conn, $queryIp);
				$dataIp = [];
				while ($ip = mysqli_fetch_assoc($returnIp)) {
					$dataIp[] = $ip['alamat_ip'];
				}

		    // Sort hosts by descending order
		    rsort($dataHost['jumlah_host']);

		    // Convert network address to binary
		    $networkBinary = ip2long($dataIp[0]);

		    // Loop through each required subnet
		    foreach ($dataHost as $host) {
	        // Calculate the number of bits needed for hosts
	        $bits = ceil(log($host['jumlah_host'] + 2, 2));

	        // prefix berdasarkan jumlah host
	        if ($host['jumlah_host'] >= 1 && $host['jumlah_host'] <= 4) {
						$prefix = $prefix_29;
					} 
					else if ($host['jumlah_host'] >= 4 && $host['jumlah_host'] <= 12) {
						$prefix = $prefix_28;
					} 
					else if ($host['jumlah_host'] >= 12 && $host['jumlah_host'] <= 28) {
						$prefix = $prefix_27;
					}
					else if ($host['jumlah_host'] >= 28 && $host['jumlah_host'] <= 58) {
						$prefix = $prefix_26;
					}
					else if ($host['jumlah_host'] >= 58 && $host['jumlah_host'] <= 128) {
						$prefix = $prefix_25;
					}
	        
	        // Calculate subnet mask
	        $subnetMask = 32 - $bits;
	        $blockSize = pow(2, $bits);

	        // Calculate broadcast address and next network address
	        $broadcastBinary = $networkBinary + $blockSize - 1;
	        $nextNetworkBinary = $broadcastBinary + 1;

	        // Store the subnet information
	        $subnets[] = [
	      		'id' => $host['id'],
	          'network' => long2ip($networkBinary),
	          'ip_awal' => long2ip($networkBinary + 1),
	          'ip_akhir' => long2ip($broadcastBinary - 1),
	          'broadcast' => long2ip($broadcastBinary),
	          'prefix' => $prefix,
	          'subnet_mask' => long2ip(-1 << (32 - $subnetMask)),
	        ];

	        // Update network for next subnet
	        $networkBinary = $nextNetworkBinary;
		    }

		    // hasil perhitungan masuk ke database
		    foreach ($subnets as $hasil) {
		    	$hostID = $hasil['id'];
	        $networkIp = $hasil['network'];
	        $ipAwal = $hasil['ip_awal'];
	        $ipAkhir = $hasil['ip_akhir'];
	        $ipBroad = $hasil['broadcast'];
	        $pref = $hasil['prefix'];
	        $subnet = $hasil['subnet_mask'];

		    	$query = "INSERT INTO tb_hasil VALUES ('', '$hostID', '$networkIp', '$ipAwal', '$ipAkhir', '$ipBroad', 
		    	'$pref', '$subnet')";
					$return = mysqli_query($conn, $query);
		    }

		    header('Location: ../index.php?hal=hasil');
				exit;
			}
		} 
		else if ($_GET['proses'] == 'reset_hasil') {
			$query = "TRUNCATE TABLE tb_hasil";
			mysqli_query($conn, $query);

			header('Location: ../index.php?hal=host_network');
			exit;
		}
	}

?>