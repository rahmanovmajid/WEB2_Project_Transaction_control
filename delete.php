<?php
	
	require_once('connectDBalwaysdata.inc.php');


	$id = (int) $_GET['id'];


	// $stmt = mysqli_stmt_prepare($link,"DELETE FROM `transactions` WHERE id=?");
	// mysqli_stmt_bind_param($stmt,"i",$id);
	// mysqli_stmt_execute($stmt);

	$dQuery = " DELETE FROM `transactions` WHERE idTransaction=$id";

	mysqli_query($link,$dQuery);
	// echo "bu id pozuldu :" . $id ;

	if ( $link->query($dQuery) === TRUE ) {
        echo "Record Deleted Succesfully";
        header("Location: add.php"); 
    }
    else{
        echo "Error: " . $dQuery . "<br>" . $link->error;
    }

?>