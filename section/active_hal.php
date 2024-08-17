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