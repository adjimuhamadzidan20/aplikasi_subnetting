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
			padding: 50px 23px 35px 23px;
			margin-top: 6rem;
			margin-bottom: 6rem;
			border: 1px solid lightgrey;
			border-radius: 8px;
		}
	</style>
</head>
<body>
	
	<nav class="navbar navbar-dark navbar-expand-lg bg-success">
	  <div class="container">
	    <a class="navbar-brand text-white" style="font-weight: bold;">Hitung Subnetting</a>
	  </div>
	</nav>

	<main>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col col-md-8 col-lg-5 col-xl-4">
					<div class="login-form">
						<div class="judul-login-form text-center mb-4">
							<h5 class="text-uppercase">Login</h5>
							<p class="text-muted">Masuk sebagai pengguna</p>
						</div>

						<?php  
							if (isset($_SESSION['status']) && isset($_SESSION['pesan'])) :
						?>
							<div class="alert small alert-<?= $_SESSION['status']; ?> alert-dismissible fade show" role="alert" id="notif">
							  <?= $_SESSION['pesan']; ?>
							</div>
						<?php
							unset($_SESSION['status']);  
							unset($_SESSION['pesan']);  
							endif;
						?>
						
						<form action="proses/login_sistem.php?proses=login" method="post">
							<div class="mb-2">
							  <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
							</div>
							<div class="mb-4">
							  <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
							</div>
							<button type="submit" class="btn btn-outline-success w-100" data-bs-dismiss="alert" aria-label="Close">Masuk</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="jquery/jquery-3.7.1.js"></script>

	<script type="text/javascript">
    let popup = document.getElementById('notif');
    if (popup.style.display = 'block') {
      setTimeout(function() {
        popup.style.opacity = '0'
        popup.style.transition = 'opacity 1s ease-in-out';
        setTimeout(function() {
            popup.style.display = 'none';
        }, 1000)
      }, 1000);
    }
  </script>

</body>
</html>