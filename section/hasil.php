<?php  
	if (isset($_GET['hasil'])) {
		if ($_GET['hasil'] == 'semua') {
			include 'hasil/semua.php';
		} 
		else if ($_GET['hasil'] == 'net_id') {
			include 'hasil/net_id.php';
		}
		else if ($_GET['hasil'] == 'range_id') {
			include 'hasil/range_id.php';
		}
		else if ($_GET['hasil'] == 'broad_id') {
			include 'hasil/broadcast_id.php';
		}
	} 
	else {
		include 'hasil/semua.php';
	}
?>