<script src="<?php echo base_url().'resources/js/Chart.js'?>"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
canvas{
        width: 100% !important;
		max-width: 800px;
		height: 600px;
		width: 800px;
		max-height: 600px;
        height: auto !important;
    }
</style>
	
	<div class="row container-fluid">
        <div class="graph span6">
            <h3 class="title"> The Chart</h3>
            <canvas id="myChart"></canvas>
		<br/>
		<button class="btn btn-primary btn-lg" id="total">Total</button>
        <button class="btn btn-primary btn-lg" id="text">Text</button>
		<button class="btn btn-primary btn-lg" id="word">Word</button>
		<button class="btn btn-primary btn-lg" id="defi">Definition</button>
        </div>
		<br/>
		<table class='table table-striped table-hover'>
		<?php 		
		foreach( $Nvoca['text_result'] as $key => $value )
		{
				echo "<th>".$key."</th>";
		}		
		?>
		</table>
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
	var data = construct_data('total');
	
	if(typeof(vocadbchart) != 'undefined')
		vocadbchart.destroy();
	vocadbchart = new Chart(ctx).Line(data);
	$(this).siblings().removeClass('active');
	$(this).addClass('active');
});
//Text
$('#text').click(function(){
	var data = construct_data('text');
	vocadbchart.destroy();
	vocadbchart = new Chart(ctx).Line(data);
	$(".active").removeClass('active');
	$(this).addClass('active');
});

//Word
$('#word').click(function(){
	var data = construct_data('word');
	vocadbchart.destroy();
	vocadbchart = new Chart(ctx).Line(data);
	$(".active").removeClass('active');
	$(this).addClass('active');
});

//Definition
$('#defi').click(function(){
	var data = construct_data('defi');
	vocadbchart.destroy();
	vocadbchart = new Chart(ctx).Line(data);
	$(".active").removeClass('active');
	$(this).addClass('active');
});

function construct_data(ext)
{

	var dateArray = Object.keys(text_result[ext]);
	lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result[ext][dateArray[i]] );
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
	return data;
}

$( "#total" ).trigger( "click" );
</script>

