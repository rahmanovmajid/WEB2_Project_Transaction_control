<?php

 require_once('connectDBalwaysdata.inc.php'); 

 if ( isset($_POST['submit']) ){


    $date = date('Y-m-d', strtotime($_POST['date']));

    $query = "

    INSERT INTO transactions (`transactionDate`,`idPayment`,`idCategory`,`transactionDescription`,`transactionAmount`)
    VALUES (\"".$date."\", \"".$_POST['payment']."\" , \"".$_POST['category']."\" , \"".$_POST['description']."\" ,\"".$_POST['amount']."\")

    ";


    if ( $link->query($query) === TRUE ) {
        echo "New record created successfully";
        header("Location: add.php"); 
    }else{
        echo "Error: " . $query . "<br>" . $link->error;
    }

    // $link->close();


 }
    

?>