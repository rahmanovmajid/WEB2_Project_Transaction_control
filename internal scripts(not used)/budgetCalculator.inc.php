<?php

    include "connectDBalwaysdata.inc.php";
    
    $sum_income = 0;
    $sql_income = " 

       SELECT `transactionAmount` FROM `transactions`,`categories` WHERE `categories`.`idAccounting`= 1 AND `transactions`.idCategory = `categories`.idCategory;


    ";

    $result_sql_income = mysqli_query($link,$sql_income);
    while ( $row = mysqli_fetch_assoc($result_sql_income)){
        $sum_income += $row['transactionAmount'];
    }

    
    $sum_expense = 0;
    $sql_expense = " 

       SELECT `transactionAmount` FROM `transactions`,`categories` WHERE `categories`.`idAccounting`= 2 AND `transactions`.idCategory = `categories`.idCategory;


    ";

    $result_sql_expense = mysqli_query($link,$sql_expense);
    while ( $row = mysqli_fetch_assoc($result_sql_expense)){
        $sum_expense += $row['transactionAmount'];
    }

    $sum_expense = $sum_expense * (-1);

    $totalBudget = $sum_income + $sum_expense;

    $perc_expense = abs(floor(($sum_expense/$sum_income)*100)) . '%';


?>