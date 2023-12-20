<!DOCTYPE html>
<html lang="en">

<head>
<!-- for responsiveness-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  FOR DATATABLE  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="shortcut icon" href="budget.png"/>
    <meta charset="UTF-8">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Playfair+Display+SC:900&display=swap" rel="stylesheet">    
    <link rel="stylesheet" type="text/css" href="table.css">
    <title>Database - Your Transaction Controller</title>
</head>
    

<body>

    <h1>TABLE OF
        <span id="transactions">
            &nbspTRANSACTIONS
        </span>
    </h1>



    <table id="datatable" class="content-table">  
      <thead>
        <tr>
            <th>Transaction ID</th> 
            <th>Transaction Description</th>
            <th>Transaction Amount</th> 
            <th>Transaction Category</th> 
            <th>Payment Method</th>
            <th>Transaction Date</th>
        </tr>
      </thead>

      <tbody>
        <?php
          require_once ('showtable.inc.php');
        ?>
      </tbody>  

    </table>

    <div class="pagination">
          <?php

              // include "pagination.inc.php";
            // firstly this php script i wrote meant to work as pagination but then i discovered some magic called datatable..hope this one will work
              
          ?>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );    
    </script>
    
</body>
</html>