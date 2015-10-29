<script src="<?php echo base_url().'resources/js/Chart.js'?>"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
canvas{
        width: 100% !important;
		max-width: 800px;
		height: 400px;
		max-height: 600px;
        height: auto !important;
    }
</style>
	
	<div class="row container-fluid">
        <div class="graph span6">
            <h3 class="title"> The Chart</h3>
            <canvas id="myChart" width="100%" height="100%"></canvas>
        </div>
		<br/>
		<button class="btn btn-primary btn-lg" id="total">Total</button>
        <button class="btn btn-primary btn-lg" id="text">Text</button>
		<button class="btn btn-primary btn-lg" id="word">Word</button>
		<button class="btn btn-primary btn-lg" id="defi">Definition</button>
		<br/>
		<?php echo "<pre>";print_r($Nvoca['text_result']); ?>
	</div>
	<script type="text/javascript">
	$(window).on('resize',function(){location.reload();});
var text_result = JSON.parse('<?php echo json_encode($Nvoca['text_result']); ?>');
var dateArray = new Array();
var lengthArray= new Array();
var ctx = $("#myChart").get(0).getContext("2d");
var vocadbchart;
//Total
$('#total').click(function(){
	dateArray = Object.keys(text_result.total);
	lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result.total[dateArray[i]] );
	}
	var data = {
		labels: dateArray,
		datasets: [
			{
				
				label: "Total",
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
	$(this).siblings().removeClass('active');
	$(this).addClass('active');
	// console.log(lengthArray);
});
	
//Text
$('#text').click(function(){
	dateArray = Object.keys(text_result.text);
	lengthArray = [];
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
	$(".active").removeClass('active');
	$(this).addClass('active');
	// console.log(lengthArray);
});

//Word
$('#word').click(function(){
	dateArray = Object.keys(text_result.word);
	lengthArray = [];
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
	$(".active").removeClass('active');
	$(this).addClass('active');
	// console.log(lengthArray);
});

//Word
$('#defi').click(function(){
	dateArray = Object.keys(text_result.defi);
	lengthArray = [];
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
	$(".active").removeClass('active');
	$(this).addClass('active');
	// console.log(lengthArray);
});

$( "#total" ).trigger( "click" );
</script>

