<?php

    require "connectDBalwaysdata.inc.php";

    $query_income=" 

    SELECT `idTransaction` ,`transactionAmount`,`transactionDescription` from `transactions`,`categories` WHERE `categories`.`idAccounting`= 1 AND `transactions`.idCategory = `categories`.idCategory ORDER BY `transactions`.`idTransaction` DESC LIMIT 5;
    ";


    $result_income=mysqli_query($link,$query_income);  

    while( $row = mysqli_fetch_assoc($result_income)){
    
        $description_income = $row['transactionDescription'];
        $amount_income = $row['transactionAmount'];

    }                 

?>    