<?php // content="text/plain; charset=utf-8"
	require_once ('connectDBalwaysdata.inc.php');
	require_once ('jpgraph/jpgraph.php');
	require_once ('jpgraph/jpgraph_bar.php');


	$categories = [];
	$num_of_used = array_fill(0,15,0);

	$query = "SELECT * FROM `transactions`;";
	$result = mysqli_query($link,$query);


	while ( $row = mysqli_fetch_assoc($result) ){
		$IdCategory = $row['idCategory'];
	  	$num_of_used[ $IdCategory-1 ]++;
	}


	$query2 = "SELECT * FROM `categories`;";
	$result2 = mysqli_query($link,$query2);

	while ( $row2 = mysqli_fetch_assoc($result2) ){
		array_push($categories,$row2['category']);
	}



	$graph = new Graph(1200,300,'auto');
	$graph->SetScale("textlin",0,5);

	$theme_class = new UniversalTheme;
	$graph->SetTheme($theme_class);

	$graph->yaxis->SetTickPositions(array(1,2,3,4,5),array(0.5,1.5,2.5,3.5,4.5));
	$graph->SetBox(false);


	$graph->ygrid->SetFill(false);
	$graph->xaxis->SetTickLabels($categories);
	$graph->yaxis->HideLine(false);
	$graph->yaxis->HideTicks(false,false);


	$b1plot = new BarPlot($num_of_used);


	$graph->Add($b1plot);


	$b1plot->SetWidth(30);
	$graph->title->Set("Number of Transactions Used Per Category");


	$graph->Stroke();

?>