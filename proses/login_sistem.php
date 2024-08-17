<?php  
	session_start();  
	require 'koneksi_database.php';

	if (isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit;
  }

	if (isset($_GET['proses'])) {
		if ($_GET['proses'] == 'login') {
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);

			$query = "SELECT * FROM tb_user WHERE username = '$username'";
			$return = mysqli_query($conn, $query);
			$data = mysqli_fetch_assoc($return);

			if ($username == $data['username']) {
				if (md5($password, TRUE)) {
					$_SESSION['nama_user'] = $data['nama_user'];
        	$_SESSION['login'] = true;

					header('Location: ../index.php');
        	exit;
				}
			}
			else {
				$_SESSION['status'] = 'danger';
				$_SESSION['pesan'] = 'Username atau password tidak valid!';

				header('Location: ../login.php');
        exit;
			}
		}
	}
?>