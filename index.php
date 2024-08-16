<?php  
	if (@$_GET['hal'] == 'ip_network') {
		$active1 ='active';
		$active2 ='';
		$active3 ='';
		$active4 ='';
		$active5 ='';
	} 
	else if (@$_GET['hal'] == 'host_network') {
		$active1 ='';
		$active2 ='active';
		$active3 ='';
		$active4 ='';
		$active5 ='';
	}
	else if (@$_GET['hal'] == 'hasil') {
		$active1 ='';
		$active2 ='';
		$active3 ='active';
		$active4 ='';
		$active5 ='';
	}
	else if (@$_GET['hal'] == 'tentang' && @$_GET['link'] == 'dropdown') {
		$active1 ='';
		$active2 ='';
		$active3 ='';
		$active4 ='active';
		$active5 ='';
		$active6 ='active';
	} 
	else if (@$_GET['hal'] == 'penggunaan' && @$_GET['link'] == 'dropdown') {
		$active1 ='';
		$active2 ='';
		$active3 ='';
		$active4 ='';
		$active5 ='active';
		$active6 ='active';
	} 
	else {
		$active1 ='active';
		$active2 ='';
		$active3 ='';
		$active4 ='';
		$active5 ='';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<title>Hitung Subnetting</title>
</head>
<body>
	
	<?php include 'section/header.php'; ?>

	<main>
		<div class="container">
			<ul class="nav nav-tabs mt-3">
			  <li class="nav-item">
			    <a style="color: black;" class="nav-link <?= $active1; ?>" aria-current="page" href="index.php?hal=ip_network">IP Network</a>
			  </li>
			  <li class="nav-item">
			    <a style="color: black;" class="nav-link <?= $active2; ?>" aria-current="page" href="index.php?hal=host_network">Host Network</a>
			  </li>
			  <li class="nav-item">
			    <a style="color: black;" class="nav-link <?= $active3; ?>" aria-current="page" href="index.php?hal=hasil">Hasil Perhitungan</a>
			  </li>
			  <li class="nav-item dropdown">
			    <a style="color: black;" class="nav-link dropdown-toggle <?= $active6; ?>" data-bs-toggle="dropdown" role="button" aria-expanded="false">Lainnya</a>
			    <ul class="dropdown-menu">
			      <li>
			      	<a class="dropdown-item <?= $active4; ?>" href="index.php?hal=tentang&link=dropdown">Tentang</a>
			      <li>
			      	 <a class="dropdown-item <?= $active5; ?>" href="index.php?hal=penggunaan&link=dropdown">Cara Penggunaan</a>
			      </li>
			    </ul>
			  </li>
			</ul>

			<?php include 'section/main.php'; ?>
		
		</div>
	</main>

	<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="jquery/jquery-3.7.1.js"></script>

	<script type="text/javascript">
		$('#editHost').on('show.bs.modal', function (event) {
	    let button = $(event.relatedTarget)

	    let id = button.data('id') 
	    let bagian = button.data('divisi')
	    let host = button.data('host')
	    let modal = $(this)

	    modal.find('#id').val(id)
	    modal.find('#bagian').val(bagian)
	    modal.find('#host').val(host)
	  })

	</script>

</body>
</html>