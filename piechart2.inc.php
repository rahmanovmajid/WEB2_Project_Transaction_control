<?php // content="text/plain; charset=utf-8"
	require_once ('jpgraph/jpgraph.php');
	require_once ('jpgraph/jpgraph_pie.php');
	require_once ('jpgraph/jpgraph_pie3d.php');
	require_once ('connectDBalwaysdata.inc.php');


	// $amounts = [];
	$amounts = array_fill(0,2,0);


	$query_income = "
		SELECT * FROM `transactions`,`categories` WHERE `transactions`.idCategory = `categories`.idCategory AND `categories`.idAccounting = 1;
	";

	$result_income = mysqli_query($link,$query_income);

	while ( $row_income = mysqli_fetch_assoc($result_income) ){
		$amounts[0] += $row_income['transactionAmount'];
	}

	$query_expense = "
		SELECT * FROM `transactions`,`categories` WHERE `transactions`.idCategory = `categories`.idCategory AND `categories`.idAccounting = 2;
	";

	$result_expense = mysqli_query($link,$query_expense);

	while ( $row_expense = mysqli_fetch_assoc($result_expense) ){
		$amounts[1] += $row_expense['transactionAmount'];
	}



	$graph = new PieGraph(350,250);


	$theme_class = new VividTheme;
	$graph->SetTheme($theme_class);


	$graph->title->Set("Accounting Percentage");


	$p1 = new PiePlot3D($amounts);
	$graph->Add($p1);

	$p1->ShowBorder();
	$p1->SetColor('black');
	$p1->ExplodeSlice(1);
	//$graph->Stroke();


	// Create an instance of the Text class and set the string at the same time
	$txt0 = new Text('Income');
	$txt1 = new Text('Expenses');


	// Position the string at absolute pixels (0,20).
	$txt0->SetPos(175,80);
	$txt1->SetPos(120,150);
	
	// Set color and font for the text
	$txt0->SetColor('white');
	$txt1->SetColor('white');

	$txt0->SetFont(FF_FONT2,FS_NORMAL);
	$txt1->SetFont(FF_FONT2,FS_NORMAL);
	
	// ... and add the text to the graph
	$graph->AddText($txt0);
	$graph->AddText($txt1);

	$graph->Stroke();

?>