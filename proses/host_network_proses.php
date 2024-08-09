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
			$id = $_GET['id'];

			$query = "DELETE FROM tb_host WHERE id = '$id'";
			$return = mysqli_query($conn, $query);

			header('Location: ../index.php?hal=host_network');
			exit;
		} 
		else if ($_GET['proses'] == 'generate') {
			// range / rentang host
			// jika host >= 1 dan <= 4 = /29 -> 8
			// jika host >= 4 dan <= 12 = /28 -> 16
			// jika host >= 12 dan <= 28 = /27 -> 32
			// jika host >= 28 dan <= 58 = /26 -> 64
			// jika host >= 58 dan <= 128 = /25 -> 128

			// data jumlah host
			$queryHost = "SELECT jumlah_host FROM tb_host";
			$returnHost = mysqli_query($conn, $queryHost);
			// $jumlahData = mysqli_num_rows($returnHost);
			$dataHost = [];
			while ($row = mysqli_fetch_assoc($returnHost)) {
				$dataHost[] = $row['jumlah_host'];
			}

			// data ip network
			$queryIp = "SELECT alamat_ip FROM tb_network";
			$returnIp = mysqli_query($conn, $queryIp);
			$dataIp = [];
			while ($ip = mysqli_fetch_assoc($returnIp)) {
				$dataIp[] = $ip['alamat_ip'];
			}

			// range prefix
			$prefix_25 = 25;
			$prefix_26 = 26;
			$prefix_27 = 27;
			$prefix_28 = 28;
			$prefix_29 = 29;
			$prefix_30 = 30;
			$prefix_31 = 31;
			$prefix_32 = 32;

	    // Sort hosts by descending order
	    rsort($dataHost);

	    // Convert network address to binary
	    $networkBinary = ip2long($dataIp[0]);

	    // Loop through each required subnet
	    foreach ($dataHost as $host) {
        // Calculate the number of bits needed for hosts
        $bits = ceil(log($host + 2, 2));

        // prefix berdasarkan jumlah host
        if ($host >= 1 && $host <= 4) {
					$prefix = $prefix_29;
				} 
				else if ($host >= 4 && $host <= 12) {
					$prefix = $prefix_28;
				} 
				else if ($host >= 12 && $host <= 28) {
					$prefix = $prefix_27;
				}
				else if ($host >= 28 && $host <= 58) {
					$prefix = $prefix_26;
				}
				else if ($host >= 58 && $host <= 128) {
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
        		'host' => $host,
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
	    	$hostItem = $hasil['host'];
        $networkIp = $hasil['network'];
        $ipAwal = $hasil['ip_awal'];
        $ipAkhir = $hasil['ip_akhir'];
        $ipBroad = $hasil['broadcast'];
        $pref = $hasil['prefix'];
        $subnet = $hasil['subnet_mask'];

	    	$query = "INSERT INTO tb_hasil VALUES ('', '$hostItem', '$networkIp', '$ipAwal', '$ipAkhir', '$ipBroad', 
	    	'$pref', '$subnet')";
				$return = mysqli_query($conn, $query);
	    }

	    header('Location: ../index.php?hal=hasil');
			exit;
		} 
	}

?>