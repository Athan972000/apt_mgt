
<!DOCTYPE HTML>
<html>
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Highcharts Example</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
canvas{
        width: 100% !important;
        max-width: 800px;
        height: auto !important;
    }
</style>
</head>
<body>

	
	<script src="<?php echo base_url().'resources/js/Chart.js'?>"></script>
	<div class="row-fluid">
        <div class="graph span6">
            <h3 class="title"> The Chart</h3>
            <canvas id="myChart" width="500" height="400"></canvas>
        </div>
		<button id="total">Total</button>
        <button id="text">Text</button>
		<button id="word">Word</button>
		<button id="defi">Definition</button>
	</div>


</body>
	
	<script type="text/javascript">
var text_result = JSON.parse('<?php echo json_encode($Nvoca['text_result']); ?>');
var dateArray = new Array();
var lengthArray= new Array();
var ctx = $("#myChart").get(0).getContext("2d");
var vocadbchart;
//Total
$('#total').click(function(){
	dateArray = Object.keys(text_result.total);
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result.total[dateArray[i]] );
	}
	var data = {
		labels: dateArray,
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: lengthArray
			},
		]
	};
	// vocadbchart.removeData();
	if(typeof(vocadbchart) != 'undefined')
		vocadbchart.destroy();
	vocadbchart = new Chart(ctx).Line(data);
});
	
//Text
$('#text').click(function(){
	dateArray = Object.keys(text_result.text);
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result.text[dateArray[i]] );
	}
	var data = {
		labels: dateArray,
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: lengthArray
			},
		]
	};
	// new Chart(ctx).Line(data);
	vocadbchart.destroy();
	vocadbchart = new Chart(ctx).Line(data);
});

//Word
$('#word').click(function(){
	dateArray = Object.keys(text_result.word);
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result.word[dateArray[i]] );
	}
	var data = {
		labels: dateArray,
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: lengthArray
			},
		]
	};
	vocadbchart.destroy();
	vocadbchart = new Chart(ctx).Line(data);
});

//Word
$('#defi').click(function(){
	dateArray = Object.keys(text_result.defi);
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result.defi[dateArray[i]] );
	}
	var data = {
		labels: dateArray,
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: lengthArray
			},
		]
	};
	vocadbchart.destroy();
	vocadbchart = new Chart(ctx).Line(data);
});

$( "#total" ).trigger( "click" );
</script>
</html>
