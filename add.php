<?php
    
    require_once('connectDBalwaysdata.inc.php');


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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Baskervville&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600" rel="stylesheet" type="text/css">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="add.css">
    <link rel="shortcut icon" href="budget.png"/>
    <title>Add Transaction - Your Transaction Controller</title>
</head>
    

<body>
    
<!--************ Top Section *************-->

    <div class="top">
        <div class="budget">

            <div class="budget__title">
                Available Budget in <span class="budget__title--month"><?php

                    echo date('F Y', mktime(0, 0, 0, date('m'), 1, date('Y')));

                ?></span>:
            </div>

            <div class="budget__value"> <?php echo $totalBudget; ?></div>
            <div class="budget__income clearfix">
                <div class="budget__income--text">Income</div>
                <div class="right">
                    <div class="budget__income--value"> <?php echo $sum_income; ?> </div>

                </div>
            </div>

            <div class="budget__expenses clearfix">
                <div class="budget__expenses--text">Expenses</div>
                <div class="right clearfix">
                    <div class="budget__expenses--value"> <?php echo $sum_expense; ?> </div>
                    <div class="budget__expenses--percentage"> <?php echo $perc_expense; ?> </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom">
        <div class="add">

            <div class="add__container">

                <form method="post" action="transaction.php">
                    
                    <label for="date">Date: </label>
                    <input type="date" name="date" value="<?php showToday();?>">

                    <select id="add__type__payment" name="payment">
                        <option value="1" selected>Cash</option>
                        <option value="2">Check</option>
                        <option value="3">Bank Card</option>
                        <option value="4">Bank Transfer</option>
                    </select>

                    <select id="add__type__category" name="category">

                        
                      <option value="1">Transportation</option>
                      <option value="2">Entertainment</option>
                      <option value="3">Rent</option>
                      <option value="4">Phone</option>
                      <option value="5">Food</option>
                      <option value="6">Restaurant</option>
                      <option value="7">Cinema</option>
                      <option value="8">Theatre</option>
                      <option value="9">Gas</option>
                      <option value="10">Postage</option>
                      <option value="11">Travel</option>
                      <option value="12">Leisure</option>
                      <option value="13">Salary</option>
                      <option value="14">Scholarship</option>
                      <option value="15">Pocket Money</option>

                </select>         
                    <input name="description" type="text" class="add__description" placeholder="Add description">
                     
                        <input value="amount" name="amount" type="number" step="0.01" class="add__value" placeholder="Amount">
                    <button type="submit" name="submit" class="add__btn"><i class="ion-ios-checkmark-outline"></i></button>


                </form>

                
            </div>
        </div>


        <div class="container clearfix">
            <div class="heading2">
                <h2>LISTING RECENTLY ADDED TRANSACTIONS</h2>
                <br>
            </div>
            <div class="income">
                <h2 class="icome__title">Income</h2>

                <div class="income__list">
 
                    <ul>
                        <?php

                            $query_income=" 

                            SELECT `idTransaction` ,`transactionAmount`,`transactionDescription` from `transactions`,`categories` WHERE `categories`.`idAccounting`= 1 AND `transactions`.idCategory = `categories`.idCategory ORDER BY `transactions`.`idTransaction` DESC LIMIT 5;
                            ";


                            $result_income=mysqli_query($link,$query_income);  
                            while( $row = mysqli_fetch_assoc($result_income )){
                                $description_income = $row['transactionDescription'];
                                $amount_income = $row['transactionAmount'];?>

                                <div class="item clearfix" id="expense-0">
                                    <div class="item__description">
                                        <?php echo "{$description_income}"; ?>
                                    </div>
                                    <div class="right clearfix">
                                        <div class="item__value">
                                            <?php echo "{$amount_income}"; ?>
                                        </div>

                                        <div class="item__delete">
                                                <a class="item__delete--btn"
                                                href="delete.php?id=<?php echo $row['idTransaction'];?>";>
                                                    <i class="ion-ios-close-outline"></i>
                                                </a>
                                        </div>

                                    </div>
                                </div>




                        <?php 
                        }  
                    ?>          

                    </ul>

                </div>
            </div>



            <div class="expenses">
                <h2 class="expenses__title">Expenses</h2>

                <div class="expenses__list">


                    <ul>
                        <?php

                            $query_expense=" 

                            SELECT `idTransaction` ,`transactionAmount`,`transactionDescription` from `transactions`,`categories` WHERE `categories`.`idAccounting`= 2 AND `transactions`.idCategory = `categories`.idCategory ORDER BY `transactions`.`idTransaction` DESC LIMIT 5;
                            ";


                            $result_expense=mysqli_query($link,$query_expense);  
                            while($row=mysqli_fetch_assoc($result_expense)){
                                $description_expense = $row['transactionDescription'];
                                $amount_expense = $row['transactionAmount']; ?>

                            
                                 <div class="item clearfix" id="expense-0">
                                    <div class="item__description">
                                        <?php echo "{$description_expense}"; ?>
                                    </div>
                                    <div class="right clearfix">
                                        <div class="item__value">
                                            <?php echo "{$amount_expense}"; ?>
                                        </div>

                                        <div class="item__delete">
                                                <a class="item__delete--btn" 
                                                    href="delete.php?id=<?php echo $row['idTransaction'];?>">
                                                    <i class="ion-ios-close-outline"></i>
                                                </a>
                                        </div>

                                    </div>
                                </div>

                        <?php }  ?>         

                    </ul>


                </div>
            </div>

        </div>

            <div class="button_cont" align="center">
                <a class="example_a" href="table.php" rel="nofollow noopener">
                    Go to Full Table
                </a>
            </div>
            <br>
    </div>
</div>

</body>

</html>

<?php 
 function showToday(){
        date_default_timezone_set('Asia/Baku');
        $date = date('Y-m-d', time());
        echo "$date";
    }
?>