<?php

	ini_set('display_errors',1);

	$host="mysql-faxmishok.alwaysdata.net";
	$user="faxmishok";
	$passwd="";
	$bd="faxmishok_webproject";

	$link = mysqli_connect($host,$user,$passwd,$bd);


	if( mysqli_connect_errno() ){
	    echo "Error code".mysqli_connect_errno() . ", Msg " . 
	        mysqli_connect_error();
	    exit();
	    
	}

	mysqli_set_charset($link,"utf8");


?>
