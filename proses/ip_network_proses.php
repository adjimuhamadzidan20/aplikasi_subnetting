<?php
	session_start();  
	require 'koneksi_database.php';

	if (isset($_GET['proses'])) {
		if ($_GET['proses'] == 'tambah') {
			$queryNet = "SELECT * FROM tb_network";
			$returnNet = mysqli_query($conn, $queryNet);
			$jumlah = mysqli_num_rows($returnNet);

			if ($jumlah == 1) {
				$_SESSION['status'] = 'warning';
				$_SESSION['pesan'] = 'IP Network hanya boleh terdapat 1 data!';
				header('Location: ../index.php?hal=ip_network');
				exit;
			} 
			else {
				$alamatIp = htmlspecialchars($_POST['alamat_ip']);
				$slashIp = htmlspecialchars($_POST['slash_ip']);

				$query = "INSERT INTO tb_network VALUES ('', '$alamatIp', '$slashIp')";
				$return = mysqli_query($conn, $query);

				if ($return) {
					$_SESSION['status'] = 'success';
					$_SESSION['pesan'] = 'IP Network berhasil ditambahkan!';

					header('Location: ../index.php?hal=ip_network');
					exit;
				} 
				else {
					$_SESSION['status'] = 'danger';
					$_SESSION['pesan'] = 'IP Network gagal ditambahkan!';

					header('Location: ../index.php?hal=ip_network');
					exit;
				}
			}
		} 
		else if ($_GET['proses'] == 'hapus') {
			$id = $_GET['id'];

			$query = "DELETE FROM tb_network WHERE id = '$id'";
			$return = mysqli_query($conn, $query);

			if ($return) {
				$_SESSION['status'] = 'success';
				$_SESSION['pesan'] = 'IP Network berhasil terhapus!';

				header('Location: ../index.php?hal=ip_network');
				exit;
			} 
			else {
				$_SESSION['status'] = 'danger';
				$_SESSION['pesan'] = 'IP Network gagal terhapus!';

				header('Location: ../index.php?hal=ip_network');
				exit;
			}	
		}
	}

?>