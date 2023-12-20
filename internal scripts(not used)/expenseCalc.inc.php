<?php		

		require "connectDBalwaysdata.inc.php";

		$query_expense = " 

        SELECT `idTransaction` ,`transactionAmount`,`transactionDescription` from `transactions`,`categories` WHERE `categories`.`idAccounting`= 2 AND `transactions`.idCategory = `categories`.idCategory ORDER BY `transactions`.`idTransaction` DESC LIMIT 5;
        ";


        $result_expense=mysqli_query($link,$query_expense);

        while($row=mysqli_fetch_assoc($result_expense)){
        
            $description_expense = $row['transactionDescription'];
            $amount_expense = $row['transactionAmount'];

        }


?>