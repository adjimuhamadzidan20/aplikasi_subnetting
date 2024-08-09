<?php  
	require 'koneksi_database.php';

	if (isset($_GET['proses'])) {
		if ($_GET['proses'] == 'tambah') {
			$alamatIp = htmlspecialchars($_POST['alamat_ip']);
			$slashIp = htmlspecialchars($_POST['slash_ip']);

			$query = "INSERT INTO tb_network VALUES ('', '$alamatIp', '$slashIp')";
			$return = mysqli_query($conn, $query);

			header('Location: ../index.php?hal=ip_network');
			exit;
		} 
		else if ($_GET['proses'] == 'hapus') {
			$id = $_GET['id'];

			$query = "DELETE FROM tb_network WHERE id = '$id'";
			$return = mysqli_query($conn, $query);

			header('Location: ../index.php?hal=ip_network');
			exit;
		}
	}

?>