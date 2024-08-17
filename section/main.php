<?php  
	if (isset($_GET['hal'])) {
		if ($_GET['hal'] == 'ip_network') {
			include 'halaman/ip_network.php';
		} 
		else if ($_GET['hal'] == 'host_network') {
			include 'halaman/host_network.php';
		}
		else if ($_GET['hal'] == 'hasil') {
			include 'halaman/hasil_perhitungan.php';
		}
		else if ($_GET['hal'] == 'tentang') {
			include 'halaman/tentang.php';
		}
		else if ($_GET['hal'] == 'penggunaan') {
			include 'halaman/cara_penggunaan.php';
		}
	} 
	else {
		include 'halaman/ip_network.php';
	}
?>