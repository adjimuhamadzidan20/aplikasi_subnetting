<?php  
	session_start();

	if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<title>Hitung Subnetting</title>
	<style>
		.login-form {
			width: 30%;
			padding: 50px 25px 35px 25px;
			margin-top: 6rem;
			border: 1px solid lightgrey;
			border-radius: 8px;
		}
	</style>
</head>
<body>
	
	<?php 
		include 'section/header.php'; 
	?>

	<main>
		<div class="container d-flex justify-content-center">
			<div class="login-form">
				<div class="judul-login-form text-center mb-4">
					<h5 class="text-uppercase">Login</h5>
					<p class="text-muted">Masuk sebagai pengguna</p>
				</div>

				<?php  
					if (isset($_SESSION['status']) && isset($_SESSION['pesan'])) :
				?>
					<div class="alert small alert-<?= $_SESSION['status']; ?> alert-dismissible fade show" role="alert">
					  <?= $_SESSION['pesan']; ?>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php
					unset($_SESSION['status']);  
					unset($_SESSION['pesan']);  
					endif;
				?>
				
				<form action="proses/login_sistem.php?proses=login" method="post">
					<div class="mb-3">
					  <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
					</div>
					<div class="mb-4">
					  <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
					</div>
					<button type="submit" class="btn btn-outline-info w-100" data-bs-dismiss="alert" aria-label="Close">Masuk</button>
				</form>
			</div>
		</div>
	</main>

	<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="jquery/jquery-3.7.1.js"></script>

</body>
</html>