<?php  
	if (@$_GET['hasil'] == 'semua') {
		$active1 ='active bg-info text-white';
		$active2 ='';
		$active3 ='';
		$active4 ='';
	} 
	else if (@$_GET['hasil'] == 'net_id') {
		$active1 ='';
		$active2 ='active bg-info text-white';
		$active3 ='';
		$active4 ='';
	}
	else if (@$_GET['hasil'] == 'range_id') {
		$active1 ='';
		$active2 ='';
		$active3 ='active bg-info text-white';
		$active4 ='';
	}
	else if (@$_GET['hasil'] == 'broad_id') {
		$active1 ='';
		$active2 ='';
		$active3 ='';
		$active4 ='active bg-info text-white';
	} 
	else {
		$active1 ='active bg-info text-white';
		$active2 ='';
		$active3 ='';
		$active4 ='';
		$active5 ='';
	}
?>