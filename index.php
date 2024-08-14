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
		<?php include 'section/main.php'; ?>
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