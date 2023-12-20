<?php // content="text/plain; charset=utf-8"
	require_once ('jpgraph/jpgraph.php');
	require_once ('jpgraph/jpgraph_pie.php');
	require_once ('jpgraph/jpgraph_pie3d.php');
	require_once ('connectDBalwaysdata.inc.php');


	$payments = [];
	$num_of_used = array_fill(0,4,0);


	$query = "SELECT * FROM `transactions`;";
	$result = mysqli_query($link,$query);

	while ( $row = mysqli_fetch_assoc($result) ){
		$IdPayment = $row['idPayment'];
		$num_of_used[ $IdPayment-1 ]++;
	}

	$query2 = "SELECT * FROM `payments`;";
	$result2 = mysqli_query($link,$query2);

	while ( $row2 = mysqli_fetch_assoc($result2) ){
		array_push($payments,$row2['paymentMethod']);
	}


	$data = $num_of_used;


	$graph = new PieGraph(350,250);


	$theme_class = new VividTheme;
	$graph->SetTheme($theme_class);


	$graph->title->Set("Payment Method Percentage");


	$p1 = new PiePlot3D($data);
	$graph->Add($p1);

	$p1->ShowBorder();
	$p1->SetColor('black');
	$p1->ExplodeSlice(1);


	// Create an instance of the Text class and set the string at the same time
	$txt0 = new Text($payments[0]);
	$txt1 = new Text($payments[1]);
	$txt2 = new Text($payments[2]);
	$txt3 = new Text($payments[3]);



	// Position the string at absolute pixels (0,20).
	$txt0->SetPos(150,90);
	$txt1->SetPos(110,170);
	$txt2->SetPos(180,160);
	$txt3->SetPos(195,125);
	
	// Set color and fonr for the text
	$txt0->SetColor('white');
	$txt1->SetColor('white');
	$txt2->SetColor('black');
	$txt3->SetColor('black');

	$txt0->SetFont(FF_FONT2,FS_NORMAL);
	$txt1->SetFont(FF_FONT2,FS_NORMAL);
	$txt2->SetFont(FF_FONT2,FS_NORMAL);
	$txt3->SetFont(FF_FONT2,FS_NORMAL);
	
	// ... and add the text to the graph
	$graph->AddText($txt0);
	$graph->AddText($txt1);
	$graph->AddText($txt2);
	$graph->AddText($txt3);

	$graph->Stroke();

?>