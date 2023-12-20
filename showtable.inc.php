<?php 

    require_once('connectDBalwaysdata.inc.php');

    $query = " SELECT * FROM `accounting`, `transactions`, `categories`, `payments` 
        WHERE `transactions`.idCategory = `categories`.idCategory 
        AND `transactions`.idPayment = `payments`.idPayment 
        AND `accounting`.idAccounting = `categories`.idAccounting 
        ORDER BY `transactions`.idTransaction ASC ";

    $result = $link->query($query);

    while ( $row = $result->fetch_assoc()){
      extract($row);

      $transactionAmount = $row['transactionAmount'];

      $coef = $row['multiplierCoefficient'];

      if ( $coef == -1 ){
        $transactionAmount = $coef * $transactionAmount;
      }

      echo "<tr>";
          echo "<td>".$row['idTransaction']."</td>";
          echo "<td>".$row['transactionDescription']."</td>";
          echo "<td>".$transactionAmount."</td>";
          echo "<td>".$row['category']."</td>";
          echo "<td>".$row['paymentMethod']."</td>";
          echo "<td>".$row['transactionDate']."</td>";
      echo "</tr>";

    }


?>