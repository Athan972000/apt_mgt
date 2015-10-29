<script src="<?php echo base_url().'resources/js/Chart.js'?>"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
canvas{
        width: 100% !important;

		max-width: 100%;
		height: 600px;
		max-height: 600px;
        height: auto !important;
    }
.chart_buttons
{
	margin: 0px;
	padding: 0px 20px;
}
.byitem
{
	text-align:left;
	z-index: 9999;
	position: relative;
	margin-right:25%;
}

.byusage
{
	text-align: right;
	position:relative;
	bottom: 46px;
}
.bydate
{
	text-align: center;
}
</style>
	
	<div class="row container-fluid">
        <div class="graph span6">
            <h3 class="title"> The Chart</h3>
            <canvas id="myChart"></canvas>
			<br/>
		
			<div class="chart_buttons">
				<div class="byitem">
					<button class="btn btn-primary btn-lg" id="total">Total</button>
					<button class="btn btn-default btn-lg" id="text">Text</button>
					<button class="btn btn-default btn-lg" id="word">Word</button>
					<button class="btn btn-default btn-lg" id="defi">Definition</button>
				</div>
				<div class="byusage">
					<button class="btn btn-primary btn-lg" id="count">Count</button>
					<button class="btn btn-default btn-lg" id="amnt">Amount</button>
				</div>
				<div class="bydate">
					<button class="btn btn-default btn-lg" id="m1">1 month</button>
					<button class="btn btn-default btn-lg" id="m3">3 months</button>
					<button class="btn btn-primary btn-lg" id="m6">6 months</button>
				</div>
			</div>
        </div>
		<br/>
		<table class='table table-striped table-hover'>
		<?php 		
		// echo "<pre>";
		// print_r($Nvoca['text_result']);
		// exit();
		// foreach( $Nvoca['text_result'] as $key => $value )
		// {
				// echo "<th>".$key."</th>";
		// }		
		?>
		</table>
	</div>
<script type="text/javascript">
var text_result = JSON.parse('<?php echo json_encode($Nvoca['text_result']); ?>');
var ctx = $("#myChart").get(0).getContext("2d");
var vocadbchart;
var amountorcount = 'count';
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
	var lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result[ext][dateArray[i]][amountorcount] );
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

$('#count').click(function(){
	amountorcount = 'count';
	$('.byitem').find('button.active').trigger( 'click' );
});
$('#amnt').click(function(){
	amountorcount = 'amount';
	$('.byitem').find('button.active').trigger( 'click' );
});

$('#m1').click(function(){
	$.ajax({
		url: base_url+"monthstats",
		type:'POST',
		data:{num: 1},
		success: function(res)
		{
			console.log(res);
			text_result = JSON.parse( res );
			$('.byitem').find('button.active').trigger( 'click' );
		}
	});
});

$('#m3').click(function(){
	$.ajax({
		url: base_url+"monthstats",
		type:'POST',
		data:{num: 3},
		success: function(res)
		{
			console.log(res);
			text_result = JSON.parse( res );
			$('.byitem').find('button.active').trigger( 'click' );
		}
	});
});

$('#m6').click(function(){
	$.ajax({
		url: base_url+"monthstats",
		type:'POST',
		data: {num: 6},
		success: function(res)
		{
			// console.log(res);
			text_result = JSON.parse( res );
			$('.byitem').find('button.active').trigger( 'click' );
		}
	});
});

$( "#total" ).trigger( "click" );
</script>

