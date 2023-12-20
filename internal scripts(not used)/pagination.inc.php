<?php			
	
	require "connectDBalwaysdata.inc.php";

    // Connect to DB.Here i didn't include with inc.php connection file because there were problems.
    $link = mysqli_connect('mysql-faxmishok.alwaysdata.net','faxmishok','EtoFaxmin5005');
    mysqli_select_db($link, 'faxmishok_webproject');


    // define how many results you want per page
    $results_per_page = 10;


    // find out the number of results stored in database
    $query='SELECT * FROM `transactions`';  //just for finding  noResults.Not for data fetching.
    $result = mysqli_query($link, $query);
    $number_of_results = mysqli_num_rows($result);

    // determine number of total pages available
    $number_of_pages = ceil($number_of_results/$results_per_page);


    // determine which page number visitor is currently on
    if (!isset($_GET['page'])) {
      $page = 1;
    } else {
      $page = $_GET['page'];
    }


    // determine the sql LIMIT starting number for the results on the displaying page
    $this_page_first_result = ($page-1)*$results_per_page;


    // retrieve selected results from database and display them on page
    $query='SELECT * FROM `transactions` LIMIT ' . $this_page_first_result . ',' .  $results_per_page;

    //pagination part starts here

	if ( $page > 1 ){
	  echo "<a class='prev' href='table.php?page=" .($page-1)."' >Prev</a>";
	}

	for ($i = 1 ; $i <= $number_of_pages ; $i++ ) {

	  if ( $i == $page )  echo '<a class="active">'  . $i . '</a>';
	  else                echo '<a href="table.php?page=' . $i . '">' . $i . '</a> ';
	  
	}

	if ( $i > $page ){
	  echo "<a class='next' href='table.php?page=" .($page+1)."' >Next</a>";
	}


?>