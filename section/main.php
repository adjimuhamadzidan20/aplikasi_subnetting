<?php  
	if (isset($_GET['hal'])) {
		if ($_GET['hal'] == 'ip_network') {
			include 'halaman/ip_network.php';
		} 
		else if ($_GET['hal'] == 'host_network') {
			include 'halaman/host_network.php';
		}
		else if ($_GET['hal'] == 'hasil') {
			include 'halaman/hasil.php';
		}
	} 
	else {
		include 'halaman/ip_network.php';
	}

?>